<?php


namespace Module\Application;


class ApplicationHooks
{

    protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
    {
        $router->addRouter(\Module\Application\Architecture\Router\MaintenanceRouter::create());
    }
}


