<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Zoom;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::get();
        return view('content.tables.attendances', compact('attendances'));
    }

    public function store(Request $request)
    {
        $studentToken = $request->student_id;
        $zoomToken    = $request->zoom_id;

        $studentId = Student::where('student_token', $studentToken)->first('id');
        $zoomId = Zoom::where('zoom_token', $zoomToken)->first('id');

        // dd($studentId->id . " " . $zoomId->id);

        $exists = Attendance::where('student_id', $studentId->id)
            ->where('zoom_id', $zoomId->id)
            ->exists();

        if ($exists) {
            $alreadyMarked = "true";
            return $alreadyMarked;

        } else {

            $data             = new Attendance();
            $data->student_id = $studentId->id;
            $data->zoom_id    = $zoomId->id;
            $data->save();

            $zoomLink = Zoom::where('zoom_token', $zoomToken)->get('link');
            return $zoomLink;
        }

  
    }

}
