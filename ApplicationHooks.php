<?php


namespace Module\Core;


use Module\Application\Architecture\Router\MaintenanceRouter;

class ApplicationHooks
{

    protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
    {
        $router->addRouter(MaintenanceRouter::create());
    }
}


