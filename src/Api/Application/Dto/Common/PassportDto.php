<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Common;

class PassportDto
{
    public ?string $serial = null;
    public ?string $number = null;
    public ?\DateTimeImmutable $date = null;
}
