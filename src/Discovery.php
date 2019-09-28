<?php

namespace JerryHopper\ServiceDiscovery;


use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use Exception;

class Discovery
{
    private $result;
    function __construct($discoveryurl,$useservice=false)
    {
        $this->_start($discoveryurl,$useservice);

    }

    public function __debugInfo(){
        return $this->result;
    }

    public function  __get($name) {
        // check if the named key exists in our array
        if(array_key_exists($name, $this->result)) {
            // then return the value from the array
            return $this->result[$name];
        }
        return null;
    }
    function _start(String $discoveryurl,$useservice){

        $class = __NAMESPACE__.'\\Services\\'.str_replace('-','', str_replace('.','', basename($discoveryurl) ) );

        if($useservice!=false){
            $class = __NAMESPACE__.'\\Services\\'.str_replace('-','', str_replace('.','', basename($useservice) ) );
        }
        if( !class_exists( $class ) ){
            throw new InvalidArgumentException("Unsupported service discovery endpoint");
        }

        $res = new $class($discoveryurl);
        $this->result = (array)$res->get();

        /*
            // http://openid.net/specs/openid-connect-discovery-1_0.html
            // http://www.iana.org/go/rfc8414
        */
    }




    public function get(){
        return $this->result;
    }

}
