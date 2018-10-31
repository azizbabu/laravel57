<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage, File;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $upload_folder = 'uploads/avatars/';

        if($request->isMethod('POST')) {
            $rules = ['photo' => 'image'];

            $request->validate($rules);

            // update 
            /**
            * Upload photo
            // */
            // $upload_folder_root = 'storage/app/public/';
            // $upload_folder_main = 'uploads/avatars';
            // $upload_folder = $upload_folder_root . $upload_folder_main;
            // // check whether folder already exist if not, create folder
            // if(!file_exists($upload_folder)) {
            //     mkdir($upload_folder_main, 0755, true);
            // }

            // dd('Hello');
            /**
            * Upload photo
            */


            $extension = $request->photo->getClientOriginalExtension();
            $file_name_without_extension = str_slug(str_replace('.' . $extension, '', $request->photo->getClientOriginalName()));
            $file_name = $file_name_without_extension . '.' . strtolower($extension);
            $file_path = $upload_folder . $file_name;

            // $exists = Storage::disk('public')->exists($file_path);

            // if($exists) {
            //     Storage::disk('public')->delete($file_path);
            //     dd('Hello');
            // }else {
            //     dd('Hi');
            // }
            

            // Delete photo from upload folder && database if remove button is pressed and do not upload photo
            if(!empty($user->photo) && $request->file_remove == 'true' && !$request->hasFile('photo')) {
                $uploaded_file_name = basename($user->photo);
                
                if(Storage::disk('public')->exists($upload_folder.$uploaded_file_name)) {
                    Storage::disk('public')->delete($upload_folder.$uploaded_file_name);
                    $user->photo = null;
                }
            }

            if($request->hasFile('photo')) {
                // check if photo already exists in database
                if(!empty($user->photo)){
                    $uploaded_file_name = basename($user->photo);
                    if(Storage::disk('public')->exists($upload_folder.$uploaded_file_name)){
                        Storage::disk('public')->delete($upload_folder.$uploaded_file_name);
                    }
                }

                if(Storage::disk('public')->exists($file_path)) {
                    $file_name = $file_name_without_extension .mt_rand().'.' . strtolower($extension);
                    $file_path = $upload_folder . $file_name;
                }

                if($request->photo->storeAs('public/'.$upload_folder, $file_name)) {
                    $user->photo = $upload_folder.$file_name;
                }
            }

            // $path = $request->photo->storeAs('public/'.$upload_folder, $file_name);

            /**
            * Upload photo
            // */
            // $upload_folder = 'uploads/avatar/';
            // // check whether folder already exist if not, create folder
            // if(!file_exists($upload_folder)) {
            //     mkdir($upload_folder, 0755, true);
            // }

            $user->save();
            
        }

        // $url = url('storage/win-20170603-224024.jpg');
        // dd($url);
        return view('profile');
    }
}
