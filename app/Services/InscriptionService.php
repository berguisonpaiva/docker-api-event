<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\{
    Inscription,
    Event,
    User,
};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\{
    EventDateConflictException,
    EventNotFoundException,
    UserNotFoundException,
    UserEventConflictException,
    EventRegistrationException,
    IncriptionNotFoundException,
};

class InscriptionService
{
    protected $inscriptionRepository;
    protected $eventRepository;
    protected $userRepository;

    public function __construct(Inscription $inscription, Event $event, User $user)
    {
        $this->inscriptionRepository = $inscription;
        $this->eventRepository = $event;
        $this->userRepository = $user;
    }
    public function paginate(string $page): LengthAwarePaginator
    {
        return $this->inscriptionRepository->whit()->paginate(10);
    }
    public function create(array $data): Inscription
    {
        $eventId = $data['event_id'];
        $userId = $data['user_id'];


        $event = $this->checkEventExists($eventId);
        $this->checkEventStatus($eventId);
        $this->checkUserExists($userId);
       

        $inscriptionStart = Carbon::parse($event->start_date);
        $inscriptionEnd = Carbon::parse($event->end_date);

        $this->checkUserEventConflict($eventId, $userId);
        $this->checkUserDateConflict($userId, $inscriptionStart, $inscriptionEnd);

        return $this->inscriptionRepository->create($data);
    }


    public function delete(string $id): void
    {
        $inscription = $this->inscriptionRepository->find($id);

        if (!$inscription) {
            throw new IncriptionNotFoundException();
        }
        $inscription->delete();
    }


    protected function checkEventExists(int $eventId): Event
    {
        $event = $this->eventRepository->find($eventId);
        if (!$event) {
            throw new EventNotFoundException();
        }
        return $event;
    }

    protected function checkEventStatus(int $eventId): void
    {
        $event = $this->eventRepository->find($eventId);
        if ($event->status == 0) {
            throw new EventRegistrationException();
        }
    }

    protected function checkUserExists(int $userId): void
    {
        $user = $this->userRepository->find($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
    }

    protected function checkUserEventConflict(int $eventId, int $userId): void
    {
        $existingEvent = $this->inscriptionRepository
            ->where('event_id', $eventId)
            ->where('user_id', $userId)
            ->first();

        if ($existingEvent) {
            throw new UserEventConflictException();
        }
    }

    protected function checkUserDateConflict(int $userId, Carbon $inscriptionStart, Carbon $inscriptionEnd): void
    {
        $existingUser = $this->inscriptionRepository->where('user_id', $userId)
            ->whereHas('event', function ($query) use ($inscriptionStart, $inscriptionEnd) {
                $query->where(function ($subquery) use ($inscriptionStart, $inscriptionEnd) {
                    $subquery->whereBetween('start_date', [$inscriptionStart, $inscriptionEnd])
                        ->orWhereBetween('end_date', [$inscriptionStart, $inscriptionEnd]);
                })
                    ->orWhere(function ($subquery) use ($inscriptionStart, $inscriptionEnd) {
                        $subquery->where('start_date', '<', $inscriptionStart)
                            ->where('end_date', '>', $inscriptionEnd);
                    });
            })
            ->first();

        if ($existingUser) {
            throw new EventDateConflictException();
        }
    }
}
