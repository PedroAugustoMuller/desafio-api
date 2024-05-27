<?php

use Util\GenericConstantsUtil;
use Util\RoutesUtil;
use Validator\RequestValidator;
include 'bootstrap.php';

try
{
    $requestValidator = new RequestValidator(RoutesUtil::getRoutes());;
    $retorno = $requestValidator->processRequest();
} 
catch(Exception $e)
{
    echo json_encode([
        GenericConstantsUtil::TIPO => GenericConstantsUtil::TIPO_ERRO,
        GenericConstantsUtil::RESPOSTA => $e->getMessage()
    ]);
    exit;
}