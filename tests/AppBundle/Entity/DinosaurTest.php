<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 4/2/19
 * Time: 4:39 PM
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{
    public function testSettingLength()
    {
        $dinasour = new Dinosaur();
        $this->assertSame(0, $dinasour->getLength());

        $dinasour->setLength(9);
        $this->assertSame(9, $dinasour->getLength());
    }

    public function testDinosaurHasNotShrunk()
    {
        $dinosaur = new Dinosaur();
        $dinosaur->setLength(15);

        $this->assertGreaterThan(12, $dinosaur->getLength(), 'Did you put it in the washing machine');
    }

    public function testReturnsFullSpecificationOfDinosaur()
    {
        $dinosaur = new Dinosaur();

        $this->assertSame(
            'The Unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification()
        );
    }

    public function testReturnsFullSpecificationForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);

        $dinosaur->setLength(12);

        $this->assertSame(
            'The Tyrannosaurus carnivorous dinosaur is 12 meters long',
            $dinosaur->getSpecification()
        );
    }
}