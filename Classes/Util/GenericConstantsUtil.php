<?php

namespace Util;

abstract class GenericConstantsUtil
{
    /* REQUESTS */
    public const TIPO_REQUEST = ['GET', 'POST', 'DELETE', 'PUT'];
    public const TIPO_GET = ['TASKS'];
    public const TIPO_POST = ['TASKS'];
    public const TIPO_DELETE = ['TASKS'];
    public const TIPO_PUT = ['TASKS'];

    /* ERROS */
    public const MSG_ERRO_TIPO_ROTA = '401 Route Unauthorized';
    public const MSG_ERRO_RECURSO_INEXISTENTE = '404 Resource Not Found';
    public const MSG_ERRO_GENERICO = 'Algum erro ocorreu na requisição!';
    public const MSG_ERRO_SEM_RETORNO = '404 Not Found';
    public const MSG_ERRO_NAO_AFETADO = '400 Bad Request';
    public const MSG_ERRO_TOKEN_VAZIO = '400 Bad Request - Token not found';
    public const MSG_ERRO_TOKEN_NAO_AUTORIZADO = '403 Forbidden Token';
    public const MSG_ERR0_JSON_VAZIO = '400 Bad Request - Empty Json Body';
    public const MSG_ERRO_DESCRICAO_VAZIA = '400 Bad Request - Empty Description';

    /* SUCESSO */
    public const MSG_DELETADO_SUCESSO = 'Registro deletado com Sucesso!';
    public const MSG_ATUALIZADO_SUCESSO = 'Registro atualizado com Sucesso!';

    /* RECURSO TASKS */
    public const MSG_ERRO_ID_OBRIGATORIO = 'ID é obrigatório!';

    /* RETORNO JSON */
    const TIPO_SUCESSO = 'sucesso';
    const TIPO_ERRO = 'erro';

    /* OUTRAS */
    public const SIM = 'S';
    public const TIPO = 'tipo';
    public const RESPOSTA = 'resposta';
}