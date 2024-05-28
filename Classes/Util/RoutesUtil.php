<?php

namespace Util;

class RoutesUtil
{
    public static function getRoutes()
    {
        $urls = self::getURLs();
        $request = [];
        $request['route'] = strtoupper($urls[0]);
        $request['resource'] = $urls[1] ?? null;
        $request['filter'] = $urls[2] ?? null;
        $request['param'] = $urls[3] ?? "";
        $request['method'] = $_SERVER['REQUEST_METHOD'];

        return $request;
    }
    public static function getURLs()
    {
        $uri = str_replace('/'. DIR_PROJECT,"",$_SERVER['REQUEST_URI']);
        $uri = ltrim($uri,'desafioApi/index.php');
        return explode('/',$uri);
    }
}