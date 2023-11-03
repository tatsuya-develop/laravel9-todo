<?php

namespace Infrastructure\Interactors;

use App\Helpers\Message;
use Domain\UseCases\StateInterface;
use Illuminate\Support\Collection;

class State implements StateInterface
{
    public Collection $errors;
    private Collection $responseCollection;

    public function __construct()
    {
        $this->errors = collect();
        $this->responseCollection = collect();
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

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setResponse(string $key, mixed $value): void
    {
        $this->responseCollection->put($key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getResponse(string $key): mixed
    {
        return $this->responseCollection->get($key);
    }
}
