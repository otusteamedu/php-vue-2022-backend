<?php

declare(strict_types=1);

namespace App\Api\Domain\Entity;

use App\Api\Domain\ValueObject\Birthday;
use App\Api\Domain\ValueObject\FullName;
use App\Api\Domain\ValueObject\Passport;
use App\Api\Domain\ValueObject\Phone;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`lead`")
 */
class Lead
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $created;

    /**
     * @var FullName ФИО
     * @ORM\Embedded(class="App\Api\Domain\ValueObject\FullName")
     */
    private FullName $fullName;

    /**
     * @var Birthday Дата рождения
     * @ORM\Embedded(class="App\Api\Domain\ValueObject\Birthday")
     */
    private Birthday $birthday;

    /**
     * @var Phone Телефон
     * @ORM\Embedded(class="App\Api\Domain\ValueObject\Phone")
     */
    private Phone $phone;

    /**
     * @var Passport Паспорт
     * @ORM\Embedded(class="App\Api\Domain\ValueObject\Passport")
     */
    private Passport $passport;

    /**
     * @param  FullName  $fullName
     * @param  Birthday  $birthday
     * @param  Phone  $phone
     * @param  Passport  $passport
     */
    public function __construct(FullName $fullName, Birthday $birthday, Phone $phone, Passport $passport)
    {
        $this->created = new \DateTimeImmutable();
        $this->fullName = $fullName;
        $this->birthday = $birthday;
        $this->phone = $phone;
        $this->passport = $passport;
    }

    // ---------------------------
    // Геттеры
    // ---------------------------

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @return FullName
     */
    public function getFullName(): FullName
    {
        return $this->fullName;
    }

    /**
     * @return Birthday
     */
    public function getBirthday(): Birthday
    {
        return $this->birthday;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return Passport
     */
    public function getPassport(): Passport
    {
        return $this->passport;
    }

}

