<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Jjim
 *
 * @property int $s_no
 * @property int $id
 * @property string|null $liked_flg
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim whereLikedFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jjim whereSNo($value)
 */
	class Jjim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Photo
 *
 * @property int $p_no
 * @property int|null $s_no
 * @property string $url
 * @property string $hashname
 * @property string $originalname
 * @property string $mvp_photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereHashname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereMvpPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereOriginalname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereSNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo withoutTrashed()
 */
	class Photo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\S_info
 *
 * @property int $s_no
 * @property int $u_no
 * @property string $s_name
 * @property string $s_add
 * @property string $s_type
 * @property int $s_size
 * @property int $s_fl
 * @property string $s_widra
 * @property string $s_stai
 * @property string $s_log
 * @property string $s_lat
 * @property int $p_deposit
 * @property int|null $p_month
 * @property string $animal_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $hits
 * @property string $s_option
 * @method static \Database\Factories\S_infoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|S_info newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|S_info newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|S_info onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|S_info query()
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereAnimalSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info wherePDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info wherePMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSAdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSFl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSStai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereSWidra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereUNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|S_info withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|S_info withoutTrashed()
 */
	class S_info extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Seller_license_no
 *
 * @property int $license_no
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Seller_license_no newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller_license_no newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller_license_no query()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller_license_no whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller_license_no whereLicenseNo($value)
 */
	class Seller_license_no extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\State_option
 *
 * @property int $s_no
 * @property string $s_parking
 * @property string $s_ele
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|State_option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State_option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State_option onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|State_option query()
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereSEle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereSNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereSParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State_option withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|State_option withoutTrashed()
 */
	class State_option extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subway
 *
 * @property int $id
 * @property string $sub_name
 * @method static \Illuminate\Database\Eloquent\Builder|Subway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subway query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subway whereSubName($value)
 */
	class Subway extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $u_id
 * @property string $email
 * @property string $name
 * @property string $phone_no
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string $u_at
 * @property string $u_addr
 * @property int|null $seller_license
 * @property string|null $remember_token
 * @property string|null $profile_photo_path
 * @property string $animal_size
 * @property string $pw_question
 * @property string $pw_answer
 * @property string|null $b_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $facebook_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAnimalSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePwAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePwQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSellerLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

