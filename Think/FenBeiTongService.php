<?php

namespace fenBeiTong\Think;

use fenBeiTong\App;
use think\Service;

class FenBeiTongService extends Service
{
    public function register()
    {
        $config = config('fenbeitong');
        if(empty($config)) {
            $config = require __DIR__.'/config.php';
        }
        $this->app->bind('fenbeitong',new App($config));
    }

    public function boot()
    {
        // 服务启动
    }

}



