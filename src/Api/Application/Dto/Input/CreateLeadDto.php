<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Input;

use App\Api\Application\Dto\Common\FullNameDto;
use App\Api\Application\Dto\Common\PassportDto;

class CreateLeadDto
{
    public FullNameDto $fullName;
    public \DateTimeImmutable $birthday;
    public string $phone;
    public PassportDto $passport;
}
