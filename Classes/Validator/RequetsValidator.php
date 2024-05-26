<?php

namespace Validator;

class RequetsValidator
{
    private $request;
    public function __construct($request)
    {
        $this->$request = $request;
    }

    public function processRequest()
    {
        echo "to funcionando";
    }
}