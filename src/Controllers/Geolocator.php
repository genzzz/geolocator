<?php
namespace Genzzz\Geolocator\Controllers;

class Geolocator
{
    protected $model;

    protected $config;

    public function __construct()
    {
        $this->config = config('ip2location');
    }

    public function all_countries()
    {
        return $this->model->get_all_countries();
    }

    public function search_ip($ip)
    {
        if(!$version = $this->ip_validator($ip))
            return;
        
        $ipAttributes = $this->ip_attributes($ip, $version);
        if(is_null($ipAttributes))
            return;

        list($ipVersion, $ipNumber) = $ipAttributes;

        $result = $this->model->ip_lookup($ipNumber);

        $data = [
            'ip_address' => $ip,
            'ip_version' => $ipVersion
        ];

        return array_merge($data, $result);
    }

    private function ip_attributes($ip, $version)
    {
        if($this->config['db_version'] == 4)
            return [$version, ip2long($ip)];
        
        if($this->config['db_version'] == 6){
            if($version == 4)
                $ip = '::FFFF:' . $ip;
        }
        
        $result = 0;
        foreach (str_split(bin2hex(inet_pton($ip)), 8) as $word){
            $result = bcadd(bcmul($result, '4294967296', 0), $this->for_IPv6(hexdec($word)), 0);
        }

        $ipNumber = $result;
        return [$version, $ipNumber];
    }

    private function ip_validator($ip)
    {
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            return 4;
        }
        elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
            return 6;
        }

        return false;
    }

    private function for_IPv6($x)
    {
        return $x + ($x < 0 ? 4294967296 : 0);
    }
}