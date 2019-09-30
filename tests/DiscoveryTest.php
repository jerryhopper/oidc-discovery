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
            new Discovery('https://accounts.google.com/.well-known/openid-configuration')
        );
    }
    public function testCannotBeCreatedFromInvalidOpenIdDiscoveryUrl(): void
    {
        $this->expectException(Exception::class);
        new Discovery('https://accounts.google.com/.well-known/openid-configurationnonexistent');

    }

    public function testIssuerIsEqual(): void
    {
        $result = new Discovery('https://accounts.google.com/.well-known/openid-configuration');
        $this->assertEquals(
            'https://accounts.google.com',
            $result->issuer
        );


    }

}
