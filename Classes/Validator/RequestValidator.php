<?php

namespace Validator;

use Repository\authorizedTokensRepository;
use Util\GenericConstantsUtil;
use Util\JsonUtil;

class RequestValidator
{
    private $request;
    private array $dadosRequest = [];
    private object $AuthorizedTokensRepository;

    const GET = 'GET';
    const DELETE = 'DELETE';
    public function __construct($request = [])
    {
        $this->request = $request;
        $this->AuthorizedTokensRepository = new AuthorizedTokensRepository();

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
        echo '<pre>';
        echo var_dump(getallheaders());
    }

}