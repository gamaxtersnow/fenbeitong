<?php

namespace fenBeiTong\bridge;


use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    public function get($key, $default = null)
    {
        return \think\facade\Cache::get($key, $default);
    }

    public function set($key, $value, $ttl = null)
    {
        \think\facade\Cache::set($key, $value, $ttl);
    }

    public function delete($key)
    {
        \think\facade\Cache::delete($key);
    }

    public function clear()
    {
        \think\facade\Cache::clear();
    }

    public function getMultiple($keys, $default = null)
    {
        \think\facade\Cache::getMultiple($keys, $default);
    }

    public function setMultiple($values, $ttl = null)
    {
        \think\facade\Cache::setMultiple($values, $ttl);
    }

    public function deleteMultiple($keys)
    {
        \think\facade\Cache::deleteMultiple($keys);
    }

    public function has($key): bool
    {
        return \think\facade\Cache::has($key);
    }
}

