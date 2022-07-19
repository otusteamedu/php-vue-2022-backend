<?php

declare(strict_types=1);

namespace App\Api\Domain\Contract;

use App\Api\Domain\Entity\Lead;

interface LeadRepositoryInterface
{
    /**
     * @param  int  $id
     * @return Lead|null
     */
    public function findOneById(int $id): ?Lead;

    /**
     * @return Lead[]
     */
    public function findAll(): iterable;
}
