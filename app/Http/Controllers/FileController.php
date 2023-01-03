<?php

namespace App\Http\Controllers;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function upload()
    {
        $responseData = [];
        
        foreach (request()->file('files') as $file)
        {
            $filename = time().$file->getClientOriginalName();
            $file->move('storage/files/', $filename);

            $responseData[] = [
                'path' => asset('storage/files/'.$filename),
                'mime' => $file->getClientMimeType()
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'files' => $responseData,
            ],
            'mmessage' => '',
            'error' => '',
        ]);

    }
}
