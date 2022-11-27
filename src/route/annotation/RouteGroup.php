<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use Attribute;
use shiyun\annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class RouteGroup extends AbstractAnnotation
{
    /**
     * @param string|array $prefix 路由分组路径
     */
    public function __construct(
        public string|array $prefix = ''
    ) {
        // 解析参数
        $this->paresArgs(func_get_args(), 'prefix');
    }
}
