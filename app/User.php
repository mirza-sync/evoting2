<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OTPNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'matric_no', 'phone_no', 'email', 'faculty', 'password', 'isVerified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function votesMany() {
        return $this->belongsToMany('App\Candidate', 'votes', 'student_id', 'candidate_id');
    }

    public function OTP(){
        return Cache::get($this->OTPKey());
    }

      /**
       * @test
       */
      public function OTPKey()
      {
         return "OTP_for_{$this->id}";
      }
    

    public function cacheTheOTP()
    {
        $OTP = rand(100000, 999999);
        Cache::put([$this->OTPKey() => $OTP], now()->addSeconds(60));
        return $OTP;
    }

    public function sendOTP($via)
    {
        $OTP = $this->cacheTheOTP();
        $this->notify(new OTPNotification($via, $OTP));
        // if($via == 'via_sms') { 
        // }else {
        //     Mail::to('nik.mahraz@gmail.com')->send(new OTPMail($this->cacheTheOTP()));
        // }
    }

    public function routeNotificationForKarix()
    {
        return $this->phone_no;
    }
}