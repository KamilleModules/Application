<?php


$conf = [
    /**
     * Whether or not the website is in maintenance
     */
    "maintenanceMode" => false,
    /**
     * The default controller called when the website is in maintenance mode
     */
    "maintenanceController" => 'Controller\Application\MaintenanceController:render',
    "email.from" => 'contact@mysite.com',
];