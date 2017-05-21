

É preciso configurar a lib do pagseguro ..

o Caminho = application\vendor\pagseguro\php\source\PagSeguroLibrary\config\PagSeguroConfigWrapper.php

Minhas configuração


/**
     * production or sandbox
     */
    const PAGSEGURO_ENV = "sandbox";
    /**
     *
     */
    const PAGSEGURO_EMAIL = "juniogro10@hotmail.com";
    /**
     *
     */
    const PAGSEGURO_TOKEN_PRODUCTION = "your_production_token";
    /**
     *
     */
    const PAGSEGURO_TOKEN_SANDBOX = "46E30C9F492C44028F76CE891E60E700";
    /**
     *
     */
    const PAGSEGURO_APP_ID_PRODUCTION = "your_production_application_id";
    /**
     *
     */
    const PAGSEGURO_APP_ID_SANDBOX = "app4184193274";
    /**
     *
     */
    const PAGSEGURO_APP_KEY_PRODUCTION = "your_production_application_key";
    /**
     *
     */
    const PAGSEGURO_APP_KEY_SANDBOX = "F01118107B7BAFDDD424AF98B6009995";
    /**
     * UTF-8, ISO-8859-1
     */
    const PAGSEGURO_CHARSET = "UTF-8";
    /**
     *
     */
    const PAGSEGURO_LOG_ACTIVE = true;
    /**
     * Informe o path completo (relativo ao path da lib) para o arquivo, ex.: ../PagSeguroLibrary/logs.txt
     */
    const PAGSEGURO_LOG_LOCATION = '../oooo.txt';

Segundo coisa :

application\vendor\pagseguro\php\source\PagSeguroLibrary\service\PagSeguroPreApprovalService.class.php

Adicionar static na linha 233
private static function getResult($connection, $code = null)