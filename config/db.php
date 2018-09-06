<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql-db;dbname=yii2basic',
    'username' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASS'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
