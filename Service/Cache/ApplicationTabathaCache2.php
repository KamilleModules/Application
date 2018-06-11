<?php


namespace Module\Application\Service\Cache;


use TabathaCache\Cache\TabathaCache2;

class ApplicationTabathaCache2 extends TabathaCache2
{


    /**
     * Same as get, but will prefix the cacheIdentifier with the "daily" keyword.
     * So that then you can use the cleanByCacheIdentifierPrefix method with the "daily." prefix
     * to delete all your daily cached entries at once.
     *
     * The deleteIds are not used, see 2 cache strategies section in the docs for more info.
     *
     *
     * Note: this method does nothing more that you can't do with the get method,
     * but it emphasizes the differences between the two cache strategies provided by Tabatha.
     *
     *
     * @param string $cacheIdentifier
     * @param callable $generateCallback
     * @return mixed
     */
    public function getDaily(string $cacheIdentifier, callable $generateCallback)
    {
        $cacheIdentifier = "daily.$cacheIdentifier";
        return $this->get($cacheIdentifier, $generateCallback);
    }
}