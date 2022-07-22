<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

use App\Api\Domain\Exception\InvalidArgumentException;
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
    private string $value;

    /**
     * @param  string  $value
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        $this->assertNumberIsValid($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertNumberIsValid(string $number): void
    {
        if (!preg_match('/^\d{10}$/', $number)) {
            throw new InvalidArgumentException('Номер телефона должен содержать 10 цифр');
        }
    }
}
