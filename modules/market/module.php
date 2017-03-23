<?php

defined('HOSTCMS') || exit('HostCMS: access denied.');

/**
 * Market.
 *
 * @package HostCMS 6\Market
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2015 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class Market_Module extends Core_Module
{
	/**
	 * Module version
	 * @var string
	 */
	public $version = '6.5';

	/**
	 * Module date
	 * @var date
	 */
	public $date = '2015-09-03';

	/**
	 * Module name
	 * @var string
	 */
	protected $_moduleName = 'market';
	
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->menu = array(
			array(
				'sorting' => 150,
				'block' => 3,
				'ico' => 'fa fa-cogs',
				'name' => Core::_('Market.menu'),
				'href' => "/admin/market/index.php",
				'onclick' => "$.adminLoad({path: '/admin/market/index.php'}); return false"
			)
		);
	}
}