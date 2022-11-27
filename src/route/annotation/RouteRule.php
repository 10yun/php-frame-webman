<?php

declare(strict_types=1);

namespace shiyun\route\annotation;

use Attribute;
use shiyun\route\annotation\abstracts\RouteAbstract;
use shiyun\route\annotation\abstracts\RouteBase;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PARAMETER | Attribute::IS_REPEATABLE)]
class RouteRule extends RouteAbstract
{
    /**
     * @param string|array $path 路由路径 使用"/"开始则忽略控制器分组路径
     * @param string|array $methods 请求方法 例：GET 或 ['GET', 'POST']，默认为所有方法
     * @param string $name 路由名称 用于生成url的别名
     * @param array $params 路由参数
     */
    public function __construct(
        public string|array $path = '',
        public string|array $methods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD', 'OPTIONS'],
        public string       $name = '',
        public array        $params = [],
    ) {
        // 解析参数
        $this->paresArgs(func_get_args(), 'path');
    }
}



/**
 * 
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class ResourceRule extends RouteBase
{
    public function __construct(
        public ?string $name = null,
        /**
         * 请求类型
         * @Enum({"GET","POST","PUT","DELETE","PATCH","OPTIONS","HEAD"})
         */
        public string $method = 'GET',
    ) {
    }
}
