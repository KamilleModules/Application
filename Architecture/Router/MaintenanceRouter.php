<?php


namespace Module\Application\Architecture\Router;


use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Router\Web\WebRouterInterface;
use Kamille\Services\XConfig;

class MaintenanceRouter implements WebRouterInterface
{

    public static function create()
    {
        return new static();
    }

    public function match(HttpRequestInterface $request)
    {
        if (true === XConfig::get("Application.maintenanceMode")) {
            return XConfig::get("Application.maintenanceController");
        }
    }
}