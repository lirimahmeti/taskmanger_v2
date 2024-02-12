<?php

namespace App\Http\Controllers;

use App\Models\Workers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('workers.index', ['workers' => Workers::all()]);

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
        $worker->delete();

        return redirect()->back()->with('deleted', 'Worker was deleted successfully.');
    }
}
