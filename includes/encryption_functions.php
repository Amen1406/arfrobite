<?php


///User id encryption system
class IdEncrypt{
    
    function useridDecrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'swag will naver fade away kraa';
        $secret_iv = 'swag will naver fade away kraa';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        
        return $output;
    }
    
    
    
    function useridEencrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'swag will naver fade away kraa';
        $secret_iv = 'swag will naver fade away kraa';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
      
        return $output;
    }
    
   
}