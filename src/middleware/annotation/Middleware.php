<?php

declare(strict_types=1);

namespace shiyun\middleware\annotation\common;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middleware extends MiddlewareAbstract
{
    /**
     * @var string
     */
    public $middleware = '';

    public function __construct(...$value)
    {
        $this->bindMainProperty('middleware', $value);
        $this->middleware = $value;
    }
}
