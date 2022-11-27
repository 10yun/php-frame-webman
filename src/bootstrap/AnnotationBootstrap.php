<?php

declare(strict_types=1);

namespace shiyun\bootstrap;

use shiyun\annotation\AnnotationParse;
use shiyun\route\annotation\RouteGroup;
use shiyun\route\annotation\Middleware;
use shiyun\route\annotation\Route;
use shiyun\route\RouteAnnotationHandle;
use shiyun\validate\annotation\Validate;
use shiyun\validate\ValidateAnnotationHandle;
use Webman\Bootstrap;

class AnnotationBootstrap implements Bootstrap
{
    protected static array $defaultConfig = [
        'include_paths' => [
            'app',
        ],
        'exclude_paths' => [],
    ];

    public static array $config = [];

    public static function start($worker)
    {
        // monitor进程不执行
        if ($worker?->name == 'monitor') {
            return;
        }

        // 获取配置
        self::$config = config('plugin.linfly.annotation.annotation', []);
        $config = self::$config = array_merge(self::$defaultConfig, self::$config);

        self::createAnnotationHandle();

        // 注解扫描
        $generator = AnnotationParse::scan($config['include_paths'], $config['exclude_paths']);
        // 解析注解
        AnnotationParse::parseAnnotations($generator);
    }
    protected static function createAnnotationHandle()
    {
        // 控制器注解
        AnnotationParse::addHandle(RouteGroup::class, RouteAnnotationHandle::class);
        // 路由注解
        AnnotationParse::addHandle(Route::class, RouteAnnotationHandle::class);
        // 中间件注解
        AnnotationParse::addHandle(Middleware::class, RouteAnnotationHandle::class);
        // 验证器注解
        AnnotationParse::addHandle(Validate::class, RouteAnnotationHandle::class);
    }
}
