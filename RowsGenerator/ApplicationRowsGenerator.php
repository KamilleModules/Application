<?php


namespace Module\Application\RowsGenerator;


use Core\Services\A;
use Module\Application\Helper\ApplicationHashHelper;
use QuickPdo\QuickPdo;
use RowsGenerator\QuickPdoRowsGenerator;

class ApplicationRowsGenerator extends QuickPdoRowsGenerator
{
    protected function doGetNbTotalItems($countQuery, array $markers)
    {
        $hash = ApplicationHashHelper::getHashByQuery($countQuery, $markers);
        return A::cache()->getDaily("Application.ApplicationRowsGenerator.doGetNbTotalItems.$hash", function () use ($countQuery, $markers) {
            return QuickPdo::fetch($countQuery, $markers)['count'];
        });

    }

    protected function doGetRows($rowsQuery, array $markers)
    {
        $hash = ApplicationHashHelper::getHashByQuery($rowsQuery, $markers);
        return A::cache()->getDaily("Application.ApplicationRowsGenerator.doGetRows.$hash", function () use ($rowsQuery, $markers) {
            return QuickPdo::fetchAll($rowsQuery, $markers);
        });
    }
}