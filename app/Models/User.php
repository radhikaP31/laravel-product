<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'gender',
        'profile_picture',
        'username',
        'password',
        'about',
        'rating',
        'status',
        'role_id',
        'token',
        'token_generate_time',
        'social_id',
        'social_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * Get the blogs for the user.
     */
    public function blogs()
    {
        return $this->hasMany(Blogs::class);
    }

    /**
     * Get the invoice for the user.
     */
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * set name 
     * @param $value string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    /**
     * Get the user's name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => ucwords($value),
        );
    }

    /**
     * Get the date of birth
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("d-M-Y", strtotime($value)),
        );
    }
}
