<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Iluminate\Support\Facades\Redirect;


class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver_rol|crear_rol|editar_rol|borrar_rol', ['only'=>['index']]);
        $this->middleware('permission:crear_rol', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar_rol', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar_rol', ['only'=>['destroy']]);
    }

    public function index()
    {
        $role = Role::all();
        $role->load('permissions');
        //tambien se puede con with
        //dd($role);
        $permisos = Permission::get()->pluck('name', 'id'); //trae un objeto No iterable
        //dd($permisos);
       
        return Inertia('Roles/index', [
            'role'=>$role,
            'permisos' => $permisos,
            
          
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * @throws \Illuminate\Validation\ValidationExceptionStore a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            
        ]);

        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permisos);

        return redirect()->back()->with('message', 'Creado exitosamente!');
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
       

    }

    public function sync(Request $request): RedirectResponse
    {
        dd($request->all);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->name);
        $this->validate($request, [
            'name' => 'required',

        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permisos);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->back()->with('message', 'Elimado exitosamente!');
    }
}
