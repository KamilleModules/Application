<?php


namespace Module\Application\Service\Cache;


use Chronos\Chronos;
use Kamille\Services\XLog;
use TabathaCache\Cache\TabathaCache2;

/**
 * Application provides this cache service for u all modules.
 *
 *
 */
class ChronosTabathaCache2 extends ApplicationTabathaCache2
{
    protected $debug;


    public function __construct()
    {
        parent::__construct();
        $this->debug = false;
        $this->addListener("cacheCreateAfter", function ($cacheIdentifier) {
            if (true === $this->debug) {
                return $this->handleTime("cacheCreateAfter", $cacheIdentifier);
            }
        });
        $this->addListener("cacheHit", function ($cacheIdentifier) {
            if (true === $this->debug) {
                return $this->handleTime("cacheHit", $cacheIdentifier);
            }
        });
    }

    public function setDebug(bool $debug)
    {
        $this->debug = $debug;
        return $this;
    }




    public function get(string $cacheIdentifier, callable $generateCallback, $deleteIds = null)
    {
        Chronos::point($cacheIdentifier);
        return parent::get($cacheIdentifier, $generateCallback, $deleteIds);
    }


    private function handleTime($eventName, $cacheIdentifier)
    {

        $msg = "$eventName -- $cacheIdentifier";

        if (in_array($eventName, [
            "cacheCreateAfter",
            "cacheHit",
        ])) {
            $time = number_format(Chronos::point($cacheIdentifier)[0], 5);
            $msg .= "--$time" . "s";
            XLog::log($msg, "cache.log");
        }
    }

}