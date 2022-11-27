<?php

declare(strict_types=1);

namespace shiyun\validate\handle;

use shiyun\validate\interfaces\IntfValidateHandle;
use think\Validate;
use Webman\Http\Request;

/**
 * ThinkPHP验证器处理
 */
abstract class ThinkValidate implements IntfValidateHandle
{
    /**
     * 验证器验证处理
     * @access public
     * @param Request $request
     * @param array $parameters ["data" => [], "validate" => "验证器类名", "scene" => "验证场景"]
     * @return bool|string
     */
    public static function handle(Request $request, array $parameters): bool|string
    {
        /** @var Validate $validate */
        $validate = new $parameters['validate']();

        // 验证场景
        if ($parameters['scene']) {
            $validate->scene($parameters['scene']);
        }

        // 验证数据
        if (!$validate->check($parameters['data'])) {
            /** @var array|string $result */
            $result = $validate->getError();
            return is_array($result) ? implode(',', $result) : $result;
        }

        return true;
    }
}
