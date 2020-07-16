<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Notifiable;

    protected $table = 'orders';

    protected $fillable=['id','customer_id',
        'email','phone','address','coupon_code','coupon_amount','grand_total'];

}
