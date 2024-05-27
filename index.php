<?php

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
    echo $e->getMessage();
}