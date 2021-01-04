<?php


namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * @param $data
     * @return array|\Exception
     */
    public function storeOrder($data)
    {
        $orderModel = new Order();
        $saved_orders = [];

        DB::beginTransaction();
        try {
            foreach ($data['product_ids'] as $product_id) {

                $data['product_id'] = $product_id;

                $result = $orderModel->storeOrder($data);

                array_push($saved_orders, $result);
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e;
        }

        return $saved_orders;
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        $result = Order::where('orders.user_id', Auth::user()->id)
            ->leftJoin('addresses as a', 'orders.address_id', '=', 'a.id')
            ->leftJoin('products as p', 'orders.product_id', '=', 'p.id')
            ->leftJoin('payment_types as pt', 'orders.payment_type_id', '=', 'pt.id')
            ->select('a.city', 'a.street', 'a.postcode', 'a.house', 'p.title as product')
            ->get();

        return $result;
    }
}
