<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use App\Services\InscriptionService;
use Illuminate\Http\{
    Request,
    Response
};
use App\Exceptions\{
    EventDateConflictException,
    EventNotFoundException,
    UserNotFoundException,
    UserEventConflictException,
    EventRegistrationException,
    
};

class InscriptionController extends Controller
{
    protected $inscriptionService;

    public function __construct(InscriptionService $inscriptionService)
    {
        $this->inscriptionService = $inscriptionService;
    }

    public function index()
    {
        $inscription = $this->inscriptionService->getAll();
        return response()->json($inscription);
    }

    public function store(InscriptionRequest $request)
    {
      
        try {
            $data = $request->validated();
           
            $inscription = $this->inscriptionService->create($data);
             return response()->json($inscription, Response::HTTP_CREATED);

        } catch (EventDateConflictException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }catch (EventNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (UserNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (UserEventConflictException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }catch (EventRegistrationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
          
            return response()->json(['error' => 'Ocorreu um erro ao criar a inscrição.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
