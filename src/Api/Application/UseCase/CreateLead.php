<?php

declare(strict_types=1);

namespace App\Api\Application\UseCase;

use App\Api\Application\Contract\CreateLeadInterface;
use App\Api\Application\Dto\Input\CreateLeadDto;
use App\Api\Application\Dto\Output\LeadIsCreatedDto;
use App\Api\Domain\Contract\LeadDaoInterface;
use App\Api\Domain\Entity\Lead;
use App\Api\Domain\Exception\InvalidArgumentException;
use App\Api\Domain\ValueObject\Birthday;
use App\Api\Domain\ValueObject\FullName;
use App\Api\Domain\ValueObject\Passport;
use App\Api\Domain\ValueObject\Phone;

class CreateLead implements CreateLeadInterface
{
    private LeadDaoInterface $leadDao;

    /**
     * @param  LeadDaoInterface  $leadDao
     */
    public function __construct(LeadDaoInterface $leadDao)
    {
        $this->leadDao = $leadDao;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function create(CreateLeadDto $dto): LeadIsCreatedDto
    {
        $lead = $this->mapDtoToLead($dto);
        $this->leadDao->create($lead);
        return $this->mapLeadToDto($lead);
    }

    /**
     * @throws InvalidArgumentException
     * @todo Вынести в отдельный класс
     * @todo Выбрасывать исключение с полным списком невалидных параметров
     */
    private function mapDtoToLead(CreateLeadDto $dto): Lead
    {
        $fullName = new FullName(
            $dto->fullName->surname,
            $dto->fullName->name,
            null
        );
        $birthday = new Birthday(
            $dto->birthday
        );
        $phone = new Phone(
            $dto->phone
        );
        $passport = new Passport(
            $dto->passport->serial,
            $dto->passport->number,
            $dto->passport->date
        );

        return new Lead(
            $fullName,
            $birthday,
            $phone,
            $passport
        );
    }

    /**
     * @param  Lead  $lead
     * @return LeadIsCreatedDto
     */
    private function mapLeadToDto(Lead $lead): LeadIsCreatedDto
    {
        $leadIsCreatedDto = new LeadIsCreatedDto();
        $leadIsCreatedDto->id = $lead->getId();
        return $leadIsCreatedDto;
    }

}
