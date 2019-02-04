<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 4/2/19
 * Time: 6:42 PM
 */

namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptor($length)
    {
        return $this->createDinosaur('Velociraptor', true, $length);
    }

    public function createDinosaur($genus, $isCarnivorous, $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }
}