<?php

namespace App\Http\Transformers;

use Illuminate\Support\Collection;

class EventInscriptionTransform
{
    
    public static function transform(array $eventInscription)
    {
        return [
            'id' => $eventInscription['id'],
            'event_id' => $eventInscription['event_id'],
            'user_id' => $eventInscription['user_id'],
            'user_name' => $eventInscription['user']['name'],
            'user_email' => $eventInscription['user']['email'],
            'user_cpf' => $eventInscription['user']['cpf'],
        ];
    }
}
