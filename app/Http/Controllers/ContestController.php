<?php

namespace App\Http\Controllers;

use App\Contest;

class ContestController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $contestsByYear = Contest::filterFromRequest()
            ->orderBy('created_at', 'desc')
            ->published()
            ->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('contests', compact('contestsByYear'));
    }

    public function show(Contest $contest)
    {
        if(!$contest->userCanView)
            return to_route('home');

        return to_route('contests.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new Contest()]);
    }

    public function store()
    {
        Contest::createFromRequest();

        return to_route('contests.index');
    }

    public function edit(Contest $contest)
    {
        return view('posts.edit', ['post' => $contest]);
    }

    public function update(Contest $contest)
    {
        $contest->updateFromRequest();

        return to_route('contests.index');
    }

    public function destroy(Contest $contest)
    {
        $contest->delete();

        return to_route('contests.index');
    }
}
