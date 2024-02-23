<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
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
        return view('status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string'
        ]);


            try{
                $newRecord = new Status([
                    'name' => $request->input('name'),
                    'color' => $request->input('color'),
                    'active' => $request->input('active')
                ]);

                $newRecord->save();
            
            }catch(QueryException $e){
                return redirect()->back()->with('error', 'Dicka shkoi gabim, statusi nuk u shtua ne databaze'.$e);
            }
            return redirect()->route('status.index')->with('success', 'Statusi u shtua me sukses.');
     
        
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
        $recordToDelete = Status::findOrFail($id);
        $notUsed = Jobs::where('status_id', '=', $id)->first();

        if($recordToDelete){
            if(is_null($notUsed)){
                try{
                    $recordToDelete->delete();
                }catch(QueryException $e){
                    return redirect()->back()->with('error', 'Dicka shkoi gabim. Stausi nuk u fshi');
                }
                return redirect()->back()->with('success', 'Statusi u fshi me sukses!');
            }else{
                return redirect()->back()->with('error', 'Statusi nuk munde te fshihet sepse eshte perdorur ne ndonje pune.');
            }
        }else{
            return redirect()->back()->with('error', 'Nuk u gjet statusi per tu fshire.');
        }
        
    }
}
