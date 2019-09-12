<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


use JerryHopper\ServiceDiscovery\Discovery;


$discover = new Discovery("https://accounts.google.com/.well-known/openid-configuration");


print_r($discover->get());

print_r($discover->issuer);