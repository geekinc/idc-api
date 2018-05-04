<?php
/**
 * Created by PhpStorm.
 * User: tecnova
 * Date: 27-03-2018
 * Time: 15:38
 */

namespace SLIMAPI\Controller\API\includes;
use Slim\PDO\Database;

class DBmanager
{
    protected  $settings;

    /**
     * DB connection
     * @var Database
     */
    private $_db;

    public function __construct($settings)
    {
        $this->settings = $settings;

    }
    private function _getDb($settings) {

        if ($this->_db === null) {
            $dsn = 'mysql:host=' .
                $settings['shippingDB']['connection']['host'] .
                ';dbname=' .
                $settings['shippingDB']['connection']['dbname'] .
                ';charset=utf8';
            $usr = $settings['shippingDB']['connection']['user'];
            $pwd = $settings['shippingDB']['connection']['password'];

            $this->_db = new Database($dsn, $usr, $pwd);
            return $this->_db;
        }

    }
    private function  cleanForbiddenCharactersExceptionMessege($messege){
          return str_replace("'","",$messege);
    }

}