<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
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
        $request->validate([
            'job_id' => 'required|numeric',
            'worker_id' => 'required|numeric',
            'mesazhi' => 'required|string',
        ]);
        try{
            $newRecord = new Message([
                'job_id' => $request->input('job_id'),
                'worker_id' => $request->input('worker_id'),
                'mesazhi' => $request->input('mesazhi'),
            ]);

            $newRecord->save();

        } catch (QueryException $e){
            
            return redirect()->back()->with('error', 'An error occurred while saving the data.');
       
        }
        
        return redirect()->back()->with('success', 'Mesazhi u shtua me sukses.');
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
