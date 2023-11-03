<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorException;
use App\Helpers\Message;
use App\Http\Requests\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nette\NotImplementedException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Controllerの基底クラス
 * このクラスを継承したサブクラスで、必要なphase_*をオーバーライドする
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    private Collection $errors;
    private int $status = Response::HTTP_OK;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->errors = collect();
        $this->request = $request;
    }

    /**
     * エラーログを出力
     * @param Throwable $e
     * @return void
     */
    public function traceError(Throwable $e): void
    {
        Log::error($e->getMessage());
        Log::error($e->getTraceAsString());
    }

    /**
     * 独自エラーメッセージを追加
     * @param string $code error code
     * @param string[] ...$args
     * @return void
     */
    public function addError(string $code, ...$args): void
    {
        $this->errors->push(Message::error($code, ...$args));
    }

    /**
     * 独自例外エラーを発生させる
     * @param string $code error code
     * @param string[] ...$args
     * @return void
     * @throws ValidationErrorException
     */
    public function raiseError(string $code, ...$args): void
    {
        $this->addError($code, ...$args);
        throw new ValidationErrorException($this->errors);
    }

    /**
     * エラーが発生したか判定
     * @return bool
     */
    public function isError(): bool
    {
        return $this->errors->isNotEmpty();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $data = null;

        try {
            $data = $this->invokeTransaction();
        } catch (Throwable $e) {
            $this->traceError($e);
        }

        return $this->phaseResponse($data);
    }

    /**
     * トランザクションをかけてメイン処理を実行
     * @return mixed
     */
    public function invokeTransaction(): mixed
    {
        return DB::transaction(function () {
            $data = null;
            try {
                $this->phaseValidate();

                if (!$this->isError()) {
                    $data = $this->phaseInvoke();
                }
            } catch (ValidationErrorException $e) {
                if ($this->status === Response::HTTP_OK) {
                    $this->status = Response::HTTP_BAD_REQUEST;
                }

                $this->errors = $e->errors;
            } catch (Throwable $e) {
                $this->traceError($e);
                if ($this->status === Response::HTTP_OK) {
                    $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;
                }

                $this->addError('CMN_0001');
            }

            return $data;
        });
    }

    /**
     * バリデーション処理
     * @return void
     */
    public function phaseValidate(): void
    {
    }

    /**
     * メイン処理
     * @return mixed
     */
    public function phaseInvoke(): mixed
    {
        throw new NotImplementedException(__METHOD__ . ' should be overridden');
    }

    /**
     * レスポンス処理
     * @param mixed $data
     * @return JsonResponse
     */
    public function phaseResponse(mixed $data): JsonResponse
    {
        if ($this->isError()) {
            $data = [];
        }

        return response()->json([
            'data' => $data,
            'errors' => $this->errors->toArray()
        ], $this->status);
    }
}
