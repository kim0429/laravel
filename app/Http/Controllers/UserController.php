<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Image;
use File;

class UserController extends Controller
{
    //
    public function profile_edit(Request $req){
        $user = Auth::user();
        $req->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
         ]);
         
         $user->name=$req->name;
         $user->email=$req->email;
         $user->save();
         return redirect('profile')->with('profile_edit',true);
    }
    public function update_avatar(Request $req){
        //validate image file
        $req->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
        // handle user avatar upload
        if($req->hasFile('avatar')){
            $user = Auth::user();
            $avatar = $req->file('avatar');
            $filename = time().'.'.$avatar->extension();
              // Delete current image before uploading new image
              if ($user->avatar !== 'default.png') {
                    $file = public_path('/avatar/' . $user->avatar);

                    if (File::exists($file)) {
                        unlink($file);
                    }
                }
            Image::make($avatar)->resize(null,300,function($constraint){$constraint->aspectRatio();$constraint->upsize();})->save(public_path('/avatar/'.$filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return redirect('profile');
    }
}
