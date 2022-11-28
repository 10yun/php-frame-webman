<?php

namespace shiyun\route;

use Webman\Exception\ExceptionHandlerInterface;
use Psr\Log\LoggerInterface;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;

class RouteException implements ExceptionHandlerInterface
{
    /**
     * @param Throwable $e
     * @return mixed
     */
    public function report(Throwable $e)
    {
    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render(Request $request, Throwable $e): Response
    {
    }
}
