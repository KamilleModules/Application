<?php


namespace Module\Application\Back\Helper;


use Core\Services\Hooks;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Models\AdminSidebarMenu\Lee\LeeAdminSidebarMenuModel;
use Models\AdminSidebarMenu\Lee\Objects\Item;
use Models\AdminSidebarMenu\Lee\Objects\Section;

class ApplicationBackHooksHelper
{


    public static function NullosAdmin_layout_sideBarMenuModelObject(LeeAdminSidebarMenuModel $sideBarMenuModel)
    {

        $section = Section::create()
            ->setName("application")
            ->setLabel("Application")
            ->setActive(true);
        $sideBarMenuModel->addSection($section);


        $utilsItem = Item::create()
            ->setActive(true)
            ->setName("Application.utils")
            ->setLabel("Utilitaires")
            ->setIcon("fa fa-wrench")
            ->setLink("#");


        $section
            //--------------------------------------------
            // UTILS
            //--------------------------------------------
            ->addItem($utilsItem);



        //--------------------------------------------
        // GENERATED PART
        //--------------------------------------------
        $generatedItemFile = BackHooksHelper::getGeneratedMenuLocation();
        if (file_exists($generatedItemFile)) {
            /**
             * Tip: use EkomNullosMorphicGenerator (the morphic-generator.php script) to
             * generate the whole database in a short amount of time
             */
            $generatedItem = Item::create()
                ->setActive(true)
                ->setName("generated")
                ->setLabel("Generated")
                ->setIcon("fa fa-magic")
                ->setLink("#");
            include $generatedItemFile;
            $section->addItem($generatedItem);
        }




        $menuItems = [
            'Application.utils' => $utilsItem,
        ];
        Hooks::call("Application_decorateLeftMenu", $menuItems);

    }




    public static function getGeneratedMenuLocation()
    {
        return ApplicationParameters::get("app_dir") . "/store/Application/Nullos/generated-menu.php";
    }


    public static function getGeneratedRoutesLocation()
    {
        return ApplicationParameters::get("app_dir") . "/store/Application/Nullos/generated-routes.php";
    }
}