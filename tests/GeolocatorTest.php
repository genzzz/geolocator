<?php
use PHPUnit\Framework\TestCase;

use Genzzz\Geolocator\Tests\Geolocator;

class GeolocatorTest extends TestCase
{
    public function test_create_geolocator_instance()
    {
        $geolocator = new Geolocator();
        $this->assertInstanceOf(Geolocator::class, $geolocator);

        return $geolocator;
    }

    /**
     * @depends test_create_geolocator_instance
     */
    public function test_all_countries_function(Geolocator $geolocator)
    {
        $this->assertNotNull($geolocator->all_countries());
        $this->assertCount(4, $geolocator->all_countries());
        $this->assertSame(['country_code' => 'US','country_name' => 'United States'], $geolocator->all_countries()[0]);
    }

    /**
     * @depends test_create_geolocator_instance
     */
    public function test_search_ip_function(Geolocator $geolocator)
    {
        $this->assertNotNull($geolocator->search_ip('111.211.123.221'));
        $this->assertArrayHasKey('ip_address', $geolocator->search_ip('111.211.123.221'));
        $this->assertArrayHasKey('ip_version', $geolocator->search_ip('111.211.123.221'));
    }
}