<?php

declare(strict_types=1);

namespace TTN\Tea\Domain\Model\Product;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * A beverage based on one kind of tea with any number of flavors added.
 */
class FlavoredTeaBeverage extends AbstractEntity
{
    /**
     * @var int
     */
    protected $size = 0;

    /**
     * @var Tea|null
     */
    protected $tea;

    /**
     * @var array<int, Flavor>
     */
    protected $flavors = [];

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        if ($size < 0) {
            throw new \InvalidArgumentException('$size must be non-negative, but actually is: ' . $size, 1659538024);
        }

        $this->size = $size;
    }

    public function getTea(): ?Tea
    {
        return $this->tea;
    }

    public function setTea(?Tea $tea): void
    {
        $this->tea = $tea;
    }

    public function addFlavor(Flavor $flavor): void
    {
        $this->flavors[] = $flavor;
    }

    /**
     * Returns the title of this beverage, consisting of all flavor titles in adding order and the tea title.
     */
    public function getTitle(): string
    {
        $titleParts = [];

        foreach ($this->flavors as $flavor) {
            $titleParts[] = $flavor->getTitle();
        }
        if ($this->getTea() instanceof Tea) {
            $titleParts[] = $this->getTea()->getTitle();
        }

        return \implode(' ', $titleParts);
    }
}
