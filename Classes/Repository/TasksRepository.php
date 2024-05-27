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

    public function insertTask($description,$date,$status)
    {
        $insert = 'INSERT INTO '. self::TABLE .' (task_description,task_date,task_status) VALUES (:description, :date, :status)';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($insert);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':status',$status);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getMySql()
    {
        return $this->MySQL;
    }
}