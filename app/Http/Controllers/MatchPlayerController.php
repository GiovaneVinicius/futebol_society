<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MatchPlayerService;
use Illuminate\Support\Facades\Validator;

class MatchPlayerController extends Controller
{
    protected $matchPlayerService;

    public function __construct(MatchPlayerService $matchPlayerService)
    {
        $this->matchPlayerService = $matchPlayerService;
    }

    public function store(Request $request, MatchPlayerService $matchPlayerService)
    {
        $validator = Validator::make($request->all(), [
            'football_match_id' => 'required',
            'players' => 'required|array',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Obter os dados validados
        $validatedData = $validator->validated();
    
        // Validar a existência da partida
        if (!$matchPlayerService->validateMatchExists($validatedData['football_match_id'])) {
            return response()->json(['error' => 'A partida especificada não existe.'], 404);
        }
        
        // Validar a existência de todos os jogadores
        if (!$matchPlayerService->validatePlayersExist($validatedData['players'])) {
            return response()->json(['error' => 'Alguns jogadores especificados não existem.'], 404);
        }
    
        $matchPlayers = [];
        foreach ($validatedData['players'] as $playerId) {
            $matchPlayers[] = $matchPlayerService->create([
                'football_match_id' => $validatedData['football_match_id'],
                'player_id' => $playerId,
            ]);
        }
    
        return response()->json(['message' => 'O(s) Jogador(es) foi(ram) adicionados a partida!', 'matchPlayers' => $matchPlayers], 201);
    }    

    public function show($id)
    {
        $matchPlayer = $this->matchPlayerService->findById($id);

        return response()->json($matchPlayer);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'football_match_id' => 'sometimes|required',
            'players' => 'sometimes|required|array',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Validar a existência da partida
        $footballMatchId = $validator->input('football_match_id');
        if (!$this->matchPlayerService->validateMatchExists($footballMatchId)) {
            return response()->json(['error' => 'A partida especificada não existe.'], 404);
        }
    
        // Validar a existência dos jogadores
        $playerIds = $validator->input('players');
        if (!$this->matchPlayerService->validatePlayersExist($playerIds)) {
            return response()->json(['error' => 'Alguns jogadores especificados não existem.'], 404);
        }
    
        // Atualizar os registros do MatchPlayer para o ID especificado
        $matchPlayers = [];
        foreach ($playerIds as $playerId) {
            $matchPlayers[] = $this->matchPlayerService->update($id, [
                'football_match_id' => $footballMatchId,
                'player_id' => $playerId,
            ]);
        }
    
        return response()->json(['message' => 'Match player deletada com sucesso!', 'matchPlayers' => $matchPlayers]);
    }    
    

    public function destroy($id)
    {
        $this->matchPlayerService->delete($id);

        return response()->json(['message' => 'Match player deleted successfully']);
    }

    public function index()
    {
        $matchPlayers = $this->matchPlayerService->getAll();

        return response()->json($matchPlayers);
    }
}
