<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['user_id', 'product_id', 'address_id', 'shipment_type_id', 'is_canceled'];

    public function user()
    {
        $this->hasOne(User::class);
    }

    public function product()
    {
        $this->hasOne(Product::class);
    }

    public function address()
    {
        $this->hasOne(Address::class);
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        $orders = self::where('user_id', Auth::user()->id)->get();

        return $orders;
    }

    /**
     * @param $data
     * @return Order
     */
    public function storeOrder($data)
    {
        $order = new self();
        $order->user_id = Auth::user()->id;
        $order->product_id = $data['product_id'];
        $order->address_id = $data['address_id'];
        $order->payment_type_id = $data['payment_type_id'];

        $order->save();

        return $order;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cancelOrder($id)
    {
        $order = self::find($id);
        $order->is_canceled = true;

        return $order;
    }
}
