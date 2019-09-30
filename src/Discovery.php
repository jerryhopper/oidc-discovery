<?php

namespace JerryHopper\ServiceDiscovery;


use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use Exception;
use GuzzleHttp;

class Discovery
{
    private $result;
    var $contentType = 'application/json';

    function __construct($discoveryurl)
    {
        $this->urlIsHttps($discoveryurl);

        $this->result = $this->test($this->start($discoveryurl)) ;
//
        //# todo jwks check.

    }

    public function xx_debugInfo(){
        return $this;
    }

    public function  _get($name) {
        // check if the named key exists in our array
        if(array_key_exists($name, $this->result)) {
            // then return the value from the array
            return $this->result[$name];
        }
        return null;
    }

    private function test($array){

        if( array_key_exists('issuer',$array)){
            if(!$this->urlIsHttps($array['issuer'])){
                throw new Exception("Insecure issuer in servicediscovery document.");
            }
        }else{
            throw new Exception("Missing required issuer in servicediscovery document.");
        }


        if( array_key_exists('userinfo_endpoint',$array)){
            if(!$this->urlIsHttps($array['userinfo_endpoint'])){
                throw new Exception("Insecure userinfo_endpoint url in servicediscovery document.");
            }
        }



        if( array_key_exists('authorization_endpoint',$array)){
            if(!$this->urlIsHttps($array['authorization_endpoint'])){
                throw new Exception("Insecure authorization_endpoint url in servicediscovery document.");
            }
        }else{
            throw new Exception("Missing required authorization_endpoint url in servicediscovery document.");
        }



        if( !array_key_exists('jwks_uri',$array)){
            throw new Exception("Missing required jwks_uri url in servicediscovery document.");
        }



        if( !array_key_exists('subject_types_supported',$array)){
            throw new Exception("Missing required subject_types_supported in servicediscovery document.");
        }

        if( !array_key_exists('response_types_supported',$array)){
            throw new Exception("Missing required response_types_supported in servicediscovery document.");
        }
        if( !array_key_exists('id_token_signing_alg_values_supported',$array)){
            throw new Exception("Missing required id_token_signing_alg_values_supported in servicediscovery document.");
        }
        return $array;

}

    private function start(String $discoveryurl){
        $data = json_decode($this->getUrl($discoveryurl),true);
        if(array_key_exists('jwks_uri',$data)){
            $data['jwks_uri']=$this->start($data['jwks_uri']);
        }
        return $data;
        /*
            // http://openid.net/specs/openid-connect-discovery-1_0.html
            // http://www.iana.org/go/rfc8414
        */
    }




    public function get(){
        return $this->result;
    }










    private function getUrl($discoveryurl){
        $client = new GuzzleHttp\Client(['http_errors' => false]);
        try {
            $res = $client->get($discoveryurl, []);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(),$e->getCode());
        }
        if ($res->getStatusCode()==404){
            throw new Exception('not found',404);
        }
        if ($res->getStatusCode()!=200){
            throw new Exception('unknown error',500);
        }
        if( $this->contentType != $this->getContentType($res->getHeader('content-type')[0])){
            throw new Exception("Incorrect content type!");
        }
        //var_dump( $res->getBody()->getContents());
        return $res->getBody()->getContents();
    }

    private function getContentType($string){
        return explode(';',$string)[0];
    }

    private function urlIsHttps($url){
        if ( strpos(strtolower($url),'https://')==0){
            return true;
        }
        throw new Exception("Insecure discovery url");
    }

}
