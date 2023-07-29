<?php
namespace App\Exceptions;

use Exception;

class EventDateConflictException extends Exception
{
    protected $message = 'Usuário já possui inscrição em outro evento nesta data e horário.';
}