<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder;
use App\Jobs\SendEmail;
use App\Libraries\Codes\ResponseCodes;
use App\Repository\OrderRepository;
use App\Service\EmailService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @param OrderRepository $orderRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(OrderRepository $orderRepository)
    {
        try {

            $result = $orderRepository->getOrders();

            return $this->sendResponse('Users all orders', $result, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {
            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);
        }
    }

    /**
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @param EmailService $emailService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrder $request, OrderRepository $orderRepository, EmailService $emailService)
    {
        $data = $request->all();

        try {

            $result = $orderRepository->storeOrder($data);

//            $order_mail = $emailService->order();
//
//            dispatch(new SendEmail($order_mail));

            return $this->sendResponse('Order created', $result, true, ResponseCodes::CREATED);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    public function cancelOrder($id, Order $orderModel)
    {
        try {

            $result = $orderModel->cancelOrder($id);

            return $this->sendResponse('Users all orders', $result, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {
            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);
        }
    }
}
