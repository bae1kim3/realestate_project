<?php
namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Show extends Component
{
    public $showPhoneNumberVerificationModal = false;
    public $phoneNumber;

    public function verifyPhoneNumber()
    {
        $this->validate([
            'phoneNumber' => ['required', 'string'], // 전화번호 유효성 검사 규칙을 설정합니다.
        ]);

        $phoneNumberMatches = true;
        if ($phoneNumberMatches) {

            return redirect()->route('up_pass');
        } else {
            $this->addError('phoneNumber', __('Phone number verification failed.'));
        }
    }

    public function render()
    {
        return view('profile.show');
    }
}
