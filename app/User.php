<?php

namespace App;

use App\Entities\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permissions\HasPermissionsTrait;
class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){

        return $this->type === self::ADMIN_TYPE;
    }

    public function favoriteProducts(){
        return $this->belongsToMany(Product::class, 'user_favor_products')
              ->withTimestamps()
              ->orderBy('user_favor_products.created_at', 'desc');
    }

}
