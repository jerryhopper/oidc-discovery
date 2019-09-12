<?php
namespace JerryHopper\ServiceDiscovery;

class DiscoveryService {

    function __construct($discoveryurl)
    {
        $data = $this->getUrl($discoveryurl);
        $this->result = $this->parseToArray($data) ;

    }
    public function get(){
        return $this->result;
    }

    private function getContentType($string){
        return explode(';',$string)[0];
    }

    private function getUrl($discoveryurl){
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        try {
            $res = $client->get($discoveryurl, []);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(),$e->getCode());
        }
        if ($res->getStatusCode()==404){
            throw new \Exception('not found',404);
        }
        if ($res->getStatusCode()!=200){
            throw new \Exception('unknown error',500);
        }
        //->getBody()->getContents();
        //echo $this->getContentType($res->getHeader('content-type')[0]);
        if( $this->contentType != $this->getContentType($res->getHeader('content-type')[0])){
            throw new \Exception("Incorrect content type!");
        }
        //echo $res->getBody();
        return $res->getBody()->getContents();
    }

}