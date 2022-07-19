<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

use App\Api\Domain\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Passport
{
    /**
     * @var string Серия, 4 цифры
     * @ORM\Column(type="string", nullable=true, length=4)
     */
    private string $serial;

    /**
     * @var string Номер, 6 цифр
     * @ORM\Column(type="string", nullable=true, length=6)
     */
    private string $number;

    /**
     * @var \DateTimeImmutable  Дата выдачи
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private \DateTimeImmutable $date;

    /**
     * @param  string  $serial
     * @param  string  $number
     * @param  \DateTimeImmutable  $date
     * @throws InvalidArgumentException
     */
    public function __construct(string $serial, string $number, \DateTimeImmutable $date)
    {
        $this->assertSerialIsValid($serial);
        $this->assertNumberIsValid($number);
        $this->assertDateIsInThePast($date);
        $this->serial = $serial;
        $this->number = $number;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getSerial(): string
    {
        return $this->serial;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertSerialIsValid(string $serial): void
    {
        if (!preg_match('/\d{4}/', $serial)) {
            throw new InvalidArgumentException('Серия паспорта должна содержать 4 цифры');
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertNumberIsValid(string $number): void
    {
        if (!preg_match('/\d{6}/', $number)) {
            throw new InvalidArgumentException('Номер паспорта должен содержать 6 цифр');
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertDateIsInThePast(\DateTimeImmutable $date): void
    {
        if ($date >= new \DateTimeImmutable()) {
            throw new InvalidArgumentException('Дата рождения должна быть в прошлом');
        }
    }
}
