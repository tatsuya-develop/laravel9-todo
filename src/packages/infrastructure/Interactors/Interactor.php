<?php

namespace Infrastructure\Interactors;

use App\Exceptions\ValidationErrorException;
use Domain\UseCases\UseCase;
use Nette\NotImplementedException;

/**
 * Serviceの基底クラス
 * このクラスを継承したサブクラスで、必要なphase_*をオーバーライドする
 */
class Interactor implements UseCase
{
    public State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * @return State
     * @throws ValidationErrorException
     */
    public function invokeStrict(): State
    {
        $this->state = $this->invoke();

        if ($this->state->isError()) {
            throw new ValidationErrorException($this->state->errors);
        }

        return $this->state;
    }

    /**
     * バリデーションのみを実行
     * @return State
     */
    public function validate(): State
    {
        $this->phaseValidate();

        return $this->state;
    }

    /**
     * 一連処理
     * @return State
     */
    public function invoke(): State
    {
        $this->phaseValidate();
        if (!$this->state->isError()) {
            $this->phaseInvoke();
        }

        if (!$this->state->isError()) {
            $this->phaseFinalize();
        }

        return $this->state;
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
     * @return void
     */
    public function phaseInvoke(): void
    {
        throw new NotImplementedException(__METHOD__ . ' should be overridden');
    }

    /**
     * 後処理
     * @return void
     */
    public function phaseFinalize(): void
    {
    }
}
