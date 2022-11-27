<?php

namespace shiyun\route\annotation;

use shiyun\route\annotation\abstracts\RouteBase;

/**
 * 路由分组
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class RouteGroup2 extends RouteBase
{
    public function __construct(
        public ?string           $name = null,
        public null|string|array $middleware = null,
        // ==== 通用参数 ====
        public ?string           $ext = null,
        public ?string           $deny_ext = null,
        public ?bool             $https = null,
        public ?string           $domain = null,
        public ?bool             $complete_match = null,
        public null|string|array $cache = null,
        public ?bool             $ajax = null,
        public ?bool             $pjax = null,
        public ?bool             $json = null,
        public ?array            $filter = null,
        public ?array            $append = null,
        public ?array            $pattern = null,
        // ==== 特殊参数 ====
        public int               $registerSort = 1000,
    ) {
    }
}
