<?php

declare(strict_types=1);

namespace shiyun\middleware\annotation;

use Attribute;

#[Attribute]
class Middlewares extends AbstractAnnotation
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
    protected function formatParams($value): array
    {
        if (isset($value[0])) {
            $value = $value[0];
        }
        if (!is_array($value)) {
            $value = ['value' => $value];
        }
        return $value;
    }
    protected function bindMainProperty(string $key, array $value)
    {
        $formattedValue = $this->formatParams($value);
        if (isset($formattedValue['value'])) {
            $this->{$key} = $formattedValue['value'];
        }
    }
}
