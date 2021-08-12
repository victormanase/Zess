<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getApiTokenAttribute($value)
    {
        if($value == null){
            $user = User::find($this->id);
            $user->api_token = Str::random(256);
            $user->save();
            return $user->api_token;
        }
        return $value;
    }

    /**
     * Get the patient associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class, 'user_id', 'id');
    }

    /**
     * Get the client associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'user_id', 'id');
    }

    /**
     * Get the doctor associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class, 'user_id', 'id');
    }

    public function setPasswordAttribute($value)
    {
        if(!blank($value)){
            $this->attributes["password"] = bcrypt($value);
        }
    }
}
