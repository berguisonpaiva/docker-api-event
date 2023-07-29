<?php
namespace App\Exceptions;

use Exception;

class IncriptionNotFoundException extends Exception
{
    protected $message = 'Inscriçao não existe.';
}