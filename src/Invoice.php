<?php
 namespace Ramakrishnan\Chargebee;

 class Invoice
 {
     public function invoice($customer_id)
     {
        $url = Environment::siteurl();
        $url .="/api/v2/invoice/".$customer_id;
        $curl = new curl\Curl();
           $response = $curl->setPostParams([
           ])
           ->setHeaders([
              'authorization' => 'Basic "'.Environment::authorization().'"'
           ])
           ->post($url);
           
           return $response;
     }
 }
?>