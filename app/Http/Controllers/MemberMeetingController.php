<?php

namespace App\Http\Controllers;

use App\MemberMeeting;

class MemberMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $memberMeetingsByYear = MemberMeeting::filterFromRequest()
            ->orderBy('created_at', 'desc')
            ->published()
            ->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('member_meetings', compact('memberMeetingsByYear'));
    }

    public function show(MemberMeeting $member_meeting)
    {
        if(!$member_meeting->userCanView)
            return to_route('home');

        return to_route('member_meetings.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new MemberMeeting()]);
    }

    public function store()
    {
        MemberMeeting::createFromRequest();

        return to_route('member_meetings.index');
    }

    public function edit(MemberMeeting $member_meeting)
    {
        return view('posts.edit', ['post' => $member_meeting]);
    }

    public function update(MemberMeeting $member_meeting)
    {
        $member_meeting->updateFromRequest();

        return to_route('member_meetings.index');
    }

    public function destroy(MemberMeeting $member_meeting)
    {
        $member_meeting->delete();

        return to_route('member_meetings.index');
    }
}
