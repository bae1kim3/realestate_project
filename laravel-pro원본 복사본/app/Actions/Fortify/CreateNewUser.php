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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'seller_license' => ['string'],
            'u_id' => ['required', 'string', 'unique:users'],
            'phone_no' => ['required', 'string'],
            'u_addr' => ['required', 'string'],
            'animal_size' => ['nullable', Rule::in(['0', '1'])],
            'pw_question' => ['nullable', Rule::in(['0', '1', '2', '3', '4'])],
            'pw_answer' => ['required', 'string'],
            'b_name' => ['string'],
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
