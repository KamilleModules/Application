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
    /**
     *
     * Used in:
     *
     * - email communication (in the subject, to help the user identifying
     *          that the mail comes from YOUR website).
     */
    "site.name" => 'mysite',
];