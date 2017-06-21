<?php

class CRM_Sebext_BAO_SebEntity extends CRM_Sebext_DAO_SebEntity {

  /**
   * Create a new SebEntity based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Sebext_DAO_SebEntity|NULL
   *
  public static function create($params) {
    $className = 'CRM_Sebext_DAO_SebEntity';
    $entityName = 'SebEntity';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
