<?php
    include_once "database.php";

    function debug($msg, $readable = true) {
        $out = fopen('php://stdout', 'w');
        fputs($out, ($readable ? print_r($msg, true) : $msg)."\n");
        fclose($out);
    }

    function getImgFilename($name) {
        return preg_replace('/\s+/', '', mb_strtolower($name, 'UTF-8'));
    }

    // DB methods
    function __DB() {
        $obj = new stdClass();
        $obj->db = Database::getInstance();
        $obj->pdo = $obj->db->getConnection();
        return $obj;
    }

    function getAllProducts() {
        return __DB()->pdo->query('SELECT * FROM Products');
    }

    function getProduct($id) {
        $stmt = __DB()->pdo->prepare('SELECT * FROM Products WHERE id=?');
        $stmt->execute(array($id));
        return $stmt->fetchAll()[0];
    }

    function isValidID($id) {
        $stmt = __DB()->pdo->prepare('SELECT EXISTS(SELECT 1 FROM Products WHERE id=?)');
        $stmt->execute(array($id));
        return $stmt->fetchAll()[0][0];
    }
?>