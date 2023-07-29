<?php
namespace App\Exceptions;

use Exception;

class UserEventConflictException extends Exception
{
    protected $message = 'Usuário já inscrito nesse evento.';
}