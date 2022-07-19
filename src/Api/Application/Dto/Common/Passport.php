<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Common;

class Passport
{
    public string $series;
    public string $number;
    public \DateTimeImmutable $date;
}
