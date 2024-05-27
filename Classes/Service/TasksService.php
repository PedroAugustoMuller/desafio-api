<?php

namespace Service;

use Generator;
use InvalidArgumentException;
use Repository\TasksRepository;
use Util\GenericConstantsUtil;

class TasksService
{
    public const TABLE = 'tasks';
    private const RESOURCES = ['listar','deletar','criar','atualizar'];
    private array $data;

    private array $dataRequest = [];

    private object $TasksRepository;

    public function __construct($data = [])
    {
        $this->data = $data;
        $this->TasksRepository = new TasksRepository; 
    }

    public function setBodyData($dataRequest)
    {
        $this->dataRequest = $dataRequest;
    }
    public function validateGet()
    {
        $retorno = null;
        $resource = $this->data['resource'];
        if(in_array($resource,self::RESOURCES,true))
        {
            if($this->data['id'] > 0)
            {
                $retorno = $this->getOneByKey();
            } else
            {
                $retorno = $this->$resource();
            }

        } else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }
        
        if($retorno == null)
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }
    public function validateDelete()
    {
        $retorno = null;
        $resource = $this->data['resource'];
        if(in_array($resource,self::RESOURCES,true))
        {
            if($this->data['id'] > 0)
            {
                $retorno = $this->$resource();
            } else
            {
                throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
            }

        } else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }
        
        if($retorno == null)
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function validatePost()
    {
        $retorno = null;
        $resource = $this->data['resource'];
        if(in_array($resource,self::RESOURCES,true))
        {
            $retorno = $this->$resource();
        } else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }
        
        if($retorno == null)
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }
    public function validatePut()
    {
        $retorno = null;
        $resource = $this->data['resource'];
        if(in_array($resource,self::RESOURCES,true))
        {
            if($this->data['id'] > 0)
            {
                $retorno = $this->$resource();
            } else
            {
                throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
            }

        } else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }
        
        if($retorno == null)
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    public function getOneByKey()
    {
        return $this->TasksRepository->getMySql()->getOneByKey(self::TABLE,$this->data['id']);
    }

    private function deletar()
    {
        $retorno = $this->TasksRepository->getMySql()->delete(self::TABLE,$this->data['id']);
        return $retorno;
    }

    private function listar()
    {
        
        $retorno = $this->TasksRepository->getMySql()->getAll(self::TABLE);
        return $retorno;
    }

    private function criar()
    {
        $taskDescription = $this->dataRequest['task_description'];
        $taskDate = $this->dataRequest['task_date'];
        $taskStatus = $this->dataRequest['task_status'];
        if($taskDescription)
        {
            if(!$taskDate)
            {
                $taskDate = date('Y-m-d');
            }
            if(!$taskStatus)
            {
                $taskStatus = 'todo';
            }
            if($this->TasksRepository->insertTask($taskDescription,$taskDate,$taskStatus) > 0)
            {
                $insertedId = $this->TasksRepository->getMySql()->getDb()->lastInsertId();
                $this->TasksRepository->getMySql()->getDb()->commit();
                return ['insertedID' => $insertedId];
            }
                $this->TasksRepository->getMySql()->getDb()->rollBack();
                throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);


        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_DESCRICAO_VAZIA);
        }
    }

    private function atualizar()
    {
        $taskDescription = $this->dataRequest['task_description'];
        $taskDate = $this->dataRequest['task_date'];
        $taskStatus = $this->dataRequest['task_status'];
        if($taskDescription)
        {
            if(!$taskDate)
            {
                $taskDate = date('Y-m-d');
            }
            if(!$taskStatus)
            {
                $taskStatus = 'todo';
            }
            if( $this->TasksRepository->updateTask($this->data['id'],$taskDescription,$taskDate,$taskStatus) > 0)
            {
                $this->TasksRepository->getMySql()->getDb()->commit();
                return GenericConstantsUtil::MSG_ATUALIZADO_SUCESSO;
            }
                $this->TasksRepository->getMySql()->getDb()->rollBack();
                throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_NAO_AFETADO);

        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_DESCRICAO_VAZIA);
        }
        
    }
}