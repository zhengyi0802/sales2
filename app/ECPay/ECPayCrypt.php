<?php

namespace App\ECPay;

class ECPayCrypt{

    private $HashKey, $HashIV;

    public function __construct($HashKey, $HashIV)
    {
        $this->HashKey = $HashKey;
        $this->HashIV  = $HashIV;
    }

    public function encryptAES($plainText)
    {
        $encoded = urlencode($plainText);
        return base64_encode(openssl_encrypt($encoded, 'AES-128-CBC', $this->HashKey, OPENSSL_RAW_DATA, $this->HashIV));
    }

    public function decryptAES($encoded)
    {
        $decoded = base64_decode($encoded);
        $str = openssl_decrypt($decoded,  'AES-128-CBC', $this->HashKey, OPENSSL_RAW_DATA, $this->HashIV, "");
        $str = urldecode($str);
        return $str;
    }

}
