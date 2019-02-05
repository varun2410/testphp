<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 4/2/19
 * Time: 6:36 PM
 */

namespace Tests\AppBundle\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;

class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinosaurFactory
     */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new DinosaurFactory();
    }

    public function testItGrowsALargeVelociraptor()
    {
        $dinosaur = $this->factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dinosaur);
        $this->assertIsString($dinosaur->getGenus());
        $this->assertSame('Velociraptor', $dinosaur->getGenus());
        $this->assertSame(5, $dinosaur->getLength());
    }

    public function testItGrowsATriceraptors()
    {
        $this->markTestIncomplete('Waiting for confirmation from GenLab');
    }

    public function testItGrowsABabyVelociraptor()
    {
        if(!class_exists('Nanny')){
            $this->markTestSkipped('There is nobody t watch the baby');
        }

        $dinosaur = $this->factory->growVelociraptor(1);
        $this->assertSame(1, $dinosaur->getLength());
    }

    /**
     * @return array
     */
    public function getSpecificationTests()
    {
        return [
            ['large carnivorous dinosaur', true, true],
            ['give me all the cookie', false, false],
            ['large herbivore', true, false]
        ];
    }

    public function getHugeDinosaurSpecTests()
    {
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['😱'],
        ];
    }

    /**
     * @dataProvider getSpecificationTests
     *
     * @param $spec
     * @param $expectedIsLarge
     * @param $expectedIsCarnivorous
     */
    public function testItGrowsADinosaurFromSpecification($spec, $expectedIsLarge, $expectedIsCarnivorous)
    {
        $dinosaur = $this->factory->growFromSpecification($spec);
        if ($expectedIsLarge) {
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());
        } else {
            $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
        }

        $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorous(), 'Diets do not match');
    }

    /**
     * @dataProvider getHugeDinosaurSpecTests
     *
     * @param $specification
     */
    public function testItGrowsAHugeDinosaur($specification)
    {
        $dinosaur = $this->factory->growFromSpecification($specification);

        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dinosaur->getLength());
    }
}