<?php
class db_pdo
{
    const DB_SERVER_TYPE = 'mysql'; // MySQL or MariaDB server
    const DB_HOST = '127.0.0.1'; // local server on my laptop
    const DB_PORT = 3306; // optional, default 3306, use 3307 for MariaDB
    const DB_NAME = 'classicmodels'; // for Database classicmodels
    const DB_CHARSET = 'utf8mb4'; // pour français correct
    const DB_USER_NAME = 'ruben'; // if not root it must have been previously created on DB server
    const DB_PASSWORD = 'passwordruben';

    // PDO connection options
    const DB_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        //
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    private $DB_Connection = null;

    function connect()
    {
        global $DB_Connection;
        try {
            $DSN = self::DB_SERVER_TYPE . ':host=' . self::DB_HOST . ';port=' . self::DB_PORT . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHARSET;
            $this->DB_Connection = new PDO($DSN, self::DB_USER_NAME, self::DB_PASSWORD, self::DB_OPTIONS);
            echo "connected to db";
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB connection Error : ' . $e->getMessage());
        }
    }
    function disconnect()
    {
        global $DB_connection;
        if ($DB_connection) {
            $this->DB_connection = null; // closing DB connection
        }
    }

    public function query($sql)
    {
        try {
            $result = $this->DB_Connection->query($sql);
            return $result;
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB connection Error : ' . $e->getMessage());
        }
    }
}
