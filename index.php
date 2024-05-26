<?php

use Util\RoutesUtil;
use Validator\RequetsValidator;
include 'bootstrap.php';

try
{
    $requestValidator = new RequetsValidator(RoutesUtil::getRoutes());
    $retorno = $requestValidator->processRequest();
} 
catch(Exception $e)
{
    echo $e->getMessage();
}