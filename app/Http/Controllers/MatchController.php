<?php

namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:matches',
            'date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        $match = Match::create($data);

        return response()->json(['match' => $match], 201);
    }

    public function show($id)
    {
        $match = Match::findOrFail($id);
        return response()->json(['match' => $match]);
    }

    public function update(Request $request, $id)
    {
        $match = Match::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255|unique:matches',
            'date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        $match->update($data);

        return response()->json(['match' => $match]);
    }

    public function destroy($id)
    {
        $match = Match::findOrFail($id);
        $match->delete();
        return response()->json(['message' => 'Partida deletada com sucesso']);
    }
}
