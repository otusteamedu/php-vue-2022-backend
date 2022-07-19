<?php

declare(strict_types=1);

namespace App\Api\Application\UseCase;

use App\Api\Application\Contract\LoadLeadInterface;
use App\Api\Application\Dto\Common\FullNameDto;
use App\Api\Application\Dto\Common\PassportDto;
use App\Api\Application\Dto\Output\LeadIsLoadedDto;
use App\Api\Domain\Contract\LeadRepositoryInterface;
use App\Api\Domain\Entity\Lead;
use App\Api\Domain\Exception\EntityNotFoundException;

class LoadLead implements LoadLeadInterface
{
    private LeadRepositoryInterface $leadRepository;

    /**
     * @param  LeadRepositoryInterface  $leadRepository
     */
    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function load(int $id): LeadIsLoadedDto
    {
        $lead = $this->leadRepository->findOneById($id);
        if ($lead === null) {
            throw new EntityNotFoundException('Не удалось найти лид с id='.$id);
        }
        return $this->mapLeadToDto($lead);
    }

    /**
     * @param  Lead  $lead
     * @return LeadIsLoadedDto
     * @todo Вынести в отдельный класс
     * @todo Дубликат кода
     */
    private function mapLeadToDto(Lead $lead): LeadIsLoadedDto
    {
        $fullNameDto = new FullNameDto();
        $fullNameDto->surname = $lead->getFullName()->getSurname();
        $fullNameDto->name = $lead->getFullName()->getName();

        $passportDto = new PassportDto();
        $passportDto->serial = $lead->getPassport()->getSerial();
        $passportDto->number = $lead->getPassport()->getNumber();
        $passportDto->date = $lead->getPassport()->getDate();

        $dto = new LeadIsLoadedDto();
        $dto->id = $lead->getId();
        $dto->fullName = $fullNameDto;
        $dto->birthday = $lead->getBirthday()->getValue();
        $dto->phone = $lead->getPhone()->getValue();
        $dto->passport = $passportDto;

        return $dto;
    }
}
