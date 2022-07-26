<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

use App\Api\Domain\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class FullName
{
    /**
     * @var string Фамилия
     * @ORM\Column(type="string", nullable=true)
     */
    private string $surname;

    /**
     * @var string Имя
     * @ORM\Column(type="string", nullable=true)
     */
    private string $name;

    /**
     * @var string|null Отчество (необязательное поле)
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $patronymic;

    /**
     * @param  string  $surname
     * @param  string  $name
     * @param  string|null  $patronymic
     * @throws InvalidArgumentException
     */
    public function __construct(string $surname, string $name, ?string $patronymic)
    {
        $this->assertSurnameIsNotEmpty($surname);
        $this->assertNameIsNotEmpty($name);
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic ?? null;
    }

    /**
     * Возвращает ФИО одной строкой.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return implode(
            ' ',
            array_filter([
                             $this->getSurname(),
                             $this->getName(),
                             $this->getPatronymic()
                         ])
        );
    }

    /**
     * Возвращает сокращенное ФИО одной строкой.
     *
     * @return string
     */
    public function getShortName(): string
    {
        $shortName = $this->getSurname().' '
            .mb_substr($this->getName(), 0, 1).'.';
        if ($this->getPatronymic()) {
            $shortName .= mb_substr($this->getPatronymic(), 0, 1).'.';
        }
        return $shortName;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertSurnameIsNotEmpty(string $surname): void
    {
        if ($surname === '') {
            throw new InvalidArgumentException('Фамилия не должна быть пустой');
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertNameIsNotEmpty(string $name): void
    {
        if ($name === '') {
            throw new InvalidArgumentException('Имя не должно быть пустым');
        }
    }
}
