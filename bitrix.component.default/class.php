<?php
use Bitrix\ {
	Main, 
	Main\Loader, 
	Main\Type\DateTime,
	Main\SystemException,
	Main\Localization\Loc
};

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ContactPledgeComponent extends CBitrixComponent
{
	private $IBLOCK_ID = 82;

	public function onIncludeComponentLang()
	{
		Loc::loadMessages(__FILE__);
	}

	protected function checkModules($modules)
	{
		foreach($modules as $module)
		{
			if(!Loader::includeModule($module)) 
			{
				$this->errors[] = "Module {$module} required";	
				return false;
			}
		}
		return true;
	}

	protected function getResult()
	{
		if ($this->errors) throw new SystemException(current($this->errors));

		//$this->arParams
		//$this->arResult

	}

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->checkModules(['crm']);
			$this->getResult();
			$this->includeComponentTemplate();
		}
		catch (SystemException $e)
		{
			ShowError($e->getMessage());
		}
	}

}
?>