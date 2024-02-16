<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $statuses = Status::all();

        return view('status.index', ['statuses' => $statuses]);
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
        $status = Status::findOrFail($id);

        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'status_name' => 'string|required',
            'status_color' => 'string|required',
        ]);

        $status_to_update = Status::findOrFail($id);

        if($status_to_update){

            // nese useri e ka bo check checkboxin per me deklaru statusin si entitet aktiv (perdoret per filtrimin e punve aktive)
            if($request->has('active')){
                try{
                    $status_to_update->update(['name' => $request->input('status_name'), 'color' => $request->input('status_color'),'active' => 1]);
                }catch(QueryException $e){
                    return redirect()->back()->with('error', 'Dicka shkoi gabim, statusi nuk u perzgjedh si entitet aktiv'.$e);
                }
                return redirect()->route('status.index')->with('success', 'Statusi u perditsua me sukes dhe u zgjodh si entitet aktiv.');
            }
            
            try{
                $status_to_update->update(['name' => $request->input('status_name'), 'color' => $request->input('status_color'), 'active' => 0]);
            }catch(QueryException $e){
                return redirect()->back()->with('error', 'Dicka shkoi gabim, statusi nuk u perditsua'.$e);
            }
        
            return redirect()->route('status.index')->with('success', 'Statusi u perditsua me sukses.');
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
