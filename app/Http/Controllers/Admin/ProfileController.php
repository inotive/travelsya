<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use App\Models\User;
use App\Helpers\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use UploadFile;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function editProfile(User $profile){
        $view = [
            'data' => $profile
        ];
        return view('admin.auth.profile', $view);
    }
    public function editProfileMitra(User $profile){
        $view = [
            'data' => $profile
        ];
        return view('profile.profile', $view);
    }

    public function updateProfile(Request $request,User $profile){
        DB::beginTransaction();
        try {

            $exist = $this->user->where('name', $request->name)->where('id', '!=', $profile->id)->first();
            $emailExist = $this->user->where('email', $request->email)->where('id', '!=', $profile->id)->first();

            if ($exist !== null) {
                throw new Exception('Nama Telah Tepakai!');
            }
            if ($emailExist !== null) {
                throw new Exception('Email Telah Tepakai!');
            }

            
            $imageProfile = $profile->image; 

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('profile/' . $profile->image); 
                $image = $this->storeFile($request->file('image'), 'profile');
                $imageProfile = $image;
            }
            
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            
            if ($request->password !== null) {
                $data['password'] = bcrypt($request->password);
            }
            
            $data['image'] = $imageProfile; 
            
            $profile->fill($data);
            $profile->update();

            DB::commit();

            session()->flash('flash', [
                'message' => 'Profile Berhasil Diubah',
                'type' => 'success'
            ]);

            return redirect()->route('admin.edit-profile', $profile->id);
        } catch (Exception $e) {
         
            DB::rollBack();

            session()->flash('flash', [
                'message' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }

        return redirect()->back()->withInput();
    }
    public function updateProfileMitra(Request $request,User $profile){
        DB::beginTransaction();
        try {

            $exist = $this->user->where('name', $request->name)->where('id', '!=', $profile->id)->first();
            $emailExist = $this->user->where('email', $request->email)->where('id', '!=', $profile->id)->first();

            if ($exist !== null) {
                throw new Exception('Nama Telah Tepakai!');
            }
            if ($emailExist !== null) {
                throw new Exception('Email Telah Tepakai!');
            }

            
            $imageProfile = $profile->image; 

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('profile/' . $profile->image); 
                $image = $this->storeFile($request->file('image'), 'profile');
                $imageProfile = $image;
            }
            
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            
            if ($request->password !== null) {
                $data['password'] = bcrypt($request->password);
            }
            
            $data['image'] = $imageProfile; 
            
            $profile->fill($data);
            $profile->update();

            DB::commit();

            session()->flash('flash', [
                'message' => 'Profile Berhasil Diubah',
                'type' => 'success'
            ]);

            return redirect()->route('partner.edit-profile', $profile->id);
        } catch (Exception $e) {
         
            DB::rollBack();

            session()->flash('flash', [
                'message' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }

        return redirect()->back()->withInput();
    }
}
