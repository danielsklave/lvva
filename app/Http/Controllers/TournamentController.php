<?php

namespace App\Http\Controllers;

use App\Tournament;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $tournamentsByYear = Tournament::filterFromRequest()
            ->orderBy('created_at', 'desc')
            ->published()
            ->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('tournaments', compact('tournamentsByYear'));
    }

    public function show(Tournament $tournament)
    {
        if(!$tournament->is_published && !(auth()->user() && auth()->user()->is_admin))
            return redirect()->route('home');

        return redirect()->route('tournaments.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new Tournament()]);
    }

    public function store()
    {
        Tournament::createFromRequest();

        session()->flash('message', 'Tournament created successfully.');

        return redirect()->route('tournaments.index');
    }

    public function edit(Tournament $tournament)
    {
        return view('posts.edit', ['post' => $tournament]);
    }

    public function update(Tournament $tournament)
    {
        $tournament->updateFromRequest();

        return redirect()->route('tournaments.index');
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return redirect()->route('tournaments.index');
    }
}
