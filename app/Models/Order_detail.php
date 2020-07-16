<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class Order_detail extends Model
{

    use Notifiable;

    protected $table = 'order_detail';

    protected $fillable = ['order_id','product_id','quantity','price'];

}
