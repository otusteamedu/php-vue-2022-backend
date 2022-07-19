<?php

declare(strict_types=1);

namespace App\Api\Application\Contract;

use App\Api\Application\Dto\Output\LeadListIsLoadedDto;

interface LoadLeadListInterface
{
    public function loadList(): LeadListIsLoadedDto;
}
