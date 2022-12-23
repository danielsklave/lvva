<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload()
    {
        $file = request()->file;
        $filename = time().$file->getClientOriginalName();
        $file->move('storage/files/', $filename);

        return response()->json([
            'link' => asset('storage/files/'.$filename),
        ]);

    }
}
