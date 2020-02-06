<?php
namespace Genzzz\Geolocator\Tests;

use Genzzz\Geolocator\Model as BaseModel;

class Model extends BaseModel
{
    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function ip_lookup($ipNumber)
    {
        $results = [
            [
                'ip_from'      => '16777216',
                'ip_to'        => '16777471',
                'country_code' => 'US',
                'country_name' => 'United States'
            ]
        ];

        return $this->protect_results($results);
    }

    public function all_countries()
    {
        return [
            [
                'country_code' => 'US',
                'country_name' => 'United States'
            ],
            [
                'country_code' => 'AL',
                'country_name' => 'Albania'
            ],
            [
                'country_code' => 'JP',
                'country_name' => 'Japan'
            ],
            [
                'country_code' => 'IN',
                'country_name' => 'India'
            ]
        ];
    }
}