<?php


namespace WellKnown\Services;

use WellKnown\DiscoveryService;
use WellKnown\Discovery;

class jwksjson extends DiscoveryService
{
    var $contentType = 'application/json';

    function parseToArray($string){

        return json_decode($string,false);
    }
}
