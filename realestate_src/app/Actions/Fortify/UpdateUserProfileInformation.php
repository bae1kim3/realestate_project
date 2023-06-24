<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:20', 'same:'.$this->$user->name], // add 0624 jy 수정 안되게(같은값 넣어야 수정되게) TODO : 한글만 추가!!
            'email' => ['required', 'email', 'max:30', 'uniqe:users'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'u_id' =>['required', 'min:6|max:20', 'string', 'unique:users', 'same:'.$this->$user->u_id],
            'phone_no' => ['required', 'integer'],
            'u_addr' => ['required', 'string'],
            'seller_license' => ['nullable', 'integer', 'max:10'],
            'animal_size' => ['nullable', Rule::in(['0', '1'])],
            'b_name' => ['nullable', 'string', 'max:20']
            // TODO 추가해야 될거: u_id(unique), phone_no, u_addr, seller_license, animal_size, b_name
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
