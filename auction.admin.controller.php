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
	public function procAuctionAdminInsertConfig()
	{

		// module 모듈의 model/controller 객체 생성
		$oModuleController = &getController('module');
		$oModuleModel = &getModel('module');

		// 현재 모듈설정 상태 불러오기
		$config = $this->getConfig();

		// 입력된 값을 모두 받음
		$args = Context::getRequestVars();

		$config->mid = $args->mid;

		// var_dump($config);
		var_dump($args);

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
	
		// 변경된 설정을 저장
		$output = $this->setConfig($config);
		if (!$output->toBool())
		{
			return $output;
		}

		
		exit;
		// 설정 화면으로 리다이렉트
		$this->setMessage('success_registed');
		$this->add('module_srl',$output->get('module_srl'));
		$this->setRedirectUrl(Context::get('success_return_url'));
	}
}
