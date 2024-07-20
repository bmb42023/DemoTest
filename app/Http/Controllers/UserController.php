<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function Index(){
        return view('frontend.index');
    }
    public function UserProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
    
        return view('frontend.dashboard.edit_profile',compact('profileData'));
}
public function UserProfileUpdate(Request $request)
{

    $id = Auth::user()->id;
    $data = User::find($id);
    // dd($id);
    try {
        
    // dd($data->name);
if ($data) {
    // Update the user's information
    $data->name = $request->name;
    $data->email = $request->email;
    $data->username = $request->username;
    $data->phone = $request->phone;
    $data->address = $request->address;
    $filename = "non";
    // Handle the photo upload
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        @unlink(public_path('upload/user_image',$data->photo));
        $filename = date('YmdHis') . $file->getClientOriginalName();
        
        $file->move(public_path('upload/user_image'), $filename);
    }
    $data->photo = $filename;

    // Dump and die to inspect the request data
       // End of code
   $data->save();

         
        //Error notification
       $notification = array('message'=>'Admin Profile Successfuly Created','alert-type' => 'Success');
        return redirect()->back()->with( $notification);
}
else {
    //Error notification
   $notification = array('message'=>'Admin Profile not found','alert-type' => 'Warning');
    return redirect()->back()->with( $notification);
}
    } catch (\Exception $e) {
        // Log the error or display a friendly error message to the user
        return redirect()->back()->with('error', 'An error occurred while updating your profile.');
    }
}

public function UserLogout (Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}
public function UserChangePassword(){
    return view('frontend.dashboard.change_password');
}
public function UserPasswordUpdate(Request $request){

    $id = Auth::user()->id;
    $profileData = User::find($id);
   // dd($request->all());


   // dd($request);
    $request->validate(
 [  'old_password'=> 'required',
           'new_password' =>'required|confirmed',
    ]);
 //   if(!hash($request->'old_password'=>Auth::check())){
     //  if(!Hash::chec'old_password'), auth::user()->password){
      //  $notification = array('message'=>'Old password does not match','alert-type' => 'Warning
       //  return redirect()->back()->with( $notification);
    if(!Hash::check($request->old_password,auth::user()->password)){
        $notification = array(
            'message'=>'Old password does not match',
            'alert-type' => 'Warning');
  return back()->with($notification);

    }
    // update 
   // $profileData->password = bcrypt($request->new_password);
   User::whereId(auth::user()->id)->update([
   'password'=> Hash::make($request-> new_password)
   ]);
   $notification = array(
    'message'=>' password changed',
    'alert-type' => 'success');
return back()->with($notification);

}
}

