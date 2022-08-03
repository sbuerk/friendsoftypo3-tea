<?php

declare(strict_types=1);

namespace TTN\Tea\Tests\Unit\Domain\Model\Product;

use TTN\Tea\Domain\Model\Product\Flavor;
use TTN\Tea\Domain\Model\Product\FlavoredTeaBeverage;
use TTN\Tea\Domain\Model\Product\Tea;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * @covers \TTN\Tea\Domain\Model\Product\FlavoredTeaBeverage
 */
class FlavoredTeaBeverageTest extends UnitTestCase
{
    /**
     * @var FlavoredTeaBeverage
     */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new FlavoredTeaBeverage();
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
    public function getSizeInitiallyReturnsZero(): void
    {
        self::assertSame(0, $this->subject->getSize());
    }

    /**
     * @return array<string, array{0: int}>
     */
    public function validSizesDataProvider(): array
    {
        return [
            'positive integer' => [200],
            'zero' => [0],
        ];
    }

    /**
     * @test
     *
     * @dataProvider validSizesDataProvider
     */
    public function setSizeValidSizePositiveSizeSetsSize(int $size): void
    {
        $this->subject->setSize($size);

        self::assertSame($size, $this->subject->getSize());
    }

    /**
     * @test
     */
    public function setSizeWithNegativeIntegerThrowsException(): void
    {
        $size = -1;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$size must be non-negative, but actually is: ' . $size);
        $this->expectExceptionCode(1659538024);

        $this->subject->setSize($size);
    }

    /**
     * @test
     */
    public function getTeaInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getTea());
    }

    /**
     * @test
     */
    public function setTeaSetsTea(): void
    {
        $model = new Tea();
        $this->subject->setTea($model);

        self::assertSame($model, $this->subject->getTea());
    }

    /**
     * @test
     */
    public function getTitleWithoutTeaAndWithoutAnyFlavorsReturnsEmptyString(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getTitleWithTeaAndWithoutAnyFlavorsReturnsTeaTitle(): void
    {
        $teaTitle = 'Darjeeling';
        $tea = new Tea();
        $tea->setTitle($teaTitle);
        $this->subject->setTea($tea);

        self::assertSame($teaTitle, $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getTitleWithOneFlavorAndTeaReturnsFlavorAndTeaTitle(): void
    {
        $tea = new Tea();
        $teaTitle = 'Darjeeling';
        $tea->setTitle($teaTitle);
        $this->subject->setTea($tea);

        $flavor = new Flavor();
        $flavorTitle = 'Strawberry';
        $flavor->setTitle($flavorTitle);
        $this->subject->addFlavor($flavor);

        self::assertSame($flavorTitle . ' ' . $teaTitle, $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getTitleWithTwoFlavorsAndTeaReturnsFlavorsInAddingOrderAndTeaTitle(): void
    {
        $tea = new Tea();
        $teaTitle = 'Darjeeling';
        $tea->setTitle($teaTitle);
        $this->subject->setTea($tea);

        $flavor1 = new Flavor();
        $flavorTitle1 = 'Strawberry';
        $flavor1->setTitle($flavorTitle1);
        $this->subject->addFlavor($flavor1);
        $flavor2 = new Flavor();
        $flavorTitle2 = 'Cinnamon';
        $flavor2->setTitle($flavorTitle2);
        $this->subject->addFlavor($flavor2);

        self::assertSame($flavorTitle1 . ' ' . $flavorTitle2 . ' ' . $teaTitle, $this->subject->getTitle());
    }
}
