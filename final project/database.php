<?php

$host = '172.31.22.43';
$db_name = 'Astu200543616';
$db_user = 'Astu200543616';
$db_pass = 'Ni1ecV3PZD';

$dsn = "mysql:host=$host;dbname=$db_name";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Turn on error reporting
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set the default fetch mode to associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Turn off emulation mode for "real" prepared statements
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);     // Create a new PDO instance
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
