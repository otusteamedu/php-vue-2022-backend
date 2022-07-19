<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Input;

use App\Api\Application\Dto\Common\FullName;
use App\Api\Application\Dto\Common\Passport;

class CreateLeadDto
{
    public readonly FullName $fullName;
    public readonly \DateTimeImmutable $birthday;
    public readonly string $phone;
    public readonly Passport $passport;
}
