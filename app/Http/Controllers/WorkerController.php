<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Workers;
use Illuminate\Http\Request;
use App\Charts\WorkersJobsChart;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorkersJobsChart $chart)
    {
        //

        return view('workers.index', ['workers' => Workers::all(), 'chart' => $chart->build()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required | string',
            'phone' => 'required | string'
        ]);

        try{
            
            $newRecord = new Workers([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);

            $newRecord->save();

        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062) {
                // Handle unique constraint violation error
                return redirect()->back()->with('error', 'Numri dhënë është regjistruar më heret në databaz.');
            } else {
                // Handle other database-related errors
                return redirect()->back()->with('error', 'An error occurred while saving the data.');
            }
        }
        
        return redirect()->route('workers.index')->with('success', 'Puntori u shtua me sukses.');
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
        //
        return view('workers.edit', ['worker' => Workers::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string',
            'phone' => 'string'
        ]);

        $worker = Workers::findOrFail($id);
        $request->input('name')? $worker->name = $request->input('name'):false;
        $request->input('phone')?$worker->phone = $request->input('phone'):false;

        $worker->save();

        return redirect()->route('workers.index')->with('updated', 'Puntori u editua me sukses!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $worker = Workers::findOrFail($id);
        $workerHasJobs = Jobs::where('worker_id', $id)->first();

        if($workerHasJobs){
            return redirect()->back()->with('error', 'Puntori nuk munde te fshihet - Ka pune te regjistruara');
        }else{
            try{
                $worker->delete();
            }catch(QueryException $e){
                return redirect()->back()->with('error', 'Dicka shkoi gabim - puntori nuk u fshi (database error)');
            }
            return redirect()->back()->with('success', 'Worker was deleted successfully.');
        }
    
    }
}
