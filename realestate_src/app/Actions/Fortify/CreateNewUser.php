<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'regex:/^[가-힣]+$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/'], // Updated password rules
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'seller_license' => ['string', 'size:10'],
            'u_id' => ['required', 'string', 'unique:users', 'regex:/^[a-zA-Z0-9]{5,12}$/'],
            'phone_no' => ['required', 'string', 'size:11'],
            'u_addr' => ['required', 'string'],
            'animal_size' => ['nullable', Rule::in(['0', '1'])],
            'pw_question' => ['nullable', Rule::in(['0', '1', '2', '3', '4'])],
            'pw_answer' => ['required', 'string', 'max:10', 'regex:/^[가-힣]+$/u'],
            'b_name' => ['nullable', 'string'],
        ])->validate();

        $animalSize = isset($input['animal_size']) ? '1' : '0';
        $pwQuestion = $input['pw_question'];

        return User::create([
            'u_id' => $input['u_id'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone_no' => $input['phone_no'],
            'u_addr' => $input['u_addr'],
            'seller_license' => isset($input['seller_license']) ? $input['seller_license'] : null,
            'animal_size' => $animalSize,
            'pw_question' => $pwQuestion,
            'pw_answer' => $input['pw_answer'],
            'b_name' => isset($input['b_name']) ? $input['b_name'] : null,
        ]);
    }
}
