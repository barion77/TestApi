<?php

namespace App\Classes\Api\Freekassa;

class Freekassa
{
    const URL = 'https://api.freekassa.ru/v1/';
    const API_KEY = '';

    /**
     * @var resource
     */
    protected $handler;

    public function __construct()
    {
        $this->handler = curl_init();
        curl_setopt($this->handler, CURLOPT_RETURNTRANSFER, 1);
    }

    /**
     * @param $method - метод API
     * @param $data - тело запросв
     * @return array $response
     */
    protected function request($method, $data = [])
    {
        $url = self::URL . $method;

        $data = $this->prepareData($data);

        $request = json_encode($data);

        curl_setopt($this->handler, CURLOPT_URL, $url);
        curl_setopt($this->handler, CURLOPT_HEADER, 0);
        curl_setopt($this->handler, CURLOPT_FAILONERROR, 0);
        curl_setopt($this->handler, CURLOPT_POST, 1);
        curl_setopt($this->handler, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->handler, CURLOPT_POSTFIELDS, $request);

        $result = curl_exec($this->handler);

        $response = json_decode($result, true);

        return $response;
    }

    /**
     * @param $data
     * @return array
     */
    protected function prepareData($data = [])
    {
        ksort($data);
        $sign = hash_hmac('sha256', implode('|', $data), self::API_KEY);
        $data['signature'] = $sign;

        return $data;
    }
}
