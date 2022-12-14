<?php

namespace App\Classes\Api\Freekassa;

class Wallet extends Freekassa
{
    /**
     * @param $shod_id - ID магазина
     * @param $nonce - Уникальный ID запроса, должен всегда быть больше предыдущего значения
     * @param $signature - Подпись запроса
     * @param $i - ID платежной системы
     * @param $email - Email покупателя
     * @param $ip - IP покупателя
     * @param $amount - Сумма оплаты
     * @param $currency - Валюта оплаты
     * @param $payment_id - Номер заказа в Вашем магазине
     * @param $success_url - Переопределение урла успеха
     * @param $failure_url - Переопределение урла ошибки
     * @return array $result
     */
    public function payment($shod_id, $nonce, $signature, $i, $email, $ip, $amount, $currency, $payment_id = NULL, $success_url = NULL, $failure_url = NULL)
    {
        try {
            $result = $this->request('orders/create', compact('shod_id', 'nonce', 'signature', 'i', 'email', 'ip', 'amount', 'currency', 'payment_id', 'success_url', 'failure_url'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $result;
    }
}
