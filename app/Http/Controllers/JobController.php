<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Status;
use App\Models\Workers;
use Illuminate\Http\Request;
use App\Models\LabelPrintSettings;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobsQuery = Jobs::with('client', 'worker', 'status', 'message');
        $workers = Workers::all();

        return view('jobs.index', ['jobs' => $jobsQuery->latest()->paginate(10), 'workers' => $workers]);
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

    // Show welcome view
    public function welcomeView(Request $request)
    {
        $jobsCount = Jobs::all()->count();

        if($request->input('id')){
            $id = $request->input('id');
           
            try {
                $job = Jobs::with('client', 'worker', 'status')->findOrFail($id);

                return view('welcome', ['job' => $job, 'jobs_count' => $jobsCount]);
                // If the job is found, continue processing
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                // Handle the case where the job is not found, for example:
                 // This will return a 404 Not Found HTTP response
                return redirect()->back()->with('error', 'Asnjë punë nuk u gjet me ID-në e dhënë');
            }

            
        }

        return view('welcome', ['jobs_count' => $jobsCount, 'job' => false]);

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
            try{
                $job->update(['status_id' => $status_id]);
            }catch(QueryException $e){
                $errorCode = $e->getPrevious()->errorInfo[0];
                $sqlState = $e->getPrevious()->errorInfo[1];
                $errorMessage = $e->getPrevious()->errorInfo[2];
        
                // Handle database-related errors
                return redirect()->back()->with('error', 'Statusi nuk u ndrrua. sql error code: '. $errorCode);
            }
            return redirect()->back()->with(['status_updated' => 'Statusi punës u përditsua me sukses']);
        }
        if($imei){
            try{
                $job->update(['imei' => $imei]);
            }catch(QueryException $e){
                $errorCode = $e->getPrevious()->errorInfo[0];
                $sqlState = $e->getPrevious()->errorInfo[1];
                $errorMessage = $e->getPrevious()->errorInfo[2];
        
                // Handle database-related errors
                return redirect()->back()->with('error', 'IMEI nuk u ndrrua. sql error code: '. $errorCode);
            }
            
            return redirect()->back()->with(['imei_updated' => 'IMEI u shtua me sukses']);
        }
        if($kodi){
            try{
                $job->update(['kodi' => $kodi]);
            }catch(QueryException $e){
                $errorCode = $e->getPrevious()->errorInfo[0];
                $sqlState = $e->getPrevious()->errorInfo[1];
                $errorMessage = $e->getPrevious()->errorInfo[2];
        
                // Handle database-related errors
                return redirect()->back()->with('error', 'Kodi nuk u ndrrua. sql error code: '. $errorCode);
            }
            return redirect()->back()->with(['kodi_updated' => 'Kodi u shtua me sukses']);
        }

    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $job = Jobs::findOrFail($id);

        if($job){
            try{
                $job->delete();
            }catch (QueryException $e){
                $errorCode = $e->getPrevious()->errorInfo[0];
                $sqlState = $e->getPrevious()->errorInfo[1];
                $errorMessage = $e->getPrevious()->errorInfo[2];
        
                // Handle database-related errors
                return redirect()->back()->with('error', 'Puna nuk u fshi. sql error code: '. $errorCode);
            }
            return redirect()->back()->with(['job_deleted' => 'Puna u fshi me sukses!']);
        }
    }
}
