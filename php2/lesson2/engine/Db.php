<?php

namespace app\engine; //виртуальная подпапка пространства имен (при возникновении одинаковых имен классов), для обращения к классу необходимо учитывать эту подпапку

class Db
{
    public function queryOne($sql) {
        //выполнить $sql
        return $sql;
    }

    public function queryAll($sql) {
        //выполнить $sql
        return $sql;
    }
    public function query($sql) {
        return $sql;
    }
}