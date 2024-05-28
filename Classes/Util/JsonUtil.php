<?php

namespace Util;

use InvalidArgumentException;
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
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERR0_JSON_VAZIO);
        }

        if(is_array($postJson) && count($postJson) > 0)
        {
            return $postJson;
        }
    }
    
    public function processArray($array)
    {
        $data = [];
        $data[GenericConstantsUtil::TIPO] = GenericConstantsUtil::TIPO_ERRO;
        if((is_array($array) && count($array) > 0) || strlen($array)>10)
        {
            $data[GenericConstantsUtil::TIPO] = GenericConstantsUtil::TIPO_SUCESSO;
            $data[GenericConstantsUtil::RESPOSTA] = $array;
        }
        $this->returnJson($data);

    }

    private function returnJson($json)
    {
       header('Content-Type:application/json');
       header('Cache-Control: no-cache, no-store, must-revalidate');
       header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');
       echo (json_encode($json));
    }
}