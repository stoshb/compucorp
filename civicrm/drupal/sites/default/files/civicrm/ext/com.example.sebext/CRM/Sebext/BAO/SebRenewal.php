<?php

class CRM_Sebext_BAO_SebRenewal extends CRM_Sebext_DAO_SebRenewal {

  /**
   * Create a new SebRenewal based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Sebext_DAO_SebRenewal|NULL
   *
  public static function create($params) {
    $className = 'CRM_Sebext_DAO_SebRenewal';
    $entityName = 'SebRenewal';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
