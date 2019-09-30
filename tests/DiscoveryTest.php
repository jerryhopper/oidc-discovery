<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JerryHopper\ServiceDiscovery\Discovery;


final class DiscoveryTest extends TestCase
{
    public function testCanBeCreatedFromValidOpenIdDiscoveryUrl(): void
    {
        $this->assertInstanceOf(
            Discovery::class,
            new Discovery('https://fusionauth.devpoc.nl/.well-known/openid-configuration/2ffcb932-4c81-cf25-2749-cfda1bfdc08f')
        );
    }
    public function testCannotBeCreatedFromInvalidOpenIdDiscoveryUrl(): void
    {
        $this->expectException(Exception::class);
        new Discovery('http://fusionauth.devpoc.nl/.well-known/openid-configuration/nonexistent');

    }

    public function testIssuerIsEqual(): void
    {
        $result = new Discovery('https://accounts.google.com/.well-known/openid-configuration');
        $this->assertEquals(
            'https://accounts.google.com',
            $result->get()['issuer']
        );


    }

}
