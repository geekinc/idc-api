<?php
namespace Db;

use Slim\PDO\Database;

function createPDO($appSettings) {
        $driver = $appSettings['bonitaDB']['connection']['driver'];
        $host = $appSettings['bonitaDB']['connection']['host'];
        $dbName = $appSettings['bonitaDB']['connection']['dbname'];

        $dsn = $driver. ':host=' . $host .';dbname='. $dbName .';';
        $usr = $appSettings['bonitaDB']['connection']['user'];
        $pwd = $appSettings['bonitaDB']['connection']['password'];

        return new Database($dsn, $usr, $pwd);
}
function createDBError($appSettings) {
    $driver = $appSettings['shippingDB']['connection']['driver'];
    $host = $appSettings['shippingDB']['connection']['host'];
    $dbName = $appSettings['shippingDB']['connection']['dbname'];

    $dsn = $driver. ':host=' . $host .';dbname='. $dbName .';';
    $usr = $appSettings['shippingDB']['connection']['user'];
    $pwd = $appSettings['shippingDB']['connection']['password'];

    return new Database($dsn, $usr, $pwd);
}

function createEnginePDO($appSettings) {
    $driver = $appSettings['server']['driver'];
    $host = $appSettings['server']['host'];
    $dbName = 'bonita_engine';

    $dsn = $driver. ':host=' . $host .';dbname='. $dbName .';';
    $usr = $appSettings['server']['user'];
    $pwd = $appSettings['server']['password'];

    return new Database($dsn, $usr, $pwd);
}