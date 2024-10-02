<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission_groups = Permission::all()->groupBy('section');
        
        return view('roles.create', compact("permission_groups"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $role = Role::where("name", $request->name)->first();
        if ($role) {
            $role->syncPermissions($request->permissions);
        }else{
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with("success", "Role a bien été enregistré");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions->pluck('name')->toArray();
        //dd($permissions);
        $permission_groups = Permission::all()->groupBy('section');
        
        return view('roles.edit', compact("role", "permission_groups", "permissions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
 
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with("success", "Role a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storePermissions()
    {
        try {
            DB::table('permissions')->delete();
            $sqlPath = base_path('database/permission.sql');
            // get permissions the
            DB::unprepared(file_get_contents($sqlPath));
        } catch (Exception $e) {
            return $e->getMessage();
            return back()->with("error", "Erreur lors de la création des permissions");
        }

        return back()->with("success", "Les permissions ont été créées avec succès");
    }
}
