<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use shiyun\annotation\AbstractAnnotation;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class RouteGet extends AbstractAnnotation
{
    protected string $methods = "GET";

    /**
     * @param string|array $path 路由路径 使用"/"开始则忽略控制器分组路径
     */
    public function __construct(
        public string $path = '',
    ) {
        // 解析参数
        $this->paresArgs([
            ...func_get_args(),
            'methods' => 'GET',
            'method' => 'GET',
        ], 'path');
        // 设置参数
        $this->setArguments([
            'methods' => 'GET'
        ]);
    }
    /**
     * @return array
     */
    public function getMethod(): array
    {
        return $this->methods;
        return explode('|', strtolower($this->methods));
    }
}
