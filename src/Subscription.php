<?php
   namespace Ramakrishnan\Chargebee;
    
   use linslin\yii2\curl;
   use Ramakrishnan\Chargebee\Environment;
   use Ramakrishnan\Chargebee\Chargebee;
   use yii\helpers\json;

   class Subscription {
      public function subscription($customer_first_name,$customer_last_name,$address,$state,$pincode,$country,$email,$plan_id)
      {
         $url = Environment::siteurl();
         $url .="/api/v2/subscriptions";
         $curl = new curl\Curl();
            $response = $curl->setPostParams([
               'plan_id' => $plan_id,
               'autoCollection' => 'on',
               "billingAddress" =>[
                    "firstName" => $customer_first_name,
                    "lastName" => $customer_last_name,
                    "line1" => "",
                     "city" => $address,
                    "state" => $state,
                    "zip" => $pincode,
                    "country" => $country
                ],
                "customer" => [
                    "firstName" =>  $customer_first_name,
                    "lastName" => $customer_last_name,
                    "email" => $email
                ],
                  
            ])
            ->setHeaders([
               'authorization' => 'Basic "'.Environment::authorization().'"'
            ])
            ->post($url);
         
      $result = json_decode($response);
      $chargebee = Chargebee::find()->where(['customer_email'=>$result->customer->email])->one();
      if(empty($chargebee))
      {
        $chargebee = new Chargebee();
        $chargebee->customer_id = $result->subscription->customer_id;
        $chargebee->subscription_id = $result->subscription->id;
        $chargebee->customer_email = $result->customer->email;
        $chargebee->save();
      }
      else
      {
        $chargebee->customer_id = $result->subscription->customer_id;
        $chargebee->subscription_id = $result->subscription->id;
        $chargebee->customer_email = $result->customer->email;
        $chargebee->save();
      }
      return $response;
      
      }
      public function deletesubscription($subscription_id,$customer_id)
      {
        $url = Environment::siteurl();
        $url .="/api/v2/subscriptions/".$subscription_id."/delete";
        $curl = new curl\Curl();
        $response = $curl->setPostParams([
               
            ])
            ->setHeaders([
               'authorization' => 'Basic "'.Environment::authorization().'"'
            ])
            ->post($url);

        $url1 = Environment::siteurl();
        $url1 .="/api/v2/customers/".$customer_id."/delete";
        $curl = new curl\Curl();
        $response = $curl->setPostParams([
               
            ])
            ->setHeaders([
               'authorization' => 'Basic "'.Environment::authorization().'"'
            ])
            ->post($url1);
            return $response;
      }
      public function updatesubscription($subscription_id,$addons_id,$addons_quantity)
      {
        $url = Environment::siteurl();
         $url .="/api/v2/subscriptions/".$subscription_id;
         
         foreach ($addons_id as $key => $value)
         {
          $curl = new curl\Curl();
           $response = $curl->setPostParams([
               'addons[id][0]'=>$value,
               'addons[quantity][0]'=> $addons_quantity[$key],
            ])
            ->setHeaders([
               'authorization' => 'Basic "'.Environment::authorization().'"'
            ])
            ->post($url);
         }
         return $response;
            
      }
   }
?>