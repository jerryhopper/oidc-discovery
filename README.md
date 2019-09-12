# service-discovery-php

service discovery helper.


<pre>

use JerryHopper\ServiceDiscovery\Discovery;

$discover = new Discovery("https://accounts.google.com/.well-known/openid-configuration");

print_r($discover->get());

</pre>
