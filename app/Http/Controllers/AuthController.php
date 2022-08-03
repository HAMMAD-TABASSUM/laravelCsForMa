<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request){

        $validator=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        // if($validator->fails()){
        //     $response=[
        //         'success'=>false,
        //         'message'=>$validator->errors()
        //     ];
        //     return response()->json($response, 400);
        // }

        // $user=User::where('email',$request->email)->first();

        // if(!$user || !Hash::check($request->password,$user->password)){
        //     return response([
        //         'error'=>["email or password is not matched"]
        //     ]);
        // }else{
        //     return response()->json([
        //         "success" => true,
        //         "User" => $user,
        //         "message" => "You are Login.",
        //         'token'=> $user->createToken("API TOKEN")->plainTextToken
        //     ]);
        // }
           if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
                // $request->session()->regenerate();
                $response=[
                    'success'=>true,
                    'data'=>$success,
                    'message'=>'User Login Successfull'
                ];
                return response()->json($response, 400);
           }else{
            $response=[
                'success'=>false,
                'message'=>'Unauthorized'
            ];
            return response()->json($response);
           }
    }

    public function adminRegister(Request $request){
        // return $request->input();
        
        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
            // 'confirm_password' => 'required|same:password'
        ]);
        
        $user=new User;
        $user->districtId=$request->input('district_Id');
        $user->profileImage=$request->file('profileImage')->store('profilePic');
        $user->districtName=$request->input('districtName');
        $user->address=$request->input('address');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->fullName=$request->input('fullName');
        $user->typeSchoolName=$request->input('typeSchoolName');
        $user->selectRole=$request->input('selectRole');
        $user->typeEmail=$request->input('typeEmail');
        $user->save();
        return response()->json([
            "success" => true,
            "User" => $user,
            "message" => "Registered as a admin"
        ]);
    }

    public function instructorRegister(Request $request){

        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
            // 'password_confirm' => 'required|same:password'
        ]);
        
        $user=new User;
        $user->profileImage=$request->file('profileImage')->store('profilePic');
        $user->firstName=$request->input('firstName');
        $user->lastName=$request->input('lastName');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->phoneNumber=$request->input('phoneNumber');
        $user->address=$request->input('address');
        $user->city=$request->input('city');
        $user->state=$request->input('state');
        $user->zipCode=$request->input('zipCode');
        $user->resume=$request->file('resume')->store('Docs');
        $user->bio=$request->input('bio');
        $user->save();
        return response()->json([
            "success" => true,
            "User" => $user,
            "message" => "Registered as Instructor."
        ]);
    }

    public function educatorsRegister(Request $request){

        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
            // 'password_confirm' => 'required|same:password'
        ]);
        
        $user=new User;
        $user->profileImage=$request->file('profileImage')->store('profilePic');
        $user->firstName=$request->input('firstName');
        $user->lastName=$request->input('lastName');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->semail=$request->input('semail');
        $user->address=$request->input('address');
        $user->address2=$request->input('address2');
        $user->city=$request->input('city');
        $user->state=$request->input('state');
        $user->zipCode=$request->input('zipCode');
        $user->phoneNumber=$request->input('phoneNumber');
        $user->schoolDistrict=$request->input('schoolDistrict');
        $user->schoolName=$request->input('schoolName');
        $user->schoolSetting=$request->input('schoolSetting');
        $user->schoolType=$request->input('schoolType');
        $user->primaryRole=$request->input('primaryRole');
        $user->studentAverage=$request->input('studentAverage');
        $user->primaryArea=$request->input('primaryArea');
        $user->teachingGrades=$request->input('teachingGrades');
        $user->programmingExperience=$request->input('programmingExperience');
        $user->race=$request->input('race');
        $user->person=$request->input('person');
        $user->save();
        return response()->json([
            "success" => true,
            "User" => $user,
            "message" => "Registered as a Eduactors."
        ]);
    }

    public function updateinstructor(Request $request){
        $request->validate([
            'email'=>'required|email|unique:users',
            // 'password'=>'required|min:5',
            // 'password_confirm' => 'required|same:password'
        ]);
        $user=User::find($request->id);
        $user->profileImage=$request->file('profileImage')->store('profilePic');
        $user->firstName=$request->input('firstName');
        $user->lastName=$request->input('lastName');
        $user->email=$request->input('email');
        $user->phoneNumber=$request->input('phoneNumber');
        $user->address=$request->input('address');
        $user->city=$request->input('city');
        $user->state=$request->input('state');
        $user->zipCode=$request->input('zipCode');
        $user->resume=$request->file('resume')->store('Docs');
        $user->bio=$request->input('bio');
        // $user->password=Hash::make($request->input('password'));
        $user->save();
        return response()->json([
            "success" => true,
            "User" => $user,
            "message" => "Updated instructor Profile."
        ]);
    }

    public function updateeducators(Request $request){

        $validate=$request->validate([
            // 'email'=>'required|email|unique:users',
            'old_password'=>'required',
            'password'=>'required|min:5',
            // 'confirm_password' => 'required|same:password'
        ]);

        if($validate->fails()){
            return response()->json([
                'message'=>'validations fail',
                'errors'=>$validate->errors()
            ],422);
        }

        // $user=$request->user();
        
        // if(Hash::check($request->old_password, $user->password)){
        //     $user->update([
        //         'password'=>Hash::make($request->password)
        //     ]);
        //     return response()->json([
        //         'message'=>'Password successfully changed',
        //     ],200);

        // }else{
        //     return response()->json([
        //         'message'=>'Old Password does not match',
        //     ],422);
        // }
        
        $user=User::find($request->id);
        $user->profileImage=$request->file('profileImage')->store('profilePic');
        $user->firstName=$request->input('firstName');
        $user->lastName=$request->input('lastName');
        $user->email=$request->input('email');
        $user->semail=$request->input('semail');
        $user->address=$request->input('address');
        $user->address2=$request->input('address2');
        $user->city=$request->input('city');
        $user->state=$request->input('state');
        $user->zipCode=$request->input('zipCode');
        $user->phoneNumber=$request->input('phoneNumber');
        $user->schoolDistrict=$request->input('schoolDistrict');
        $user->schoolName=$request->input('schoolName');
        $user->schoolSetting=$request->input('schoolSetting');
        $user->schoolType=$request->input('schoolType');
        $user->primaryRole=$request->input('primaryRole');
        $user->studentAverage=$request->input('studentAverage');
        $user->primaryArea=$request->input('primaryArea');
        $user->teachingGrades=$request->input('teachingGrades');
        $user->programmingExperience=$request->input('programmingExperience');
        $user->race=$request->input('race');
        $user->person=$request->input('person');
        // $user->password=Hash::make($request->input('password'));
        $user->save();
        return response()->json([
            "success" => true,
            "User" => $user,
            "message" => "Registered as a Eduactors."
        ]);
    }

    public function logout(){
        Auth::logout();
        return "You are logout";
    }
}