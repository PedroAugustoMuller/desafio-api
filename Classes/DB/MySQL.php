<?php

namespace DB;

use InvalidArgumentException;
use PDO;
use PDOException;
use Util\GenericConstantsUtil;

class MySQL
{
    private object $db;

    public function __construct()
    {
        $this->db = $this->setDB();
    }

    public function setDB()
    {
        try {
            return new PDO(
                'mysql:host=' . HOST . '; dbname=' . DB . ';', USER, SENHA
            );
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    public function delete($tabela, $id)
    {
        $consultaDelete = 'DELETE FROM ' . $tabela . ' WHERE id = :id';
        if ($tabela && $id) {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($consultaDelete);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $this->db->commit();
                return GenericConstantsUtil::MSG_DELETADO_SUCESSO;
            }
            $this->db->rollBack();
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_SEM_RETORNO);
        }
        throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_GENERICO);
    }

    public function getAll($tabela)
    {
        if ($tabela) {
            $consulta = 'SELECT * FROM ' . $tabela;
            $stmt = $this->db->prepare($consulta);
            $stmt->execute();
            $registros = $stmt->fetchAll($this->db::FETCH_ASSOC);
            if (is_array($registros) && count($registros) > 0) {
                return $registros;
            }
        }
        throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_SEM_RETORNO);
    }

    public function getOneByKey($tabela, $id)
    {
        if ($tabela && $id) {
            $consulta = 'SELECT * FROM ' . $tabela . ' WHERE id = :id';
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $totalRegistros = $stmt->rowCount();
            if ($totalRegistros === 1) {
                return $stmt->fetch($this->db::FETCH_ASSOC);
            }
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_SEM_RETORNO);
        }

        throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
    }

    /**
     * @return object|PDO
     */
    public function getDb()
    {
        return $this->db;
    }
}
