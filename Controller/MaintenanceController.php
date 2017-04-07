<?php


namespace Controller\Core;


use Core\Controller\ApplicationController;


class MaintenanceController extends ApplicationController
{


    public function render()
    {
        return $this->renderByViewId("maintenance");
    }


}