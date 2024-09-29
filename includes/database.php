<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
function query ($sql, $data=[], $statementStatus = false) {
    global $conn;
    $query = false;
    try {
        $statement = $conn->prepare($sql);
        if (empty($data)) {
            $query = $statement->execute();
        }
        else {
            $query = $statement->execute($data);
        }
        

    } catch (PDOException $e) {
        require_once './modules/errors/database.php';   // Import error
        die();  // dừng hết chương trình
    }

    if ($statementStatus && $query) {
        return $statement;
    }

    return $query;
}

function insert ($table, $dataInsert=[]) {
    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(', ', $keyArr);
    $valueStr = ':'.implode(', :', $keyArr);

    $sql = 'INSERT INTO `'.$table.'`('.$fieldStr.') VALUES('.$valueStr.')';

    return query($sql, $dataInsert);
}

function update ($table, $dataUpdate=[], $condition='') {
    $updateStr = '';
    foreach ($dataUpdate as $key => $value) {
        $updateStr .= $key.'=:'.$key.', ';
    }
    $updateStr = rtrim($updateStr,', ');
    if (empty($condition)) {
        $sql = 'UPDATE `'.$table.'` SET '.$updateStr;
    }
    else{
        $sql = 'UPDATE `'.$table.'` SET '.$updateStr.' WHERE '.$condition;
    }

    return query($sql, $dataUpdate);
}

function delete ($table, $condition= '') {
    if (!empty($condition)) {
        $sql = "DELETE FROM `$table` WHERE $condition";
    }
    else {
        $sql ="DELETE FROM `$table`";
    }
    return query($sql);
}

// lấy dữ liệu từ câu lệnh sql
function getRaw ($sql) {
    $statement = query($sql, [], true);
    
    if (is_object($statement)) {
        $dataFetch = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $dataFetch;
    }
    return false;
}

function firstRaw ($sql) {
    $statement = query($sql, [], true);
    
    if (is_object($statement)) {
        $dataFetch = $statement->fetch(pdo::FETCH_ASSOC);
        return $dataFetch;
    }
    return false;
}

// lấy dữ liệu theo field, condition
function get($table, $field='*', $condition= '') {
    if (!empty($condition)) {
        $sql = "SELECT $field FROM $table WHERE $condition";
    }
    else {
        $sql = "SELECT $field FROM $table";
    }
    return getRaw($sql);
}

function first($table, $field='*', $condition= '') {
    if (!empty($condition)) {
        $sql = "SELECT $field FROM $table WHERE $condition";
    }
    else {
        $sql = "SELECT $field FROM $table";
    }
    return firstRaw($sql);
}

// functions bổ sung
// lấy số dòng câu truy vấn
function getRows($sql) {
    $statement = query($sql, [], true);
    if (!empty($statement)) {
        return $statement->rowCount();
    }
}

// lấy ra id vừa insers
function insertId() {
    global $conn;
    return $conn->lastInsertId();
}