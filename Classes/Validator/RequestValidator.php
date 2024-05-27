<?php

namespace Validator;

use InvalidArgumentException;
use Repository\AuthorizedTokensRepository;
use Service\TasksService;
use Util\GenericConstantsUtil;
use Util\JsonUtil;

class RequestValidator
{
    private $request;
    private array $dadosRequest = [];
    private object $AuthorizedTokensRepository;


    const GET = 'GET';
    const DELETE = 'DELETE';
    const TASKS = 'TASKS';
    public function __construct($request = [])
    {
        $this->request = $request;
        $this->AuthorizedTokensRepository = new AuthorizedTokensRepository();

    }

    public function processRequest()
    {
        $retorno = GenericConstantsUtil::MSG_ERRO_TIPO_ROTA;
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
        $this->AuthorizedTokensRepository->validateToken(getallheaders()['Authorization']);
        $method = $this->request['method'];
        return $this->$method();
    }

    private function get()
    {
        $retorno =  GenericConstantsUtil::MSG_ERRO_TIPO_ROTA;
        if(in_array($this->request['route'],GenericConstantsUtil::TIPO_GET,true))
        {
            switch($this->request['route'])
            {
                case self::TASKS:
                    $TasksSerivce = new TasksService($this->request);
                    $retorno = $TasksSerivce->validateGet();
                    break;
                default:
                    throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;
    }

}