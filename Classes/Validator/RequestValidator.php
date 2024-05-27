<?php

namespace Validator;

use Util\GenericConstantsUtil;
use Util\JsonUtil;

class RequestValidator
{
    private $request;
    private $dadosRequest = [];

    const GET = 'GET';
    const DELETE = 'DELETE';
    public function __construct($request = [])
    {
        $this->request = $request;

    }

    public function processRequest()
    {
        $retorno = GenericConstantsUtil::MSG_ERRO_TIPO_ROTA;
        $this->request['method'] = 'POST';
        if (in_array($this->request['method'], GenericConstantsUtil::TIPO_REQUEST, true)) {
            $retorno = $this->directRequest();
        }
        return $retorno;
    }

    private function directRequest()
    {
        if($this->request['method'] !== self::GET && $this->request['method'] !== self::DELETE )
        {
            $this->dadosRequest =  JsonUtil::treatJsonBody();
        }
    }

}