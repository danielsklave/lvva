<?php

namespace App\Http\Controllers;

use App\MemberMeeting;
use Illuminate\Http\Request;

class MemberMeetingController extends Controller
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
        $memberMeetingsByYear = MemberMeeting::orderBy('created_at', 'desc')->get()
            ->groupBy(function($data) { return $data->created_at->format('Y'); });

        return view('member_meetings.index', compact('memberMeetingsByYear'));
    }

    public function create()
    {
        return view('member_meetings.edit', ['member_meeting' => new MemberMeeting()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $member_meeting = MemberMeeting::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        session()->flash('message', 'Member_meeting created successfully.');

        return redirect()->route('member_meetings.index');
    }

    public function edit(MemberMeeting $member_meeting)
    {
        return view('member_meetings.edit', compact('member_meeting'));
    }

    public function update(MemberMeeting $member_meeting)
    {
        request()->validate($this->validation);

        $member_meeting->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at
        ]);

        return redirect()->route('member_meetings.index');
    }

    public function destroy(MemberMeeting $member_meeting)
    {
        $member_meeting->delete();

        return redirect()->route('member_meetings.index');
    }
}
