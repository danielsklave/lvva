<?php

namespace App\Http\Controllers;

use App\BoardMeeting;
use Illuminate\Http\Request;

class BoardMeetingController extends Controller
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
        $boardMeetingsByYear = BoardMeeting::orderBy('created_at', 'desc')->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('board_meetings.index', compact('boardMeetingsByYear'));
    }

    public function create()
    {
        return view('board_meetings.edit', ['board_meeting' => new BoardMeeting()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $board_meeting = BoardMeeting::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        session()->flash('message', 'Board_meeting created successfully.');

        return redirect()->route('board_meetings.index');
    }

    public function edit(BoardMeeting $board_meeting)
    {
        return view('board_meetings.edit', compact('board_meeting'));
    }

    public function update(BoardMeeting $board_meeting)
    {
        request()->validate($this->validation);

        $board_meeting->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        return redirect()->route('board_meetings.index');
    }

    public function destroy(BoardMeeting $board_meeting)
    {
        $board_meeting->delete();

        return redirect()->route('board_meetings.index');
    }
}
