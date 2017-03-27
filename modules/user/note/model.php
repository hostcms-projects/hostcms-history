<?php

defined('HOSTCMS') || exit('HostCMS: access denied.');

/**
 * User_Note_Model
 *
 * @package HostCMS
 * @subpackage User
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2016 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class User_Note_Model extends Core_Entity{
	/**
	 * Column consist item's name
	 * @var string
	 */
	protected $_nameColumn = 'id';	
	
	/**
	 * One-to-one relations
	 * @var array
	 */
	protected $_hasOne = array(
		'user_setting' => array('foreign_key' => 'entity_id'),
	);

	/**
	 * Constructor.
	 * @param int $id entity ID
	 */
	public function __construct($id = NULL)
	{
		parent::__construct($id);

		if (is_null($id))
		{
			$oUserCurrent = Core_Entity::factory('User', 0)->getCurrent();
			$this->_preloadValues['user_id'] = is_null($oUserCurrent) ? 0 : $oUserCurrent->id;
		}
	}

	/**
	 * Delete object from database
	 * @param mixed $primaryKey primary key for deleting object
	 * @return Core_Entity
	 */
	public function delete($primaryKey = NULL)
	{
		if (is_null($primaryKey))
		{
			$primaryKey = $this->getPrimaryKey();
		}

		$this->id = $primaryKey;

		$this->User_Setting->delete();

		return parent::delete($primaryKey);
	}
}