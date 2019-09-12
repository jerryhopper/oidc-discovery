<?php
namespace WellKnown;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class Discovery
{
    function __construct($discoveryurl,$useservice=false)
    {
        $this->_start($discoveryurl,$useservice);

    }

    function _start(String $discoveryurl,$useservice){

        $class = __NAMESPACE__.'\\Services\\'.str_replace('-','', str_replace('.','', basename($discoveryurl) ) );

        if($useservice!=false){
            $class = __NAMESPACE__.'\\Services\\'.str_replace('-','', str_replace('.','', basename($useservice) ) );
        }
        if( !class_exists( $class ) ){
            throw new \Exception("Unsupported service discovery endpoint");
        }

        $res = new $class($discoveryurl);
        $this->result = $res->get();

        /*
            // http://openid.net/specs/openid-connect-discovery-1_0.html
            // http://www.iana.org/go/rfc8414
        */
    }




    public function get(){
        return $this->result;
    }

}
