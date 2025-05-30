<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches  = Batch::get();
        $subjects = Subject::get(['id', 'title']);
        return view('content.tables.batches', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|unique:batches',
            'title'      => 'required',
        ],
            [
                'subject_id.unique' => 'Batch for this subject is already created',
            ]
        );

        $batch_token    = uniqid();

        $data             = new Batch();
        $data->batch_token = $batch_token;
        $data->subject_id = $request->subject_id;
        $data->title      = $request->title;
        $data->save();
        return response([
            'header'  => 'Added',
            'message' => 'Batch Added successfully',
            'table'   => 'batch-table',
        ]);
    }

    public function edit($id)
    {
        $name = Batch::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'title'      => 'required',
        ]);
        $data             = Batch::findOrFail($request->id);
        $data->subject_id = $request->subject_id;
        $data->title      = $request->title;
        $data->save();
        return response([
            'header'  => 'Updated',
            'message' => 'Batch Updated successfully',
            'table'   => 'batch-table',
        ]);
    }

    public function destroy($id)
    {
        Batch::findOrFail($id)->delete();
        return response([
            'header'  => 'Deleted!',
            'message' => 'Batch deleted successfully',
            'table'   => 'batch-table',
        ]);
    }
}
