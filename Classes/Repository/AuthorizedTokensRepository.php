<?php

namespace Repository;
use DB\MySQL;
use InvalidArgumentException;
use Util\GenericConstantsUtil;

class AuthorizedTokensRepository
{
    private object $MySQL;
    private const TABLE = 'authorized_tokens';

    public function __construct()
    {
        $this->MySQL = new MySQL();
    }

    public function validateToken($token)
    {
        $token = str_replace("Bearer ","",$token);
        if($token)
        {
            $consultaToken = 'SELECT id FROM '.self::TABLE.' WHERE token = :token AND token_status = :token_status';
            $stmt = $this->getMySql()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token',$token);
            $stmt->bindValue(':token_status',GenericConstantsUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() !== 1)
            {
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
        }else{
            throw new InvalidArgumentException(GenericConstantsUtil::MSG_ERRO_TOKEN_VAZIO);
        }
    }

    public function getMySql()
    {
        return $this->MySQL;
    }
}