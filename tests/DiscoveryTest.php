<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JerryHopper\ServiceDiscovery\Discovery;


final class DiscoveryTest extends TestCase
{
    public function testCanBeCreatedFromValidOpenIdDiscoveryUrl(): void
    {
        $discover = new Discovery("https://accounts.google.com/.well-known/openid-configuration");

        $this->assertInstanceOf(
            Discovery::class,
            new Discovery('https://accounts.google.com/.well-known/openid-configuration')
        );
    }

    public function testCannotBeCreatedFromInvalidOpenIdDiscoveryUrl(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Discovery('https://accounts.google.com/.well-known/errorneous-openid-configuration');
        return void;
    }

    public function testIssuerIsEqual(): void
    {
        $result = new Discovery('https://accounts.google.com/.well-known/openid-configuration');

        $this->assertEquals(
            'https://accounts.google.com',
            $result->issuer
        );
        return void;
    }

}
