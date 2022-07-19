<?php

declare(strict_types=1);

namespace App\Api\Application\Dto\Output;

use App\Api\Application\Dto\Common\FullName;
use App\Api\Application\Dto\Common\Passport;

class LeadIsLoadedDto
{
    public int $id;
    public FullName $fullName;
    public \DateTimeImmutable $birthday;
    public string $phone;
    public Passport $passport;
}
