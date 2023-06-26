<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserInfoController extends Controller
{
    // name, id, seller_license 변경 불가
    public function updateUserInfo (Request $req) {
        $id = Auth::user()->id;
        $user_seller = Auth::user()->seller_license;
        $user = User::find($id); // user find
        
        if($user_seller){
            $updateData = [];

            if ($req->name !== $user->name) {
                $updateData['name'] = 'name';
            }
            if ($req->email !== $user->email) {
                $updateData['email'] = 'email';
            }
            if ($req->u_id !== $user->u_id) {
                $updateData['u_id'] = 'u_id';
            }
            if ($req->phone_no !== $user->phone_no) {
                $updateData['phone_no'] = 'phone_no';
            }
            if ($req->u_addr !== $user->u_addr) {
                $updateData['u_addr'] = 'u_addr';
            }
            if ($req->seller_license !== $user->seller_license) {
                $updateData['seller_license'] = 'seller_license';
            }
            if ($req->b_name !== $user->b_name) {
                $updateData['b_name'] = 'b_name';
            }
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string', 'max:20'], // add 0624 jy 수정 안되게(같은값 넣어야 수정되게) TODO : 한글만 추가!!
                'email' => ['required', 'email', 'max:30',  Rule::unique('users')->ignore($user->id)],
                'u_id' =>['required', 'min:6','max:20', 'string',  Rule::unique('users')->ignore($user->id)],
                'phone_no' => ['required', 'string', 'min:10', 'max:11'],
                'u_addr' => ['required', 'string'],
                'seller_license' => ['nullable', 'integer', 'max:9999999999'],
                'b_name' => ['required', 'string', 'max:20']
            ]);

            if ($validator->fails()) {
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput($req->all());
                }

            foreach($updateData as $val) {

                $user->$val = $req->$val;
            }
            $user->save(); // update
            return redirect()->back();
        }
        else {
            $updateData = [];

            if ($req->name !== $user->name) {
                $updateData['name'] = 'name';
            }
            if ($req->email !== $user->email) {
                $updateData['email'] = 'email';
            }
            if ($req->u_id !== $user->u_id) {
                $updateData['u_id'] = 'u_id';
            }
            if ($req->phone_no !== $user->phone_no) {
                $updateData['phone_no'] = 'phone_no';
            }
            if ($req->u_addr !== $user->u_addr) {
                $updateData['u_addr'] = 'u_addr';
            }
            if ($req->animal_size !== $user->animal_size) {
                $updateData['animal_size'] = 'animal_size';
            }

            
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string', 'max:20'], // add 0624 jy 수정 안되게(같은값 넣어야 수정되게) TODO : 한글만 추가!!
                'email' => ['required', 'email', 'max:30',  Rule::unique('users')->ignore($user->id)],
                'u_id' =>['required', 'min:6','max:20', 'string',  Rule::unique('users')->ignore($user->id)],
                'phone_no' => ['required', 'string', 'min:10', 'max:11'],
                'u_addr' => ['required', 'string'],
                'seller_license' => ['nullable', 'integer', 'max:9999999999'],
                'animal_size' => ['nullable', 'in:0,1']
            ]);

            if ($validator->fails()) {
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput($req->all());
                }

            foreach($updateData as $val) {

                $user->$val = $req->$val;
            }
            $user->save(); // update
            return redirect()->back();
        }
    }
}