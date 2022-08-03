<?php

declare(strict_types=1);

namespace TTN\Tea\Tests\Unit\Domain\Model\Product;

use TTN\Tea\Domain\Model\Product\Flavor;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * @covers \TTN\Tea\Domain\Model\Product\Flavor
 */
class FlavorTest extends UnitTestCase
{
    /**
     * @var Flavor
     */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Flavor();
    }

    /**
     * @test
     */
    public function isAbstractEntity(): void
    {
        self::assertInstanceOf(AbstractEntity::class, $this->subject);
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleSetsTitle(): void
    {
        $value = 'sweet';

        $this->subject->setTitle($value);

        self::assertSame($value, $this->subject->getTitle());
    }
}
