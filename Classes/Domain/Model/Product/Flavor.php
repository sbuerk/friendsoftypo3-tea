<?php

declare(strict_types=1);

namespace TTN\Tea\Domain\Model\Product;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Flavor that can be added to a beverage.
 */
class Flavor extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
