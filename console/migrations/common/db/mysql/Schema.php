<?php

namespace common\db\mysql;

class Schema extends \yii\db\mysql\Schema
{
    const TYPE_INTEGER_ARRAY = 'integer[]';
    const TYPE_TEXT_ARRAY = 'text[]';
    const TYPE_NUMERIC_ARRAY = 'numberic[]';
    const TYPE_JSONB = 'jsonb';
    const TYPE_INET = 'inet';

    public $typeMap = [
        'tinyint' => self::TYPE_TINYINT,
        'bit' => self::TYPE_INTEGER,
        'smallint' => self::TYPE_SMALLINT,
        'mediumint' => self::TYPE_INTEGER,
        'int' => self::TYPE_INTEGER,
        'integer' => self::TYPE_INTEGER,
        'bigint' => self::TYPE_BIGINT,
        'float' => self::TYPE_FLOAT,
        'double' => self::TYPE_DOUBLE,
        'real' => self::TYPE_FLOAT,
        'decimal' => self::TYPE_DECIMAL,
        'numeric' => self::TYPE_DECIMAL,
        'tinytext' => self::TYPE_TEXT,
        'mediumtext' => self::TYPE_TEXT,
        'longtext' => self::TYPE_TEXT,
        'longblob' => self::TYPE_BINARY,
        'blob' => self::TYPE_BINARY,
        'text' => self::TYPE_TEXT,
        'varchar' => self::TYPE_STRING,
        'string' => self::TYPE_STRING,
        'char' => self::TYPE_CHAR,
        'datetime' => self::TYPE_DATETIME,
        'year' => self::TYPE_DATE,
        'date' => self::TYPE_DATE,
        'time' => self::TYPE_TIME,
        'timestamp' => self::TYPE_TIMESTAMP,
        'enum' => self::TYPE_STRING,
        'varbinary' => self::TYPE_BINARY,
        'json' => self::TYPE_JSON,

        'unknown' => self::TYPE_STRING,

        'uuid' => self::TYPE_STRING,
        'jsonb' => self::TYPE_JSONB,
        'xml' => self::TYPE_STRING,

        '_int4' => self::TYPE_INTEGER_ARRAY,
        '_int8' => self::TYPE_INTEGER_ARRAY,
        '_text' => self::TYPE_TEXT_ARRAY,
        '_numeric' => self::TYPE_NUMERIC_ARRAY,
    ];
}
