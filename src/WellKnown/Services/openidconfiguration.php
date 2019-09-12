<?php


namespace WellKnown\Services;
use WellKnown\DiscoveryService;
use WellKnown\Discovery;


class openidconfiguration extends DiscoveryService
{
    var $contentType = 'application/json';

    function parseToArray($string){
        $array = json_decode($string,true);
        if(array_key_exists('jwks_uri',$array)){
            $discovery = new Discovery($array['jwks_uri'],'jwks.json');
            $array['jwks_uri'] = $discovery->result;
        }
        return $array;
    }
}
