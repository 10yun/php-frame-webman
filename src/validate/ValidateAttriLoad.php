<?php

declare(strict_types=1);

namespace shiyun\validate;

use shiyun\annotation\IntfAnnotationLoad;

/**
 * 验证注解加载
 */
class ValidateAttriLoad implements IntfAnnotationLoad
{
    public static function loader(): void
    {
    }
}
