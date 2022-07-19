<?php

declare(strict_types=1);

namespace App\Api\Application\Contract;

use App\Api\Application\Dto\Output\LeadIsLoadedDto;

interface LoadLeadInterface
{
    public function load(int $id): LeadIsLoadedDto;
}
