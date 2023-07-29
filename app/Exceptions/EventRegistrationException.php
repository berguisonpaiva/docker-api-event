<?php
namespace App\Exceptions;

use Exception;

class EventRegistrationException  extends Exception
{
    protected $message = 'Este evento não aceita inscrições.';
}