<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Common;

class Passport
{
    public readonly string $series;
    public readonly string $number;
    public readonly \DateTimeImmutable $date;
}
