<?php

declare(strict_types=1);

namespace App\Api\Application\UseCase;

use App\Api\Application\Contract\LoadLeadListInterface;
use App\Api\Application\Dto\Common\FullNameDto;
use App\Api\Application\Dto\Common\PassportDto;
use App\Api\Application\Dto\Output\LeadIsLoadedDto;
use App\Api\Application\Dto\Output\LeadListIsLoadedDto;
use App\Api\Domain\Contract\LeadRepositoryInterface;
use App\Api\Domain\Entity\Lead;
use App\Api\Domain\Exception\EntityNotFoundException;

class LoadLeadList implements LoadLeadListInterface
{
    private LeadRepositoryInterface $leadRepository;

    /**
     * @param  LeadRepositoryInterface  $leadRepository
     */
    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function loadList(): LeadListIsLoadedDto
    {
        $leads = $this->leadRepository->findAll();
        return $this->mapLeadsToDto($leads);
    }

    /**
     * @param  Lead[]  $leads
     * @return LeadListIsLoadedDto
     * @todo Вынести в отдельный класс
     * @todo Дубликат кода
     */
    private function mapLeadsToDto(iterable $leads): LeadListIsLoadedDto
    {
        $listDto = new LeadListIsLoadedDto();
        $listDto->leads = [];

        foreach ($leads as $lead) {
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

            $listDto->leads[] = $dto;
        }

        return $listDto;
    }
}
