<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 6/2/19
 * Time: 12:39 PM
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Exception\DinosaursAreRunningRampantException;
use AppBundle\Exception\NotABuffetException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaurByDefault()
    {
        $enclosure = new Enclosure();

        $this->assertEmpty($enclosure->getDinosaurs());
    }

    public function testItAddsDinosaurs()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur());
        $enclosure->addDinosaur(new Dinosaur());

        $this->assertCount(2, $enclosure->getDinosaurs());
    }

    public function testItDoesNotAllowCarnivorousDinosToMixWithHerbivores()
    {
        $enclosure = new Enclosure(true);

        $enclosure->addDinosaur(new Dinosaur());

        $this->expectException(NotABuffetException::class);

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }


    public function testItDoesNotAllowToAddNonCarnivorousDinosaursToCarnivorousEnclosure()
    {
        $enclosure = new Enclosure(true);

        $this->expectException(NotABuffetException::class);

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));

        $enclosure->addDinosaur(new Dinosaur());
    }

//    public function testItDoesNotAllowToAddDinosToUnsecureEnclosures()
//    {
//        $enclosure = new Enclosure();
//
//        $this->expectException(DinosaursAreRunningRampantException::class);
//        $this->expectExceptionMessage('Are you craazy?!?');
//
//        $enclosure->addDinosaur(new Dinosaur());
//    }
}