<?php


namespace Module\Core;




use Kamille\Module\KamilleModule;

class ApplicationModule extends KamilleModule
{

    protected function getWidgets(){
        return [
            'KamilleWidgets.Maintenance',
        ];
    }

}


