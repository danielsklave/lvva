<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class ContestController extends Controller
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
        $contestsByYear = Contest::orderBy('created_at', 'desc')->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('contests.index', compact('contestsByYear'));
    }

    public function create()
    {
        return view('contests.edit', ['contest' => new Contest()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $contest = Contest::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        session()->flash('message', 'Contest created successfully.');

        return redirect()->route('contests.index');
    }

    public function edit(Contest $contest)
    {
        return view('contests.edit', compact('contest'));
    }

    public function update(Contest $contest)
    {
        request()->validate($this->validation);

        $contest->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        return redirect()->route('contests.index');
    }

    public function destroy(Contest $contest)
    {
        $contest->delete();

        return redirect()->route('contests.index');
    }
}
