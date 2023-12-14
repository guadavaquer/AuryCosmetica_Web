<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const usersPerPage = 8;

    public function index()
    {
        $users = User::/*where('id', '!=', 1)->*/where('name','like','%'.request()->query('search').'%')->orderBy('id')->paginate(self::usersPerPage);
        return view("user.index", ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit(User $user){        
        return view('user.edit',[ 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $user)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:191'],
            'email' => ['required','max:191']
        ],[
            'required' => 'El campo es requerido.',
            'max' => 'El tamaño máximo del campo no debe exceder los :max caracteres.'
        ]);
        if ($user->id == 1){
            throw ValidationException::withMessages(['El usuario administrador no se puede modificar']);
        }
        $validator->stopOnFirstFailure()->validate();


        

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' =>$request->has('is_admin') && $request->is_admin ? 1 : 0
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        if ($user->id == 1){
            throw ValidationException::withMessages(['El usuario administrador no se puede eliminar']);
        }
        $user->delete();
        return redirect()->route('users.index');

    }

    public function delete(User $user){
        return view('user.delete',[ 'user' => $user]);
    }
}
