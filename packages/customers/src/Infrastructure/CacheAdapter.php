<?php

namespace Customers\Infrastructure;

use Customers\Contracts\CacheInterface;
use Illuminate\Support\Facades\Cache;

class CacheAdapter implements CacheInterface
{
    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return Cache::get($key);
    }

    /**
     * @param $key
     * @param $value
     * @param $duration
     */
    public function put($key, $value, $duration)
    {
        Cache::put($key, $value, $duration);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return Cache::has($key);
    }
}
