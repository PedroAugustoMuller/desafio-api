<?php

namespace Repository;
use DB\MySQL;
class AuthorizedTokensRepository
{
    private object $MySql;
    private const TABLE = 'authorized_tokens';

    public function __construct()
    {
        $this->MySql = new MySQL();
    }

    public function validateToken($token)
    {

    }

    public function getMySql()
    {
        return $this->MySql;
    }
}