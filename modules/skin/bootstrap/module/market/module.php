<?php

/**
 * Market.
 *
 * @package HostCMS 6\Skin
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2015 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class Skin_Bootstrap_Module_Market_Module extends Market_Module
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->_adminPages = array(
			1 => array('title' => Core::_('Market.menu'))
		);
	}

	/**
	 * Path
	 * @var string
	 */
	protected $_path = NULL;

	/**
	 * Show admin widget
	 * @param int $type
	 * @param boolean $ajax
	 * @return self
	 */
	public function adminPage($type = 0, $ajax = FALSE)
	{
		$oModule = Core_Entity::factory('Module')->getByPath($this->getModuleName());

		$type = intval($type);
		$this->_path = "/admin/index.php?ajaxWidgetLoad&moduleId={$oModule->id}&type={$type}";

		if ($ajax)
		{
			$this->_content();
		}
		else
		{
			?><div class="col-lg-12" id="marketAdminPage">
				<script type="text/javascript">
				$.widgetLoad({ path: '<?php echo $this->_path?>', context: $('#marketAdminPage') });
				</script>
			</div><?php
		}

		return TRUE;
	}

	protected function _content()
	{
		$oMarket_Controller = Market_Controller::instance();
		$oMarket_Controller
			->setMarketOptions()
			->limit(3)
			->order('rand')
			->getMarket();

		if ($oMarket_Controller->error == 0)
		{
			?><div class="widget market">
				<div class="widget-header bordered-bottom bordered-themesecondary">
					<i class="widget-icon fa fa-cogs themesecondary"></i>
					<span class="widget-caption themesecondary"><?php echo Core::_('Market.title')?></span>
					<div class="widget-buttons">
						<a data-toggle="maximize">
							<i class="fa fa-expand gray"></i>
						</a>
						<a onclick="$(this).find('i').addClass('fa-spin'); $.widgetLoad({ path: '<?php echo $this->_path?>', context: $('#marketAdminPage'), 'button': $(this).find('i') });">
							<i class="fa fa-refresh gray"></i>
						</a>
					</div>
				</div>
				<div class="widget-body">
					<div class="row">
					<?php echo $oMarket_Controller->getMarketItemsHtml()?>
					</div>
				</div>
			</div><?php
		}
		return $this;
	}
}