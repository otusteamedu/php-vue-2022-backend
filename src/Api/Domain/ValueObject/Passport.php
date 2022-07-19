<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

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
     */
    public function __construct(string $serial, string $number, \DateTimeImmutable $date)
    {
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
}
