<?php

namespace Customers\Contracts;

interface CacheInterface
{
    public function get($key);

    public function put($key, $value, $duration);

    public function has($key);

}
