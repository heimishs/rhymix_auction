<?php

/**
 * 경매모듈
 *
 * Copyright (c) 위드레브
 *
 * Generated with https://www.poesis.dev/tools/modulegen
 */
class Auction extends ModuleObject
{
	/**
	 * 모듈 설정 캐시를 위한 변수.
	 */
	protected static $_config_cache = null;

	/**
	 * 모듈 설정을 가져오는 함수.
	 *
	 * 캐시 처리되기 때문에 ModuleModel을 직접 호출하는 것보다 효율적이다.
	 * 모듈 내에서 설정을 불러올 때는 가급적 이 함수를 사용하도록 한다.
	 *
	 * @return object
	 */
	public function getConfig()
	{
		if (self::$_config_cache === null)
		{
			$oModuleModel = getModel('module');
			self::$_config_cache = $oModuleModel->getModuleConfig($this->module) ?: new stdClass;
		}
		return self::$_config_cache;
	}

	/**
	 * 모듈 설정을 저장하는 함수.
	 *
	 * 설정을 변경할 필요가 있을 때 ModuleController를 직접 호출하지 말고 이 함수를 사용한다.
	 * getConfig()으로 가져온 설정을 적절히 변경하여 setConfig()으로 다시 저장하는 것이 정석.
	 *
	 * @param object $config
	 * @return object
	 */
	public function setConfig($config)
	{
		$oModuleController = getController('module');
		$result = $oModuleController->insertModuleConfig($this->module, $config);
		if ($result->toBool())
		{
			self::$_config_cache = $config;
		}
		return $result;
	}

	/**
	 * XE Object를 생성하여 반환한다.
	 *
	 * XE 1.8 이하, XE 1.9 이상, PHP 7.1 이하, PHP 7.2 이상 모두 호환된다.
	 * 기본적인 사용법은 return new Object(-1, 'error'); 라고 쓸 자리에
	 * return $this->createObject(-1, 'error'); 라고 쓰면 된다.
	 *
	 * 반환할 언어 내용 중 %s, %d 등 변수를 치환하는 부분이 있다면
	 * 치환할 내용을 추가 파라미터로 넘겨주면 sprintf()의 역할까지 해준다.
	 *
	 * @param string $message
	 * @param $arg1, $arg2 ...
	 * @return object
	 */
	public function createObject($status = 0, $message = 'success' /* $arg1, $arg2 ... */)
	{
		$args = func_get_args();
		if (count($args) > 2)
		{
			global $lang;
			$message = vsprintf($lang->$message, array_slice($args, 2));
		}
		return class_exists('BaseObject') ? new BaseObject($status, $message) : new Object($status, $message);
	}

	/**
	 * 모듈 설치 콜백 함수.
	 *
	 * 트리거 등록 외에 따로 할 일이 없다면 수정할 필요 없다.
	 *
	 * @return object
	 */
	public function moduleInstall()
	{

	}

	/**
	 * 모듈 업데이트 확인 콜백 함수.
	 *
	 * 트리거 등록 외에 따로 할 일이 없다면 수정할 필요 없다.
	 *
	 * @return bool
	 */
	public function checkUpdate()
	{

	}

	/**
	 * 모듈 업데이트 콜백 함수.
	 *
	 * 트리거 등록 외에 따로 할 일이 없다면 수정할 필요 없다.
	 *
	 * @return object
	 */
	public function moduleUpdate()
	{

	}

	/**
	 * 캐시파일 재생성 콜백 함수.
	 *
	 * @return void
	 */
	public function recompileCache()
	{

	}
}
