<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    private $validation = [
        'title'      => 'required|max:250',
        'body'       => 'required',
        'created_at' => 'required',
    ];

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $tournamentsByYear = Tournament::orderBy('created_at', 'desc')->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('tournaments.index', compact('tournamentsByYear'));
    }

    public function create()
    {
        return view('tournaments.edit', ['tournament' => new Tournament()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $tournament = Tournament::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        session()->flash('message', 'Tournament created successfully.');

        return redirect()->route('tournaments.index');
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit', compact('tournament'));
    }

    public function update(Tournament $tournament)
    {
        request()->validate($this->validation);

        $tournament->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        return redirect()->route('tournaments.index');
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return redirect()->route('tournaments.index');
    }
}
