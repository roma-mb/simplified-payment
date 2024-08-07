<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class BuildException extends Exception
{
    /** @var array|Translator|Application|mixed|string */
    protected $message;

    /** @var mixed|string */
    protected $code;

    protected mixed $transportedData;

    protected string $shortMessage;

    protected string $description;

    protected string $help;

    protected string $transportedMessage;

    protected int $httpCode;

    public function __construct(array $exception)
    {
        parent::__construct();

        $this->shortMessage = $exception['shortMessage'] ?? 'internalError';
        $this->message = $exception['message'] ?? __('exceptions.internalError');
        $this->description = $exception['description'] ?? '';
        $this->help = $exception['help'] ?? '';
        $this->transportedMessage = $exception['transportedMessage'] ?? '';
        $this->httpCode = $exception['httpCode'] ?? Response::HTTP_UNPROCESSABLE_ENTITY;
        $this->transportedData = $exception['transportedData'] ?? '';
        $this->code = $this->shortMessage;
    }

    /**
     * Render a default response.
     *
     * @return Application|Response|FoundationApplication|ResponseFactory
     */
    public function render(): Application|Response|FoundationApplication|ResponseFactory
    {
        return response($this->getError(), $this->httpCode);
    }

    /**
     * Return a short message.
     *
     * @return string
     */
    public function getShortMessage(): string
    {
        return $this->shortMessage;
    }

    /**
     * Get Error.
     *
     * @return array
     */
    public function getError(): array
    {
        return array_filter([
            'shortMessage' => $this->shortMessage,
            'message' => $this->message,
            'description' => $this->description,
            'help' => $this->help,
            'transportedMessage' => $this->transportedMessage,
            'transportedData' => $this->transportedData,
        ]);
    }
}
