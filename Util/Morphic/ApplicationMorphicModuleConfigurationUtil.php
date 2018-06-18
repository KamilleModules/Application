<?php


namespace Module\Application\Util\Morphic;


use Core\Services\Hooks;
use Kamille\Utils\Morphic\Util\ModuleConfiguration\MorphicModuleConfigurationUtil;

class ApplicationMorphicModuleConfigurationUtil extends MorphicModuleConfigurationUtil
{
    public function __construct()
    {
        parent::__construct();

        $controlMap = [];
        Hooks::call("Application_MorphicModuleConfigurationUtil_getControlMap", $controlMap);
        $this->controlMap = $controlMap;
    }

}