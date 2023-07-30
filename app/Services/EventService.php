<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\EventNotFoundException;

class EventService
{
    protected $repository;

    public function __construct(Event $event)
    {
        $this->repository = $event;
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function getEventInscriptionsWithFilter(string $id, ?string $userName): LengthAwarePaginator
    {
        $event = $this->checkEventExists($id);
        $query = $event->inscriptions()->with('user');
        if ($userName !== null) {
            $query->whereHas('user', function ($query) use ($userName) {
                $query->where('name', 'like', '%' . $userName . '%');
            });
        }

        return $query->paginate(10);
    }

    protected function checkEventExists(int $eventId): Event
    {
        $event = $this->repository->find($eventId);
        if (!$event) {
            throw new EventNotFoundException();
        }
        return $event;
    }
}
