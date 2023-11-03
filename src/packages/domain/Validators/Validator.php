<?php

namespace Domain\Validators;

use App\Exceptions\ValidationErrorException;
use App\Helpers\Message;
use Illuminate\Support\Collection;

class Validator
{
    private Collection $errors;

    public function __construct()
    {
        $this->errors = collect();
    }

    /**
     * 独自例外エラーを発生させる
     * @param string $code error code
     * @param string[] ...$args
     * @return void
     * @throws ValidationErrorException
     */
    public static function raiseError(string $code, ...$args): void
    {
        $errors = collect([Message::error($code, ...$args)]);
        throw new ValidationErrorException($errors);
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
     * エラーが発生したか判定
     * @return bool
     */
    public function isError(): bool
    {
        return $this->errors->isNotEmpty();
    }

    // TODO: 以下に必要なバリデーション関係を連ねていく
}
