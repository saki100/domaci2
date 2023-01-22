<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function logovanje(Request $request)
    {
        $odg = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($odg){
            $authUser = Auth::user();
            $odgovor['name'] =  $authUser->name;
            $odgovor['token'] =  $authUser->createToken('Token')->plainTextToken;

            return $this->potvrda($odgovor, 'Uspesna prijava na sistem. ');
        }
        else{
            return $this->greska('Autentifikacija neuspesna.', ['error'=>'Greska pri podacima za logovanje']);
        }
    }

    public function registracija(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->greska('Greska pri validaciji', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $odgovor['name'] =  $user->name;
        $odgovor['email'] =  $user->email;

        return $this->potvrda($odgovor, 'Uspesno dodat novi korisnik u bazu.');
    }
}
