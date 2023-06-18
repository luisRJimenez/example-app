<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Arr;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;


class UsuarioController extends Controller
{

    function __construct() {
        $this->middleware('permission:ver_usuario|crear_usuario|editar_usuario|borrar_usuario', [ 'only' => ['__invoke']]);
        $this->middleware('permission:crear_usuario', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar_usuario', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar_usuario', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     * 
     */
    public function __invoke(): Response
    {
        $usuario = User::all();
        $usuario->load('roles');
       
        return Inertia('Usuarios/index', [
            'usuario'=>$usuario
           
        ]);
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
        $user = User::find($id);
        $user->load('roles');
        return Inertia('Usuarios/editar', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, user $user): RedirectResponse
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email'.$id,
        //     'password' => ['confirmed', Rules\Password::defaults()],
        //     'rol'=> 'required'
        // ]);
        
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            
        ]);
      /// $request->user()->fill($request->validated());

        

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        
        $user->assignRole($request->rol);

        

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::find($id);

        if (auth()->user()->id === $user->id) {
            return redirect()->route('usuarios.index');
        }

        $user->delete();
        
        return redirect()->route('usuarios.index');
    }
}
