<?php

namespace Crypt4\JantungLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Crypt4\JantungLaravel\Jantung
 */
class Jantung extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Crypt4\JantungLaravel\Jantung::class;
    }
}
