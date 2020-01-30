<?php

namespace App\Controller;

class BdController
{
    private $dbConnection;
    /**
     * BdController constructor.
     */
    public function __construct()
    {
        $connectionParams = 'host=localhost port=5432 dbname=test_task user=test_admin password=32167';

        $this->dbConnection = pg_connect($connectionParams) or die('Не удалось соединиться: ' . pg_last_error());
        if (!$this->dbConnection) {
            return $signUpErrorPage = $this->redirectToRoute('bdError');
        }
    }

    /**
     * @return false|resource
     */
    public function getDbConnection()
    {
        return $this->dbConnection;
    }


}
