<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use shiyun\annotation\AbstractAnnotation;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class RouteFlag extends AbstractAnnotation
{
    /**
     * @param string $flag 路由标识
     */
    public function __construct(
        public string $flag = ''
    ) {
        // 解析参数
        $this->paresArgs(func_get_args(), 'flag');
    }
}
