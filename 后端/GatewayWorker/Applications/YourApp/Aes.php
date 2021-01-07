<?php


class Aes
{
    public $key = '';

    public $iv = '';

    public function __construct()
    {
        $config = [
            'key'	=>	'reter4446fdfgdfgdfg', //加密key
            'iv'	=>  md5(time(). uniqid(),true), //保证偏移量为16位
            'method'	=> 'AES-128-CBC' //加密方式  # AES-256-CBC等
        ];

        foreach($config as $k => $v){
            $this->$k = $v;
        }
    }
    //加密
    public function aesEn($data){
        return  base64_encode(openssl_encrypt($data, $this->method,$this->key, OPENSSL_RAW_DATA , $this->iv));
    }

    //解密
    public function aesDe($data){
        return openssl_decrypt(base64_decode($data),  $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv);
    }
}
