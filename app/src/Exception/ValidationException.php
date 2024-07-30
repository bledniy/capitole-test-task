<?php

declare(strict_types=1);

namespace App\Exception;

class ValidationException extends \Exception
{
    public function __construct(private readonly array $messages, protected $code = 0)
    {
        parent::__construct(json_encode($this->messages, JSON_THROW_ON_ERROR), $this->code);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
