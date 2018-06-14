<?php


namespace Module\Application\Api\Layer;

use Core\Services\A;
use Module\Application\Api\Object\Variables;
use QuickPdo\QuickPdo;


/**
 *
 *
 * This class is meant to be the access layer to db variables for any module.
 *
 * The overview being:
 *
 * - modules insert their variables in the ap_variables table.
 * - then they can retrieve them using this layer
 *
 *
 * Note: the personal goal of this class is of course to deliver
 * the variables using the minimum fingerprint.
 *
 * @todo-ling
 * For now, we are simply using a direct call to the db.
 * This should be cached in the future...
 * - Note to myself: the getVariables method should be the only one calling the db
 *
 *
 *
 *
 * All variables MUST start with the module name followed by an underscore, like this for instance:
 *          Application_myvar (variable myvar of the Application module)
 *
 *
 *
 *
 */
class ApplicationVariablesLayer
{

    private static $vars = null;


    public static function getVariables()
    {
        if (null === self::$vars) {

            /**
             * This should be the only call to the db in this class (perf optimization).
             * Also we should consider caching it...
             */
            self::$vars = A::cache()->get("Application.ApplicationVariablesLayer.getVariables", function () {
                return QuickPdo::fetchAll("select `name`, `value` from ap_variables", [], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
            }, 'ap_variables');
        }
        return self::$vars;
    }

    public static function getVariable(string $name, $default = null)
    {
        $vars = self::getVariables();
        if (array_key_exists($name, $vars)) {
            return $vars[$name];
        }
        return $default;
    }

    public static function getVariablesByModule(string $moduleName)
    {
        $moduleVars = [];
        $vars = self::getVariables();
        foreach ($vars as $name => $value) {
            if (0 === strpos($name, $moduleName . "_")) {
                $moduleVars[$name] = $value;
            }
        }
        return $moduleVars;
    }


    /**
     * Set the variable and return the corresponding id.
     *
     *
     * @param string $name
     * @param $value
     * @return int
     */
    public static function setVariable(string $name, $value)
    {
        $id = QuickPdo::fetch("select id from ap_variables where `name` like :name", [
            "name" => $name,
        ], \PDO::FETCH_COLUMN);
        if (false === $id) {
            return Variables::getInst()->create([
                "name" => $name,
                "value" => $value,
            ]);
        }
        Variables::getInst()->update([
            "name" => $name,
            "value" => $value,
        ], [
            "id" => $id,
        ]);

        A::cache()->clean("ap_variables");
        return $id;
    }


}