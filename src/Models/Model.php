<?php
namespace Genzzz\Geolocator\Models;

abstract class Model
{
    protected $db;
    protected $table;

    protected $protected = [
        'ip_from',
        'ip_to'
    ];

    abstract protected function ip_lookup($ipNumber);

    abstract protected function all_countries();

    final protected function protect_results($results)
    {
        array_filter($results, function($key){
            return !in_array($key, $this->protected); 
        }, ARRAY_FILTER_USE_KEY);

        return $results;
    }
}