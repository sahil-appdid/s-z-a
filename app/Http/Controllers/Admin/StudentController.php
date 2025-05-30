<?php
namespace App\Http\Controllers\Admin;

use App;
use App\Exports\GeneralExport;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Subject;
use Excel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $batches = Batch::get(['id', 'title']);
        $subjects = Subject::get(['id', 'title']);
        return view('content.tables.students', compact('batches', 'subjects'));
    }
    public function store(Request $request)
    {

          $validated=$request->validate(
        [
            'name'     => 'required|regex:/[a-zA-Z\s]+$/',
            'phone'    => 'required|unique:students|digits:10|regex:/^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$/',
            'email'    => 'required|unique:students|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        ],
            [
                'name.required'      => 'Please enter your first name',
                'name.regex'         => 'Name should be a string',
                'phone.required'     => 'Please enter your Phone no',
                'phone.digits'       => 'Please enter 10 digit Phone no',
                'phone.regex'        => 'Please enter a valid Phone no',
                'email.required'     => 'Please enter your email',
                'email.regex'        => 'Please enter a valid email',
                'email.unique'        => 'Student is already in one Batch',
            ]);

        $student_token=uniqid();    

        $data = new Student;
        $data->student_token = $student_token;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->subject_id = $request->subject;
        $data->batch_id = $request->batch;
        $data->save();
        return response([
            'header' => 'Added',
            'message' => 'Added Student successfully',
            'table' => 'student-table',
        ]);

    }
    public function edit($id)
    {
      
        $name = new Student();
        $data = $name::where('id', $id)->first();
        return response($data);

    }

    public function update(Request $request)
    {
        $data = Student::findOrFail($request->id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->subject_id = $request->subject;
        $data->batch_id = $request->batch;
        $data->save();
        return response([
            'header' => 'Updated',
            'message' => 'Updated successfully',
            'table' => 'student-table',
        ]);

    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:students,id',
            'status' => 'required|in:active,blocked',
        ]);

        Student::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'student status updated successfully',
            'table' => 'student-table',
        ]);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'student deleted successfully',
            'table' => 'student-table',
        ]);
    }
}
