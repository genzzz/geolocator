<?php
namespace Genzzz\Geolocator;

abstract class Model
{
    protected $db;
    protected $table;

    protected $protected = [
        'ip_from',
        'ip_to'
    ];

    /**
     * Query:
     * SELECT * FROM $this->table WHERE ip_from <= $ipNumber AND $ipNumber <= ip_to LIMIT 1
     */
    abstract protected function ip_lookup($ipNumber);

    /**
     * Qeury:
     * SELECT country_code, country_name FROM $this->table GROUP BY country_name
     */
    abstract protected function all_countries();

    final protected function protect_results($results)
    {
        array_filter($results, function($key){
            return !in_array($key, $this->protected);
        }, ARRAY_FILTER_USE_KEY);

        return $results;
    }
}