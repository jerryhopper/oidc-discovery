<?php
namespace JerryHopper\ServiceDiscovery\Services;

use JerryHopper\ServiceDiscovery\DiscoveryService;
use JerryHopper\ServiceDiscovery\Discovery;


class openidconfiguration extends DiscoveryService
{
    var $contentType = 'application/json';

    function parseToArray($string){
        $array = json_decode($string,true);
        if(array_key_exists('jwks_uri',$array)){
            $discovery = new Discovery($array['jwks_uri'],'jwks.json');
            $array['jwks_uri'] = $discovery->get();
        }
        return $array;
    }
}