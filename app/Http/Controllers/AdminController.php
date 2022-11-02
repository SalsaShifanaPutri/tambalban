<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $admindata = User::find($id);
        return view('admin.admin_profile_view', compact('admindata'));
    }

    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));

        }//end method

        public function StoreProfile(Request $request){
            $id = Auth::user()->id;
            $data = User::find($id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;

            if ($request->file('profile_image')) {
               $file = $request->file('profile_image');

               $filename = date('YmdHi').$file->getClientOriginalName();
               $file->move(public_path('upload/admin_images'),$filename);
               $data['profile_image'] = $filename;
            }
            $data->save();

            $notification = array(
                'message' => 'Profil Admin Berhasil di Ganti',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.profile')->with($notification);

        }// End Method

        public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validateDate = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
            if (Hash::check($request->oldpassword,$hashedPassword )) {
                $users = User::find(Auth::id());
                $users->password = bcrypt($request->newpassword);
                $users->save();

                session()->flash('message','Password Berhasil DiGanti');
                return redirect()->back();
            } else{
                session()->flash('message','password lama tidak cocok');
                return redirect()->back();
            }
    }





}
