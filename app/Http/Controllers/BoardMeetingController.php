<?php

namespace App\Http\Controllers;

use App\BoardMeeting;

class BoardMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $boardMeetingsByYear = BoardMeeting::filterFromRequest()
            ->orderBy('created_at', 'desc')
            ->published()
            ->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('board_meetings', compact('boardMeetingsByYear'));
    }

    public function show(BoardMeeting $board_meetings)
    {
        if(!$board_meetings->userCanView)
            return to_route('home');

        return to_route('board_meetings.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new BoardMeeting()]);
    }

    public function store()
    {
        BoardMeeting::createFromRequest();

        return to_route('board_meetings.index');
    }

    public function edit(BoardMeeting $board_meeting)
    {
        return view('posts.edit', ['post' => $board_meeting]);
    }

    public function update(BoardMeeting $board_meeting)
    {
        $board_meeting->updateFromRequest();

        return to_route('board_meetings.index');
    }

    public function destroy(BoardMeeting $board_meeting)
    {
        $board_meeting->delete();

        return to_route('board_meetings.index');
    }
}
