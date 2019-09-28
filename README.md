[![Build Status](https://travis-ci.org/jerryhopper/service-discovery-php.svg?branch=master)](https://travis-ci.org/jerryhopper/service-discovery-php)

# service-discovery-php




 /.well-known Service discovery helper.



<pre>

use JerryHopper\ServiceDiscovery\Discovery;

$discover = new Discovery("https://accounts.google.com/.well-known/openid-configuration");

print_r($discover->get());

</pre>
