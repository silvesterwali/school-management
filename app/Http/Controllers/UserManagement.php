<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.user.index', compact('user'));
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
    public function edit($id)
    {
        //
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
        $userId = Auth::user()->id;
        $this->validate($request, [
            'name'                  => 'required|min:3|max:50',
            'email'                 => 'required|email|unique:users,email,' . $userId,
            'password_lama'         => 'required',
            'password_baru'         => 'required_if:password_lama,!==,null|min:6|required_with:password_baru_confirm|same:password_baru_confirm',
            'password_baru_confirm' => 'min:6',
        ]);

        $user = User::find($id);

        if ($request->password_lama !== null) {
            $hashedPassword    = User::find($id)->password;
            $encryptedPassword = $request->password_lama;
            if (Hash::check($encryptedPassword, $hashedPassword)) {
                $newPassword    = Hash::make($request->password_baru);
                $user->password = $newPassword;
            } else {
                return redirect()->route('userAccess.index')->with('status', 'password lama tidak sama');
            }

        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('userAccess.index')->with('status', 'User akses berhasil di update');

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
}
