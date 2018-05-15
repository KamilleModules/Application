<?php


namespace Module\Application\Api\GeneratedObject;


use XiaoApi\Object\TableCrudObject;

/**
 * This file was generated by the DbObjectGenerator.
 * You should not edit it manually, otherwise you
 * might loose your edits on the next update.
 *
 * You are supposed to extend this object.
 */
class GeneratedVariables extends TableCrudObject
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "ap_variables";
        $this->primaryKey = ['id'];
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getCreateData(array $data)
    {
        $base = [
			'id' => null,
			'name' => '',
			'value' => '',
		];
        $ret = array_replace($base, array_intersect_key($data, $base));



        return $ret;
    }


}