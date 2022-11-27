<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use shiyun\annotation\AbstractAnnotation;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class RoutePut extends AbstractAnnotation
{
    protected string $method = "PUT";

    /**
     * @param string|array $path 路由路径 使用"/"开始则忽略控制器分组路径
     */
    public function __construct(
        public string $path = '',
    ) {
        // 解析参数
        $this->paresArgs(func_get_args(), 'path');
    }
}
