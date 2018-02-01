<?php

defined('HOSTCMS') || exit('HostCMS: access denied.');

/**
 * Event_Type_Controller_Edit
 *
 * @package HostCMS
 * @subpackage Event
 * @version 6.x
 * @author Hostmake LLC
 * @copyright © 2005-2017 ООО "Хостмэйк" (Hostmake LLC), http://www.hostcms.ru
 */
class Event_Type_Controller_Edit extends Admin_Form_Action_Controller_Type_Edit
{
	/**
	 * Set object
	 * @param object $object object
	 * @return self
	 */
	public function setObject($object)
	{
		parent::setObject($object);

		$this->title($this->_object->id
			? Core::_('Event_Type.edit_title')
			: Core::_('Event_Type.add_title'));

		$oMainTab = $this->getTab('main');
		$oAdditionalTab = $this->getTab('additional');

		$oMainTab
			->add($oMainRow1 = Admin_Form_Entity::factory('Div')->class('row'))
			->add($oMainRow2 = Admin_Form_Entity::factory('Div')->class('row'))
			->add($oMainRow3 = Admin_Form_Entity::factory('Div')->class('row'));

		$sColorValue = ($this->_object->id && $this->getField('color')->value)
			? $this->getField('color')->value
			: '#aebec4';

		$this->getField('color')
			->class('form-control colorpicker minicolors-input')
			->value($sColorValue);


		$oScript = Admin_Form_Entity::factory('Script')
			->type("text/javascript")
			->value("$('.colorpicker').each(function () {
						$(this).minicolors({
							control: $(this).attr('data-control') || 'hue',
							defaultValue: $(this).attr('data-defaultValue') || '',
							inline: $(this).attr('data-inline') === 'true',
							letterCase: $(this).attr('data-letterCase') || 'lowercase',
							opacity: $(this).attr('data-opacity'),
							position: $(this).attr('data-position') || 'bottom left',
							change: function (hex, opacity) {
								if (!hex) return;
								if (opacity) hex += ', ' + opacity;
								try {
									console.log(hex);
								} catch (e) { }
							},
							theme: 'bootstrap'
						});
					});"
			);

		$oMainTab
			->move($this->getField('name')->divAttr(array('class' => 'form-group col-xs-12')), $oMainRow1)
			->move($this->getField('color')->set('data-control', 'hue')->divAttr(array('class' => 'form-group col-xs-12 col-sm-4')), $oMainRow2)
			->move($this->getField('icon')->divAttr(array('class' => 'form-group col-xs-12 col-sm-4')), $oMainRow2)
			->move($this->getField('default')->divAttr(array('class' => 'form-group col-xs-12 col-sm-4 margin-top-21')), $oMainRow2)
			->move($this->getField('description')->divAttr(array('class' => 'form-group col-xs-12')), $oMainRow3)
			->add($oScript);

		return $this;
	}

	/**
	 * Processing of the form. Apply object fields.
	 * @hostcms-event Event_Controller_Edit.onAfterRedeclaredApplyObjectProperty
	 */
	protected function _applyObjectProperty()
	{
		// Не задан цвет
		if (is_null(Core_Array::getPost('color')))
		{
			$this->_formValues['color'] = '#ccc';
		}

		// Не задана иконка
		if (trim(Core_Array::getPost('icon', '')) == FALSE)
		{
			$this->_formValues['icon'] = 'fa fa-circle';
		}

		parent::_applyObjectProperty();

		if ($this->_object->default)
		{
			$this->_object->setDefault();
		}

		Core_Event::notify(get_class($this) . '.onAfterRedeclaredApplyObjectProperty', $this, array($this->_Admin_Form_Controller));

		return $this;
	}
}