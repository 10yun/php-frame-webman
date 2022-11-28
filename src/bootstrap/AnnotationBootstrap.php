<?php

declare(strict_types=1);

namespace shiyun\bootstrap;

use shiyun\annotation\AnnotationParse;
use shiyun\route\RouteAttriLoad;
use Webman\Bootstrap;

class AnnotationBootstrap implements Bootstrap
{
    protected static array $defaultConfig = [
        'include_paths' => [
            'app',
        ],
        'exclude_paths' => [],
        'route' => [
            'use_default_method' => true,
        ],
    ];

    /**
     * 进程名称
     * @var string
     */
    protected static string $workerName = '';

    /**
     * 注解配置
     * @var array
     */
    public static array $config = [];

    /**
     * @param $worker
     * @return void
     * @throws ReflectionException
     */
    public static function start($worker)
    {
        // monitor进程不执行
        //if ($worker?->name == 'monitor') {
        //   return;
        //}

        // 跳过忽略的进程
        if (!$worker || self::isIgnoreProcess(self::$workerName = $worker->name)) {
            return;
        }

        // 获取配置
        self::$config = config('plugin.shiyun.webman.annotation', []);
        $config = self::$config = array_merge(self::$defaultConfig, self::$config);

        RouteAttriLoad::loader();

        // 注解扫描
        $generator = AnnotationParse::scanAnnotations($config['include_paths'], $config['exclude_paths']);
        // 解析注解
        AnnotationParse::parseAnnotations($generator);
    }

    /**
     * 是否为忽略的进程
     * @param string|null $name
     * @return bool
     */
    public static function isIgnoreProcess(string $name = null): bool
    {
        if (empty($name)) {
            $name = self::$workerName;
        }

        return in_array($name, [
            '',
            'monitor',
        ]);
    }

    /**
     * 获取进程名称
     * @return string
     */
    public static function getWorkerName(): string
    {
        return self::$workerName;
    }
}
