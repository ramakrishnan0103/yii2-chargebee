<?php
    namespace Ramakrishnan\Chargebee;

    use Ramakrishnan\Chargebee\Environment;
    class Paymentsource
    {
        public function payment($gateway_account_id,$customer_id)
        {
            $url = Environment::siteurl();
            $url .="/api/v2/payment_sources/create_using_temp_token";
            $curl = new curl\Curl();
            $response = $curl->setPostParams([
           "gateway_account_id"=>$gateway_account_id,
           "customer_id"=>$customer_id,
            "type"   => "card",
            ])
            ->setHeaders([
                'authorization' => 'Basic "'.Environment::authorization().'"'
            ])
            ->post($url);
            $result = json_decode($response);
            $chargebee = Chargebee::find()->where(['customer_id'=>$customer_id])->one();
            $chargebee->paymentsource_id = $result->payment_source->id;
            $chargebee->save();
            return $response;
        }
    }
?>