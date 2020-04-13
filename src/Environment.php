<?php
     namespace Ramakrishnan\Chargebee;

     class Environment
     {
        protected  static $authorization;
        private static $url;

         public function configuration($url,$authorization)
         {
            Environment::$url=$url;
            Environment::$authorization = $authorization;
         }
         public function siteurl()
         {
            return Environment::$url;
         }
         public function authorization()
         {
            return Environment::$authorization;
         }
     }
?>