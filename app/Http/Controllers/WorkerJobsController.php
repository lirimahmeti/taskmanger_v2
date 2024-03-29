<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Workers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showJobs(string $id, string $status)
    {
        //
       
        $worker = Workers::findOrFail($id);   
        if($status == 'active'){
            $activeJobs = Jobs::where('worker_id', $worker->id)->whereRelation('status', 'active', '=', 1)->get();
        }

        return view('workers.jobs', ['worker' => $worker, 'active_jobs' => $activeJobs]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
