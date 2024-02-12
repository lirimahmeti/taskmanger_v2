<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Status;
use App\Models\Workers;
use Illuminate\Http\Request;
use App\Models\LabelPrintSettings;
use App\Http\Controllers\Controller;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Jobs::with('client', 'worker', 'status', 'message')->latest()->paginate(10);
     
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function printJob(string $id){
        $settings = LabelPrintSettings::where('chosen', 1)->get();
        $job = Jobs::with('client','worker')->findOrFail($id);
        if($job){
            return view('job.print', ['job' => $job, 'settings' => $settings]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $workers = Workers::all();

        return view('jobs.create', ['workers' => $workers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'worker_id' => 'required|numeric',
            'status_id' => 'nullable|numeric',
            'description' => 'required|string',
            'phone_model' => 'required|string',
            'imei' => 'nullable|string',
            'qrcode' => 'nullable|string',
            'kodi' => 'nullable|string',
        ]);
        try{
             $newRecord = new Jobs([
            'client_id' => $request->input('client_id'),
            'worker_id' => $request->input('worker_id'),
            'description' => $request->input('description'),
            'phone_model' => $request->input('phone_model'),
            'imei' => $request->input('imei'),
            'kodi' => $request->input('kodi'),
            'status_id' => 1,
            'qrcode' => 'null'
            ]);

            $newRecord->save();

            $newRecord->update(['qrcode' => app('url')->route('jobs.edit', ['job' => $newRecord->id])]);

        }catch (QueryException $e){

                $errorCode = $e->errorInfo[0];
                $sqlState = $e->errorInfo[1];
                $errorMessage = $e->errorInfo[2];
            
                // Handle other database-related errors
                return redirect()->back()->with('error', 'Dicka shkoi gabim. '. $e->errorInfo[2]);

        }
        return redirect()->back()->with('new_job', $newRecord->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('jobs.edit', ['job' => Jobs::with('client', 'worker', 'status', 'message')->findOrFail($id), 'workers' => Workers::all(), 'statuses' => Status::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $imei = $request->input('imei');
        $status_id = $request->input('status');
        $kodi = $request->input('kodi');


        $job = Jobs::findOrFail($id);

        if($status_id){
            $job->update(['status_id' => $status_id]);
            return redirect()->back()->with(['status_updated' => 'Statusi punës u përditsua me sukses']);
        }
        if($imei){
            $job->update(['imei' => $imei]);
            return redirect()->back()->with(['imei_updated' => 'IMEI u shtua me sukses']);
        }
        if($kodi){
            $job->update(['kodi' => $kodi]);
            return redirect()->back()->with(['kodi_updated' => 'Kodi u shtua me sukses']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
