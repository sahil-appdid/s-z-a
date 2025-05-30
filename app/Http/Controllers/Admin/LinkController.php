<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request){

        $studentToken=$request->student_id;
        $zoomToken=$request->zoom_id;
        $batchToken=$request->batch_id;

        // dd($studentId, $zoomId, $batchId);
        return view('content.pages.link', compact('studentToken','zoomToken','batchToken'));

    }
}
