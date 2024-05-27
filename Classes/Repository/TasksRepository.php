<?php

namespace Repository;
use DB\MySQL;

class TasksRepository
{
    private object $MySQL;
    private const TABLE = 'tasks';

    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    public function getMySql()
    {
        return $this->MySQL;
    }
}