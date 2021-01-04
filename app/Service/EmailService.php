<?php


namespace App\Service;

use Illuminate\Support\Facades\Auth;

class EmailService
{
    public function order()
    {
        $html = '<h3>Ваш заказ оформлен!</h3>';

        $subject = "Спасибо за заказ";

        $data = ['html' => $html, 'subject' => $subject, 'email' => Auth::user()->email];

        return $data;
    }
}
