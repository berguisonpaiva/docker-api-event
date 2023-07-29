<?php

namespace App\Sevices;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function paginate(string $page): LengthAwarePaginator
    {
        return $this->repository->paginate($page);
    }
}
