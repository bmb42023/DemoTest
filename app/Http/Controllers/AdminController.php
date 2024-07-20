<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    // 
    public function AdminDashboard(){
        return view('admin.index');

    }
    public function AdminLogout (Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    public function AdminLogin(){
        return view('admin.admin_login');
    }
    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Pass data to view
        return view('admin.admin_profile_view',compact('profileData'));
       // return view('admin.admin_profile_view',compact(profileData));
       
    }
    public function AdminProfileStore(Request $request) {
        //    $id = Auth::user()->id;
        //    $data = User::find($id);
        //    $data->name = $request->name;
        //    $data->email = $request->email;
        //    $data->username = $request->username;
        //    $data->phone = $request->phone;
        //    $data->address = $request->address;
        //    $data->photo = $request->photo;
           
           
        //  if($request->file('photo')){
        //  $file = $request->file('photo');
        //  $filename = date('YmdHi').$file->getClientOriginalName();
        //  $file->move(public_path('Upload/admin_image'), $filename);
        //  $data['photo']= $filename;
        //  }
        //  dd($request->all());
        // // dd($data);
        //    $data->save();
        // return redirect()->back();
        // --- Modified Code
            
        // $data->save();
        $id = Auth::user()->id;
        $data = User::find($id);
        // dd($id);
        try {
            // Your existing code here
            // atte Attempt to read property "id" on null
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
            @unlink(public_path('upload/admin_image',$data->photo));
            $filename = date('YmdHis') . $file->getClientOriginalName();
            
            $file->move(public_path('upload/admin_image'), $filename);
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
    
    //    return redirect()->back();
 } 
 public function AdminChangePassword(){
    
    $id = Auth::user()->id;
    $profileData = User::find($id);
        // Pass data to view
       return view('admin.admin_change_password',compact('profileData'));
        //return view('admin.admin_change_password');
     }
       
      public function AdminPasswordUpdateForm()
      {
        return  view ('admin.admin_change_password');
      }

 public function AdminPasswordUpdate(Request $request){
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

public function BecameInstructor(){
    return view('frontend.instructor.reg_instructor');
    //return view('frontend.register_instruction');
}
public function InstructorRegister(Request $request){
    $request-> validate([
        'name'=>['required','string','max:255'],
        'email'=>['required','unique:users'],
    ]);
    User::insert([
        'name'=> $request->name,
        'username'=> $request->username,
        'email'=> $request->email,
        'phone'=> $request->phone,
        'address'=> $request->address,
        'password'=> Hash::make($request->password),
        'role'=> 'instructor',
        'status'=> '0',
    ]);

    $notification = array(
        'message'=>' Instructored Registered Successfully ',
        'alert-type' => 'success');
return   redirect()->route('instructor.login')->with($notification);
   // return('');

}

public function Allinstructor(){
    $allinstructor = User::where('role','instructor')->latest()->get();
    return view('admin.backend.instructor.all_instructor',compact('allinstructor'));
}
// public function UpdateUserStatus(Request $request){

//       $userId =$request->input('user_id');
//       $ischecked = $request->input('is_checked',0);
      
//       $user = User::find($userId);
//       if($user){
//          $user->status =  $ischecked;
//          $user->save();
//       }
//  return response()->json(['message'=> 'User Status Updated Successfully']);
// }
//Updated  For debug
public function UpdateUserStatus(Request $request)
{
    // Log the request data
    dd($request->all());
   // dd($request->all);
    \Log::info('UpdateUserStatus request:', $request->all());

    $userId = $request->input('user_id');
    $isChecked = $request->input('is_checked', 0);

    \Log::info('UpdateUserStatus params:', [
        'userId' => $userId,
        'isChecked' => $isChecked,
    ]);

    $user = User::find($userId);
    if ($user) {
        $user->status = $isChecked;
        $user->save();
   console.log($user);
        \Log::info('User status updated:', $user->toArray());

        return response()->json(['message' => 'User Status Updated Successfully']);
    } else {
        \Log::error('User not found for ID:', $userId);
        return response()->json(['error' => 'User not found'], 404);
    }
}
}
