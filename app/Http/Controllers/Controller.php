<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DateTime;
use DateTimeZone;
use Config;

abstract class Controller extends BaseController
{
    //use DateTime;
    use AuthorizesRequests
        , DispatchesJobs
        , ValidatesRequests;
        
    public static $datetime;
    
    //private function __construct () {}
    
    public function fromUtcToLocal ($date) 
    {
        self::$datetime = new DateTime($date, new DateTimeZone('UTC'));
        return $this;
    }
    
    public function toDate() {
        return self::$datetime->setTimeZone(new DateTimeZone(Config::get('app.timezone')));
    }
    
    public function toString() {
        $temp = self::$datetime->setTimeZone(new DateTimeZone(Config::get('app.timezone')));
        return $temp->format('Y-m-d H:i:s');
    }
    
}
