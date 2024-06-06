<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FootballMatchService;

class FootballMatchController extends Controller
{
    protected $matchService;

    public function __construct(FootballMatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index()
    {
        return response()->json($this->matchService->getAll());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:football_matches',
            'date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        return response()->json($this->matchService->create($validatedData), 201);
    }

    public function show($id)
    {
        return response()->json($this->matchService->findById($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255|unique:football_matches',
            'date' => 'sometimes|required|date',
            'duration' => 'sometimes|required|integer',
        ]);

        return response()->json($this->matchService->update($id, $validatedData));
    }

    public function destroy($id)
    {
        $this->matchService->delete($id);
        return response()->json(['message' => 'Partida deletada com sucesso.']);
    }
}
