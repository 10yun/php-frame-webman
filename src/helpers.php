<?php

use \Webman\Http\Response;

function sendRespSucc(string $msg = '')
{
    $currTime = time();
    $currData = date('Y-m-d H:i:s', $currTime);
    return new Response(200, [
        'Content-Type' => 'application/json'
    ], \json_encode([
        'code' => 200,
        'status' => 200,
        'msg' => $msg,
        'message' => $msg,
        'currTime' => $currTime,
        'currData' => $currData,
    ], JSON_UNESCAPED_UNICODE));
}

function sendRespError(string $msg = '')
{
    $currTime = time();
    $currData = date('Y-m-d H:i:s', $currTime);
    return new Response(200, [
        'Content-Type' => 'application/json'
    ], \json_encode([
        'code' => 404,
        'status' => 404,
        'msg' => $msg,
        'message' => $msg,
        'currTime' => $currTime,
        'currData' => $currData,
    ], JSON_UNESCAPED_UNICODE));
}
