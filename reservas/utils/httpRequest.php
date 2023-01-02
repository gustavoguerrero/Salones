<?php 
    require '../utils/autoload.php';
    function HttpRequest($url,$method,$parametros=null){
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);   
            if($method === "post"){
                foreach ($parametros as $clave => $valor)
                    $postData = $postData . "$clave=$valor&";
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS,$postData);
            }
            $data = curl_exec($curl);
            curl_close($curl);
            return json_decode($data,true);
            
        }
