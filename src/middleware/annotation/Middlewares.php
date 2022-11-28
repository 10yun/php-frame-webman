<?php

declare(strict_types=1);

namespace shiyun\middleware\annotation\common;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middlewares extends MiddlewareAbstract
{
    /**
     * @var Middleware[]
     */
    public array $middlewares = [];

    public function __construct(...$value)
    {
        if (is_string($value[0])) {
            $middlewares = [];
            foreach ($value as $middlewareName) {
                $middlewares[] = new Middleware($middlewareName);
            }
            $value = ['value' => $middlewares];
        }
        $this->bindMainProperty('middlewares', $value);
    }
}
