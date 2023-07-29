<?php
namespace App\Exceptions;

use Exception;

class EventNotFoundException extends Exception
{
    protected $message = 'Evento não existe';
}