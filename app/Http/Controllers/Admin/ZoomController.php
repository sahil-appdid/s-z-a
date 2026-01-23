<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendZoomLink;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Zoom;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class ZoomController extends Controller
{
    public function index()
    {
        $batches = Batch::get();
        $zooms   = Zoom::get();
        return view('content.tables.zooms', compact('batches', 'zooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|unique:zooms',
            'link'     => 'required',
        ],
            [
                'batch_id.unique' => 'Link is already created',
            ]
        );

        $zoomToken = uniqid();

        $data             = new Zoom();
        $data->zoom_token = $zoomToken;
        $data->batch_id   = $request->batch_id;
        $data->link       = $request->link;
        $data->save();

        $studentsInBatch = Student::with('batch')->where('batch_id', $request->batch_id)->get();
        $batchToken      = Batch::where('id', $request->batch_id)->first('batch_token');

        foreach ($studentsInBatch as $value) {
            $url = url("http://192.168.1.13:8000/link?student_id={$value->student_token}&zoom_id={$data->zoom_token}&batch_id={$batchToken->batch_token}");
            \Log::info($url);
            \Log::info($value);
            SendZoomLink::dispatch($url, $value);
        }

        return response([
            'header'  => 'Added',
            'message' => 'Zoom Link Added successfully',
            'table'   => 'zoom-table',
        ]);

    }

    public function edit($id)
    {
        $name = Zoom::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'batch_id' => 'required|unique:zooms',
        //     'link'     => 'required',
        // ],
        //     [
        //         'batch_id.unique' => 'Link is already created',
        //     ]
        // );
        $data           = Zoom::findOrFail($request->id);
        $data->batch_id = $request->batch_id;
        $data->link     = $request->link;
        $data->save();
        return response([
            'header'  => 'Updated',
            'message' => 'Zoom Link Updated successfully',
            'table'   => 'zoom-table',
        ]);

    }

    public function destroy($id)
    {
        Zoom::findOrFail($id)->delete();
        return response([
            'header'  => 'Deleted!',
            'message' => 'Zoom deleted successfully',
            'table'   => 'zoom-table',
        ]);
    }

    public function pdf()
    {
        $html = view('content.pdf.invoice');
        Browsershot::html($html)
            ->setChromePath('/usr/bin/chromium')
            ->noSandbox()
            ->disableGpu()
            ->timeout(120)
            ->windowSize(1920, 1080)
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->pdf();
    }
}
