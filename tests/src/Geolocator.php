<?php
namespace Genzzz\Geolocator\Tests;

use Genzzz\Geolocator\Geolocator as Main;
use Genzzz\Geolocator\Tests\Model;

class Geolocator extends Main
{
    public function __construct()
    {
        $this->set_config(['db_version' => 4]);
        $this->set_model(new Model('db', 'test'));
    }
}