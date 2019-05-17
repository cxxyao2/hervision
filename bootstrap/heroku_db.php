<?php

function get_db_config()
{
    if (getenv('ENV_HEROKU')) {
        $url = parse_url(getenv("DATABASE_URL"));

        return $db_config = [
            'connection' => 'pgsql',
            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'database'  => env('DB_DATABASE', 'test1'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', '1234'),
        ];
    }
}
