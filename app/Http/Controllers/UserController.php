<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('users', 'allUsers');
        $users = User::latest()->get();
        return view('users.allUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('users', 'addUser');
        return view('users.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5|max:60',
            'avatar' => 'nullable|mimes:png,jpg'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // return image_slug($request->name);
        if ($request->hasFile('avatar')) {
            $ap = $request->avatar;
            // $old_image_path = 'orders/actual/' . $order->al_picture;
            // if (Storage::disk('public')->exists($old_image_path)) {
            //     Storage::disk('public')->delete($old_image_path);
            // }
            $extension = strtolower($ap->getClientOriginalExtension());
            $randomFileName = image_slug($user->name) . '_' . date('Ymdhis') . '-' . rand(100, 999) . '.' . $extension;
            Storage::disk('public')->put('media/users/' . $randomFileName, File::get($ap));
            $user->avatar = $randomFileName;
        }
        $user->save();
        return redirect()->back()->with('success','User Added Successfully');
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
        $user = User::find($id);
        if (!$user) {
            return back();
        }
        return view('users.editUser',compact('user'));
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
        $user = User::find($id);
        if ($request->type == 'user') {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'avatar' => 'nullable|mimes:png,jpg'
            ]);
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            // return image_slug($request->name);
            if ($request->hasFile('avatar')) {
                $ap = $request->avatar;
                $old_image_path = 'media/users/' . $user ->avatar;
                if (Storage::disk('public')->exists($old_image_path)) {
                    Storage::disk('public')->delete($old_image_path);
                }
                $extension = strtolower($ap->getClientOriginalExtension());
                $randomFileName = image_slug($user->name) . '_' . date('Ymdhis') . '-' . rand(100, 999) . '.' . $extension;
                Storage::disk('public')->put('media/users/' . $randomFileName, File::get($ap));
                $user->avatar = $randomFileName;
            }
            $user->save();
            return redirect()->back()->with('success','User Updated Successfully');
        }elseif ($request->type == 'password') {
            $request->validate([
                'password' => 'confirmed|min:5|max:60',
            ]);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success','Password Updated Successfully');
        }
        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if ($user->id == Auth::id()) {
            return redirect()->back()->with('error', 'Sorry!!!. You are not able to delete your own profile');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
