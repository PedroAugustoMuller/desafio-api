<?php

namespace Service;

use Generator;
use InvalidArgumentException;
use Repository\TasksRepository;
use Util\GenericConstantsUtil;

class TasksService
{
    public const TABLE = 'tasks';
    private const RESOURCES_GET = ['listar','deletar'];
    private array $data;

    private object $TasksRepository;

    public function __construct($data = [])
    {
        $this->data = $data;
        $this->TasksRepository = new TasksRepository; 
    }

    public function validateGet()
    {
        $retorno = null;
        $resource = $this->data['resource'];
        if(in_array($resource,self::RESOURCES_GET,true))
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
        if(in_array($resource,self::RESOURCES_GET,true))
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
}