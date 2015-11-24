<?php

$commonPath = dirname(__DIR__) . DS . ".." . DS . ".." . DS . "common";

return CMap::mergeArray(require($commonPath . "/config/main.php"), array(
            "basePath" => dirname(__FILE__) . DS . "..",
            "params" => array(
                "client_id" => 2,
            ),
            "components" => array(
                "db" => array(
                    "class" => "app.DbConnection",
                    "connectionString" => "mysql:host=localhost;dbname=",
                    "username" => "",
                    "password" => "",
                    "tablePrefix" => "",
                    "charset" => "utf8",
                    "enableProfiling" => false,
                    "enableParamLogging" => false,
                    "schemaCachingDuration" => 3600
                )
            )
        ));

