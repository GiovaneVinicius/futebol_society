<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlayerService;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:players',
            'level' => 'required|integer|min:1|max:5',
            'goalkeeper' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $player = $this->playerService->create($request->all());

        return response()->json(['player' => $player]);
    }

    public function show($id)
    {
        $player = $this->playerService->findById($id);

        return response()->json(['player' => $player]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|unique:players',
            'level' => 'integer|min:1|max:5',
            'goalkeeper' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $player = $this->playerService->update($id, $request->all());

        return response()->json(['player' => $player]);
    }

    public function destroy($id)
    {
        $this->playerService->delete($id);

        return response()->json(['message' => 'Jogador deletado com sucesso.']);
    }
}
