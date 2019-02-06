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
        $length = $this->getLengthFromSpecification($specification);
        $isCarnivorous = false;

        if (stripos($specification, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }

        return $this->createDinosaur($codeName, $isCarnivorous, $length);
    }

    private function createDinosaur($genus, $isCarnivorous, $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }

    private function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            '😱' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Dinosaur::LARGE - 1;

        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);

            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];

                break;
            }
        }

        return random_int($minLength, $maxLength);
    }
}