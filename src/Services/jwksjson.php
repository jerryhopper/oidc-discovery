<?php
namespace JerryHopper\ServiceDiscovery\Services;

use JerryHopper\ServiceDiscovery\DiscoveryService;
use JerryHopper\ServiceDiscovery\Discovery;

class jwksjson extends DiscoveryService
{
    var $contentType = 'application/json';

    function parseToArray($string){

        return json_decode($string,true);
    }
}