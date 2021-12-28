<?php

namespace App\Classes;
use StdClass;

use Illuminate\Support\Facades\Storage;

class MyClassNFe
{
    private $consumerKey        = "M4hDAfNkQijWdn8166O1qSd34QFlbrnO";
    private $consumerSecret     = "bAIg88WKWx8o6pesWHS6HTXGCFtxELsmmsgEHtWhIJYGwBma";
    private $accessToken        = "2011-aL6I0LvKVKrdsuqYXfyfy4QoDSpbCjkYBbH8YZUUUqp7Mk8D";
    private $accessTokenSecret  = "isDDxhlLfDqBaKhxqD2TFVRiq2pjT517bUZZVMmsJEyZuYjZ";



    function statusSefaz( $data = null ){
        $response = self::callAPI( 'GET', 'https://webmaniabr.com/api/1/nfe/sefaz/', $data );
        return $response;

    }

    function devolucaoNotaFiscal( $data){
        $response = self::callAPI( 'POST', 'https://webmaniabr.com/api/1/nfe/devolucao/', $data);
        return $response;

    }

    function ajusteNotaFiscal( $data ){
        $response = self::callAPI( 'POST', 'https://webmaniabr.com/api/1/nfe/ajuste/', $data );
        return $response;
    }

    function complementarNotaFiscal( $data ) {
        $response = self::callAPI( 'POST', 'https://webmaniabr.com/api/1/nfe/complementar/', $data);
        return $response;
    }
    function emissaoNotaFiscal( array $data ){

        $response = self::callAPI( 'POST', 'https://webmaniabr.com/api/1/nfe/emissao/', $data );
        return $response;

    }

    function consultaNotaFiscal( $chave ){
        $data = array();
        $data['chave'] = $chave;
        $response = self::callAPI( 'GET', 'https://webmaniabr.com/api/1/nfe/consulta/', $data );
        return $response;

    }

    function cancelarNotaFiscal( $data ){

        $response = self::callAPI( 'PUT', 'https://webmaniabr.com/api/1/nfe/cancelar/', $data );
        return $response;

    }

    function inutilizarNumeracao($data){

        $response = self::callAPI( 'PUT', 'https://webmaniabr.com/api/1/nfe/inutilizar/', $data );
        return $response;

    }

    function validadeCertificado( $data = null ){

        $data = array();
        $response = self::callAPI( 'GET', 'https://webmaniabr.com/api/1/nfe/certificado/', $data );
        return $response;

    }

    function callAPI($method, $url, $data){

        $headers = array(
            'Cache-Control: no-cache',
            'Content-Type:application/json',
            'X-Consumer-Key: '.$this->consumerKey,
            'X-Consumer-Secret: '.$this->consumerSecret,
            'X-Access-Token: '.$this->accessToken,
            'X-Access-Token-Secret: '.$this->accessTokenSecret
          );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 400);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $data ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_NONE);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT);

        $response = curl_exec($curl);
        $curl_errno = (int) curl_errno($curl);

        if ($curl_errno){
            $curl_strerror = curl_strerror($curl_errno);
        }
        curl_close($curl);
        return json_decode($response);
     }
}
