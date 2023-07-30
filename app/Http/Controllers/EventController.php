<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\EventService;
use Illuminate\Http\Request;
use App\Exceptions\EventNotFoundException;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAll();
        return response()->json($events);
    }

    public function getEventInscriptionsWithFilter(Request $request)
    {

        try {
            $eventId = $request->input('id');
            $userName = $request->input('name');
            if (!$userName) {
                $userName = null;
            }
            $events =  $this->eventService->getEventInscriptionsWithFilter($eventId, $userName);
            return response()->json($events);
        } catch (EventNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao buscar inscrições.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
