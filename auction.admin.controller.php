<?php

/**
 * 경매모듈
 *
 * Copyright (c) 위드레브
 *
 * Generated with https://www.poesis.dev/tools/modulegen
 */
class AuctionAdminController extends Auction
{
	/**
	 * 관리자 설정 저장 액션 예제
	 */
	public function procAuctionAdminInsert()
	{
		// module 모듈의 model/controller 객체 생성
		$oModuleController = &getController('module');
		$oModuleModel = &getModel('module');

		// request 값을 모두 받음
		$args = new stdClass();
		$args = Context::getRequestVars();
		$args->module = 'auction';

		

		$module_info = new stdClass();
		// module_srl이 넘어오면 원 모듈이 있는지 확인
		if($args->module_srl) 
		{
			$module_info = $oModuleModel->getModuleInfoByModuleSrl($args->module_srl);
			if($module_info->module_srl != $args->module_srl) unset($args->module_srl);
		}

		// module_srl 값의 존재여부에 따라 insert/update
		if(!$args->module_srl) 
		{
			$output = $oModuleController->insertModule($args);
			$msg_code = 'success_registed';
		} 
		else 
		{
			$output = $oModuleController->updateModule($args);
			$msg_code = 'success_updated';
		}

		// 오류가 있으면 리턴
		if(!$output->toBool()) return $output;

		// $output은 Object객체로 리턴
		// $oModuleController->insertModule() 또는 $oModuleController->updateModule() 에서 리턴시 설정한 module_srl를 가져옴
		$module_srl = $output->get('module_srl');

		// $this객체에 add()로 변수를 등록하여 호출하여 XMLRPC로 리턴시 값을 추가함
		$this->add('page',Context::get('page'));
		$this->add('module_srl',$output->get('module_srl'));
		$this->setMessage($msg_code);
	}

	/**
	 * 경매게시판 삭제 실행
	 */
	/**
 * 경매게시판 삭제 실행
 */
	/**
 * 경매게시판 삭제 실행
 */
	public function procAuctionAdminDelete()
	{
		$module_srl = Context::get('module_srl');
		$oModuleController = getController('module');
		// 이제 모듈 삭제 실행
		$output = $oModuleController->deleteModule($module_srl);

		var_dump($output);
		exit;
		if (!$output->toBool()) {
			return new BaseObject(-1, '삭제 중 오류가 발생했습니다.');
		}

		

		// 삭제 후 목록 페이지로 이동
		$returnUrl = getUrl('act', 'dispAuctionAdminIndex');
		return $this->setRedirectUrl($returnUrl);
	}



}