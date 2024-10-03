<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('settings.index',[
            'setting' => $setting
        ]);
    }

    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->version = $request->input('version');
        $setting->save();
        //dd($setting);
        return redirect()->back()->with('success','La version a été ajouté');
    }

    public function update(Request $request,$id)
    {
        $setting = Setting::find($id);
        $setting->version = $request->input('version');
        $setting->update();
        //dd($setting);
        return redirect()->back()->with('success','La version a été modifié');
    }
    public function activeMaintenance()
    {
        Artisan::call('down');
        return redirect()->back()->with('success', 'Le mode maintenance est activé');
    }
    public function desactiveMaintenance()
    {
        Artisan::call('up');
        return redirect()->back()->with('success','Le mode maintenance est désactivé');
    }
}
