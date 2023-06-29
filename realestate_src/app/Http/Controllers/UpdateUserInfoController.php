<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\S_info;

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
            // if ($req->phone_no !== $user->phone_no) {
            //     $updateData['phone_no'] = 'phone_no';
            // }
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
                'name' => ['required', 'string', 'regex:/^[가-힣]+$/u', 'max:20'], // add 0624
                'email' => ['required', 'email', 'max:30',  Rule::unique('users')->ignore($user->id)],
                'u_id' =>['required', 'min:6','max:20', 'string', 'regex:/^[a-zA-Z0-9]+$/', Rule::unique('users')->ignore($user->id)],
                // 'phone_no' => ['required', 'string', 'size:11'],
                'u_addr' => ['required', 'string'],
                'seller_license' => ['nullable', 'integer', 'size:9999999999'],
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
            // if ($req->phone_no !== $user->phone_no) {
            //     $updateData['phone_no'] = 'phone_no';
            }
            if ($req->u_addr !== $user->u_addr) {
                $updateData['u_addr'] = 'u_addr';
            }
            if ($req->animal_size !== $user->animal_size) {
                $updateData['animal_size'] = 'animal_size';
            }

            
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string', 'regex:/^[가-힣]+$/u', 'max:20'], // add 0624 
                'email' => ['required', 'email', 'max:30',  Rule::unique('users')->ignore($user->id)],
                'u_id' =>['required', 'min:6','max:20', 'string',  'regex:/^[a-zA-Z0-9]+$/', Rule::unique('users')->ignore($user->id)],
                // 'phone_no' => ['required', 'string', 'size:11',],
                'u_addr' => ['required', 'string'],
                'animal_size' => ['nullable', Rule::in(['0', '1'])]
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
    

    public function printMyBuilding() {

            // $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            //     ->where('mvp_photo', '1')
            //     ->orderBy('photos.updated_at', 'desc')
            //     ->get();
    
            // return view('welcome', compact('photos', 'lastPhotoId'));
            

            $id = Auth::user()->id;
            // s_info u_no, user id로 이너조인-> $id랑 같은거 중에 s_no select함
            // $s_info = S_info::join('users', 's_infos.u_no', '=', 'users.id')
            //         ->where('s_infos.u_no', '=', $id)
            //         ->get();
            $user_info = User::join('s_infos', 'users.id', '=', 's_infos.u_no')
                ->join('photos', 's_infos.s_no', '=', 'photos.s_no')
                ->where('s_infos.u_no', '=', $id)
                ->where('mvp_photo', '1')
                ->get();
                // ->paginate(4);
                
            // collection에서 s_no만 뽑아서 array에 담음
            // $s_no = $s_info->pluck('s_no')->toArray();
            // url 배열
            // session()->put('s_info', $s_info);
            // $url = Photo::whereIn('s_no', $s_no)->where('mvp_photo', '1')->pluck('url')->toArray();

            // $url = $user_info->pluck('url')->toArray();
            // return view('profile.update-profile-information-form')->with('s_info', $s_info); // with으로 못들고옴
            return view('profile.update-profile-information-form')->with('user', $user_info);
        }

//     public function printMyBuilding(Request $request)
// { 
//     $id = auth()->user()->id;
//     $user_info = User::join('s_infos', 'users.id', '=', 's_infos.u_no')
//         ->join('photos', 's_infos.s_no', '=', 'photos.s_no')
//         ->where('s_infos.u_no', '=', $id)
//         ->where('mvp_photo', '1')
//         ->paginate(4, ['*'], 'page', $request->input('page'));

//     if ($request->ajax()) {
//         // AJAX 요청의 경우 JSON 응답 반환
//         return response()->json([
//             'html' => view('profile.update-profile-information-form', compact('user_info'))->render(),
//         ]);
//     }

//     return view('profile.update-profile-information-form', compact('user_info'));
// }
 
    
}
