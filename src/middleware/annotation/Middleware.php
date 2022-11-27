<?php

declare(strict_types=1);

namespace shiyun\middleware\annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middleware extends AbstractAnnotation
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
