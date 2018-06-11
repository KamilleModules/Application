<?php

namespace Module\Application\Helper;


use Bat\HashTool;

class ApplicationHashHelper
{
    public static function getHashByQuery(string $query, array $markers, array $extra = [])
    {
        return HashTool::getHashByArray(array_merge($markers, $extra, [
            "_query" => $query,
        ]));
    }
}


