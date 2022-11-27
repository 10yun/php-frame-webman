<?php

declare(strict_types=1);

namespace shiyun\validate\interfaces;

use Webman\Http\Request;

interface IntfValidateHandle
{
    /**
     * 验证器验证处理
     * @access public
     * @param Request $request
     * @param array $parameters
     * @return bool|string
     */
    public static function handle(Request $request, array $parameters): bool|string;
}
