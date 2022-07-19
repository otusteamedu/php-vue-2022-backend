<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Common;

class PassportDto
{
    public string $serial;
    public string $number;
    public \DateTimeImmutable $date;
}
