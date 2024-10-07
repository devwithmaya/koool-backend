<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
    public function activeMaintenance(Request $request)
    {
        //dd('salut');
        $excludedRoutes = $request->get('excluded_routes', []);
        //dd($excludedRoutes);
        config(['maintenance.excluded_routes'=>$excludedRoutes]);
        //dd($excludedRoutes);
        if (App::isDownForMaintenance()) {
            Artisan::call('up');
            return redirect()->back()->with('success', 'Le mode maintenance est désactivé.');
        } else {
            Artisan::call('down',[
                '--secret' => '1234',
               '--render'=>"errors::503"
            ]);
            return redirect()->back()->with('success', 'Le mode maintenance est activé.');
        }
        /*return response()->json([
            'message' => 'Le mode maintenance est activé'
        ]);*/
        //return redirect()->back()->with('success', 'Le mode maintenance est activé');
    }
    public function desactiveMaintenance()
    {
        //dd('salut');
        Artisan::call('up');
        /*return response()->json([
            'message' => 'Le mode maintenance est désactivé'
        ]);*/
        return to_route('settings')->with('success','Le mode maintenance est désactivé');
    }
}
