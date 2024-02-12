<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabelPrintSettings;
use App\Http\Controllers\Controller;

class LabelSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $settings = LabelPrintSettings::all();
        return view('label-settings.index', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('label-settings.create', ['label_setting' => LabelPrintSettings::latest()->first()]);
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
        return view('label-settings.edit', ['label_setting' => LabelPrintSettings::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //marrja e settingit ne fjale
        $setting = LabelPrintSettings::findOrFail($id);

    

        //heqja e settingit paraprap te zgjedhur
        LabelPrintSettings::where('chosen', 1)->update(['chosen' => 0]);

        $setting->update(['chosen' => 1]);

        return redirect()->route('label-settings.index')->with('chosen_set', 'Parametri: <b>'. $setting->name . '</b> u zgjedh me sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $setting = LabelPrintSettings::findOrFail($id);

        if($setting){
            $setting->delete();
        }

        return redirect()->back()->with('setting_deleted', 'Parametri u fshi me sukses.');
    }
}
