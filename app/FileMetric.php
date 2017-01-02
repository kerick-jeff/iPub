<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileMetric extends Model
{
    private static $bytes;
    private static $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    public static function represent($bytes){
        static::$bytes = $bytes;

        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.2f %s", (static::$bytes / pow(1024, $factor)), static::$units[$factor]);
    }
}
