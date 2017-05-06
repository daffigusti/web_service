<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    //
    public function get_users(Request $request)
    {
        $users = User::get();
//        echo $users[0]->name;

//        $users_array = [];
//        foreach($users as $user){
//            array_push($users_array,[
//                'id'=>$user->id,
//                'name'=>$user->name
//            ]);
//        }
        return response()->json($users);
    }

    public function validasi(Request $request)
    {
        $error = true;
        $message = "Uknown error";

        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where('email', $email)
            ->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $error = false;
                $message = "Validasi Sukses";
            }
        } else {
            $message = "Data is not found";
        }

        return response()
            ->json(['error' => $error, 'message' => $message, 'data' => $user]);
    }

    public function get_user(Request $request, $id)
    {
        echo $id;

        return view("welcome", ['data' => 'sdfsdf']);

    }

    public function upload_image(Request $request){
        $target_path = "uploads/";

        $user = User::find(1);

        $target_path = $target_path . basename( $_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            if($user != null){
                $user->image_path = $target_path;
                $user->save();

                Log::info(serialize($_POST));
            }
            echo "Upload and move success";
        } else {
            echo $target_path;
            echo "There was an error uploading the file, please try again!";
        }
    }
}
