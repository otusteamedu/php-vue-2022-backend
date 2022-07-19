<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

use App\Api\Domain\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Birthday
{
    /**
     * @var \DateTimeImmutable Дата
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private \DateTimeImmutable $value;

    /**
     * @param  \DateTimeImmutable  $value
     * @throws InvalidArgumentException
     */
    public function __construct(\DateTimeImmutable $value)
    {
        $this->assertDateIsInThePast($value);
        $this->value = $value;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertDateIsInThePast(\DateTimeImmutable $value): void
    {
        if ($value >= new \DateTimeImmutable()) {
            throw new InvalidArgumentException('Дата рождения должна быть в прошлом');
        }
    }
}
