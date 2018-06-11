<?php

namespace Module\Application\SqlQueryWrapper;


use Bat\HashTool;
use Core\Services\A;
use QuickPdo\QuickPdo;
use SqlQueryWrapper\SqlQueryWrapper;

class ApplicationSqlQueryWrapper extends SqlQueryWrapper
{
    protected $enableCache;


    public function __construct()
    {
        parent::__construct();
        $this->enableCache = true;
    }


    public function setEnableCache(bool $enableCache)
    {
        $this->enableCache = $enableCache;
        return $this;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function doGetNbItems(string $qCount, array $markers)
    {
        $hash = HashTool::getHashByArray(array_merge($markers, [
            "qCount" => $qCount,
        ]));
        return A::cache()->getDaily("Application.ApplicationSqlQueryWrapper.doGetNbItems.$hash", function () use ($qCount, $markers) {
            return QuickPdo::fetch($qCount, $markers, \PDO::FETCH_COLUMN);
        });
    }

    protected function doGetRows(string $query, array $markers)
    {
        $hash = HashTool::getHashByArray(array_merge($markers, [
            "query" => $query,
        ]));
        return A::cache()->getDaily("Application.ApplicationSqlQueryWrapper.doGetRows.$hash", function () use ($query, $markers) {
            return QuickPdo::fetchAll($query, $markers);
        });
    }

}