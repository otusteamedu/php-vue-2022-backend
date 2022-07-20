<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Http\Output;

class HttpErrorMessage
{
    public int $code;
    public string $message;
}
