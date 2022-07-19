<?php

declare(strict_types=1);

namespace App\Api\Domain\ValueObject;

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
     */
    public function __construct(\DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }
}
