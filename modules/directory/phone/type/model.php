<?php

defined('HOSTCMS') || exit('HostCMS: access denied.');

/**
 * Directory_Phone_Type_Model
 *
 * @package HostCMS
 * @subpackage Directory
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2017 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class Directory_Phone_Type_Model extends Core_Entity
{
	/**
	 * Model name
	 * @var mixed
	 */
	protected $_modelName = 'directory_phone_type';

	/**
	 * One-to-many or many-to-many relations
	 * @var array
	 */
	protected $_hasMany = array(
		'directory_phone' => array()
	);

	/**
	 * Delete object from database
	 * @param mixed $primaryKey primary key for deleting object
	 * @return Core_Entity
	 * @hostcms-event directory_phone_type.onBeforeRedeclaredDelete
	 */
	public function delete($primaryKey = NULL)
	{
		if (is_null($primaryKey))
		{
			$primaryKey = $this->getPrimaryKey();
		}

		$this->id = $primaryKey;

		Core_Event::notify($this->_modelName . '.onBeforeRedeclaredDelete', $this, array($primaryKey));

		$this->Directory_Phones->deleteAll(FALSE);

		return parent::delete($primaryKey);
	}
}