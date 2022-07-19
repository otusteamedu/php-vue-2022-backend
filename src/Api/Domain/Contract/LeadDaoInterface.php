<?php

declare(strict_types=1);

namespace App\Api\Domain\Contract;

use App\Api\Domain\Entity\Lead;

interface LeadDaoInterface
{
    /**
     * @param  Lead  $lead
     * @return void
     */
    public function create(Lead $lead): void;
}
