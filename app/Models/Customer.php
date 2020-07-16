<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class Customer extends Model
{

    use Notifiable;

    protected $table = 'customer';

    protected $fillable = ['name','email','password','phone','address'];

}
