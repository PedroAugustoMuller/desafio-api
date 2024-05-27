<?php

namespace Util;

use Exception;
use JsonException;

class JsonUtil
{
    public static function treatJsonBody()
    {
        try
        {

            $postJson = json_decode(file_get_contents('php://input'), true);
        } catch( JsonException $e)
        {
            throw new \InvalidArgumentException(GenericConstantsUtil::MSG_ERR0_JSON_VAZIO);
        }

        if(is_array($postJson) && count($postJson) > 0)
        {
            return $postJson;
        }
    }
}