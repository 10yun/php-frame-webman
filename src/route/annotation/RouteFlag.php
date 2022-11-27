<?php

namespace shiyun\route\annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class RouteFlag
{
    /**
     * @param string $flag 路由标识
     */
    public function __construct(
        public string $flag = ''
    ) {
    }
}
