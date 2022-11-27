<?php

namespace shiyun\route\annotation;

use shiyun\route\annotation\abstracts\RouteBase;

/**
 * 注册路由
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class RouteRule2 extends RouteBase
{
    public function __construct(
        public ?string           $name = null,
        /**
         * 请求类型
         * @Enum({"GET","POST","PUT","DELETE","PATCH","OPTIONS","HEAD"})
         */
        public string            $method = "*",
        public null|string|array $middleware = null,
        // 后缀
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
        // 单独设置路由到特定组
        public ?string           $setGroup = null,
    ) {
    }
}
