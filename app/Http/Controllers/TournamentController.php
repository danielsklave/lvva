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
            ->latest()
            ->published()
            ->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('tournaments', compact('tournamentsByYear'));
    }

    public function show(Tournament $tournament)
    {
        if(!$tournament->userCanView)
            return to_route('home');

        return to_route('tournaments.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new Tournament()]);
    }

    public function store()
    {
        Tournament::createFromRequest();

        return to_route('tournaments.index');
    }

    public function edit(Tournament $tournament)
    {
        return view('posts.edit', ['post' => $tournament]);
    }

    public function update(Tournament $tournament)
    {
        $tournament->updateFromRequest();

        return to_route('tournaments.index');
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return to_route('tournaments.index');
    }
}
