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
        if(!$member_meeting->is_published && !(auth()->user() && auth()->user()->is_admin))
            return redirect()->route('home');

        return redirect()->route('member_meetings.index');
    }

    public function create()
    {
        return view('posts.edit', ['post' => new MemberMeeting()]);
    }

    public function store()
    {
        MemberMeeting::createFromRequest();

        session()->flash('message', 'Member_meeting created successfully.');

        return redirect()->route('member_meetings.index');
    }

    public function edit(MemberMeeting $member_meeting)
    {
        return view('posts.edit', ['post' => $member_meeting]);
    }

    public function update(MemberMeeting $member_meeting)
    {
        $member_meeting->updateFromRequest();

        return redirect()->route('member_meetings.index');
    }

    public function destroy(MemberMeeting $member_meeting)
    {
        $member_meeting->delete();

        return redirect()->route('member_meetings.index');
    }
}
