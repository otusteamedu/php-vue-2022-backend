<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Phone
{
    /**
     * @var string Номер телефона, 10 символов
     * Пример: 9011234567
     * @ORM\Column(type="string", nullable=true, length=10)
     */
    private string $number;

    /**
     * @param  string  $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}
