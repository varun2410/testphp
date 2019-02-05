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

    public function growFromSpecification($specification): Dinosaur
    {
        $codeName = 'InG-' . random_int(1, 99999);
        $length = random_int(1, Dinosaur::LARGE - 1);
        $isCarnivorous = false;

        if (stripos($specification, 'large') !== false) {
            $length = random_int(Dinosaur::LARGE, Dinosaur::HUGE-1);
        }

        if (stripos($specification, 'huge') !== false) {
            $length = random_int(Dinosaur::HUGE, 100);
        }


        if (stripos($specification, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }

        $dinosaur = $this->createDinosaur($codeName, $isCarnivorous, $length);

        return $dinosaur;
    }

    private function createDinosaur($genus, $isCarnivorous, $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }
}