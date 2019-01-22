<?php


class RequestUrl
{
     public function getBaseUrl()
     {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $request_uri = $_SERVER['REQUEST_URI'];

        if(0 === strpos($request_uri,$script_name)){
            return $script_name;
        }else if(0 === strpos($request_uri,dirname($script_name))){
            return rtrim(dirname($script_name), '/');
        }
     }

     public function getPathInfo()
     {
         $base_url = $this->getBaseUrl();
         $request_uri = $_SERVER['REQUEST_URI'];

         if(false !==($pos = strpos($request_uri, '?'))){
             //？から後ろ（？も）を削除する
             $request_uri = substr($request_uri, 0, $pos);
         }

         $path_info = (string)substr($request_uri, strlen($base_url));

         return $path_info;
     }



}