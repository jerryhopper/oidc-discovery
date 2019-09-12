<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


use WellKnown\Discovery;


$discover = new Discovery("https://account.trustmaster.org/.well-known/openid-configuration");

print_r($discover->get());
