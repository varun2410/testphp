<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 6/2/19
 * Time: 1:14 PM
 */

namespace AppBundle\Exception;


class NotABuffetException extends \Exception
{
    protected $message = 'Please do not mix the carnivorous and non-carnivorous dinosaurs. It will be a massacre!';
}