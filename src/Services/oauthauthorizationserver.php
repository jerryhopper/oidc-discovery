<?php
namespace JerryHopper\ServiceDiscovery\Services;

use JerryHopper\ServiceDiscovery\DiscoveryService;
use JerryHopper\ServiceDiscovery\Discovery;
use Exception;


class oauthauthorizationserver extends DiscoveryService
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

    function test($array){
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


    }

}