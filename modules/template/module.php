<?php

defined('HOSTCMS') || exit('HostCMS: access denied.');

/**
 * Template Module.
 *
 * @package HostCMS
 * @subpackage Template
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2017 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class Template_Module extends Core_Module
{
	/**
	 * Module version
	 * @var string
	 */
	public $version = '6.7';

	/**
	 * Module date
	 * @var date
	 */
	public $date = '2017-09-07';

	/**
	 * Module name
	 * @var string
	 */
	protected $_moduleName = 'template';

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->menu = array(
			array(
				'sorting' => 70,
				'block' => 0,
				'ico' => 'fa fa-th',
				'name' => Core::_('template.menu'),
				'href' => "/admin/template/index.php",
				'onclick' => "$.adminLoad({path: '/admin/template/index.php'}); return false"
			)
		);

		if (Core_Auth::logged())
		{
			Core_Router::add('template-section-lib.php', '/template-section-lib.php')
				->controller('Template_Section_Lib_Command_Controller');

			Core_Router::add('template-section.php', '/template-section.php')
				->controller('Template_Section_Command_Controller');

			Core_Router::add('template-less.php', '/template-less.php')
				->controller('Template_Less_Command_Controller');
		}
	}
}