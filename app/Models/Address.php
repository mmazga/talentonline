<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';
    protected $fillable = ['city', 'postcode', 'street', 'house', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAddresses()
    {
        $addresses = self::where('user_id', Auth::user()->id)->get();

        return $addresses;
    }

    /**
     * @param $data
     * @return Address
     */
    public function storeAddress($data)
    {
        $product = new self();
        $product->city = $data['city'];
        $product->street = $data['street'];
        $product->postcode = $data['postcode'];
        $product->house = $data['house'];
        $product->user_id = Auth::user()->id;

        $product->save();

        return $product;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateAddress($id, $data)
    {
        $product = self::find($id);
        $product->city = $data['city'];
        $product->street = $data['street'];
        $product->postcode = $data['postcode'];
        $product->house = $data['house'];
        $product->user_id = Auth::user()->id;

        $product->save();

        return $product;
    }
}
