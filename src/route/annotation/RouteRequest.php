<?php

namespace shiyun\route\annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class RouteRequest
{
    public function __construct(
        string $path = '',
        string|array $method = "*"
    ) {
    }
}
