<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence;

use App\Api\Domain\Contract\LeadRepositoryInterface;
use App\Api\Domain\Entity\Lead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineLeadRepository extends ServiceEntityRepository implements LeadRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lead::class);
    }

    public function findOneById(int $id): ?Lead
    {
        return $this->find($id);
    }

    public function findAll(): iterable
    {
        return parent::findAll();
    }
}
