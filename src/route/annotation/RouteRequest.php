<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use shiyun\annotation\AbstractAnnotation;
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
