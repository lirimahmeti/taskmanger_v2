<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients= Clients::latest()->paginate(10);
        
        return view('clients.index', ['clients' => $clients]);
    }


    public function search(Request $request){

        $keyword = $request->input('keyword');

        $searchRes = Clients::where('name', 'like', '%'.$keyword.'%')->get();

        return view('clients.index', ['clients' => $searchRes]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clients.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
        ]);
        
        //nese perdoruesi e ka dhan numrin e telefonit ne form
        if ($request->filled('phone')){
            $userExists = Clients::where('phone', $request->input('phone'))->first();
            
            //kontrollojm se numri dhene a eshte regjistru ma heret ne databaz
            if($userExists) {
                //nese eshte regjistru e bejme return userin me at numer perkats
                return redirect()->back()->with('userExists', 'Klienti me këtë numër egziston')->with('client', $userExists);
            }else{ //nese nuk eshte ne databaz e shtojm klientin e ri
                try{
                    $newRecord = new Clients([
                        'name' => $request->input('name'),
                        'phone' => $request->input('phone'),
                    ]);
                    $newRecord->save();
            
                    $lastInsertedClient = Clients::latest()->first();
                }catch (QueryException $e){
                // Handle other database-related errors
                return redirect()->back()->with('error', 'An error occurred while saving the data.');
            }
            return redirect()->back()->with('success', 'Klienti u shtua me sukses')->with('client', $lastInsertedClient);
            }
        }else{//nese useri nuk e ka dhan numrin e telefonit po veq emrin e regjistrojm ne databaz veq me emer
            try{
                $newRecord = new Clients([
                    'name' => $request->input('name'),
                ]);
                $newRecord->save();
        
                $lastInsertedClient = Clients::latest()->first();
            }catch (QueryException $e){
            // Handle other database-related errors
            return redirect()->back()->with('error', 'An error occurred while saving the data.');
        }
        return redirect()->back()->with('success', 'Klienti u shtua me sukses')->with('client', $lastInsertedClient);
        }
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
        $client = Clients::findOrFail($id);
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $client = Clients::findOrFail($id);
        if($client){
            $client->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);
            return redirect()->route('clients.index')->with("client_edited", "Klienti u editua me sukses.");
        }
        return redirect()->back()->with("error_edit", "Dicka shkoi gabim, klienti nuk u editua.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $client = Clients::findOrFail($id);
        $client->delete();

        return redirect()->back()->with("client_deleted", "Klienti u fshi me sukses.");
    }
}