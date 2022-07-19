<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence;

use App\Api\Domain\Contract\LeadDaoInterface;
use App\Api\Domain\Entity\Lead;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineLeadDao implements LeadDaoInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param  EntityManagerInterface  $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Lead $lead): void
    {
        $this->entityManager->persist($lead);
        $this->entityManager->flush();
    }
}
