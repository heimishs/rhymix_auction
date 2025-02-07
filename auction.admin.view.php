<?php

/**
 * 경매모듈
 *
 * Copyright (c) 위드레브
 *
 * Generated with https://www.poesis.dev/tools/modulegen
 */
class AuctionAdminView extends Auction
{

		/**
	 * 초기화
	 */
	public function init()
	{
		 // module_srl이 있으면 미리 체크하여 존재하는 모듈이면 module_info 세팅
		 $module_srl = Context::get('module_srl');
		 if(!$module_srl && $this->module_srl) 
		 {
			 $module_srl = $this->module_srl;
			 Context::set('module_srl', $module_srl);
		 }

		 // module model 객체 생성 
		 $oModuleModel = &getModel('module');

		 // module_srl이 넘어오면 해당 모듈의 정보를 미리 구해 놓음
		 // 브라우져 타이틀, 관리자, 레이아웃 등 xe_modules table의 값과 정보
		 if($module_srl) 
		 {
			 $module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
			 $this->module_info = $module_info;
			 Context::set('module_info',$module_info);
		 }

		 // 모듈 카테고리 목록을 구함
		 $module_category = $oModuleModel->getModuleCategories();
		 Context::set('module_category', $module_category);


		 // 내용 입력/수정/삭제 후 백엔드 콜백 함수를 처리하는 javascript 추가
		 Context::addJsFile($this->module_path.'tpl/js/auction_admin.js');
		 // 관리자 화면 템플릿 경로 지정
		 $this->setTemplatePath($this->module_path . 'tpl');
	}

	public function dispAuctionAdminIndex(){
		$args = new stdclass();
		
		// auction admin model 객체 생성
		$oAuctionAdminModel = getAdminModel('auction');
		// auction module_srl 목록 가져옴
		$output = $oAuctionAdminModel->getAuctionAdminList($args);

		 // 템플릿에 전해주기 위해 set함
		 Context::set('auction_list', $output->data);
		
		// 스킨 파일 지정
		$this->setTemplateFile('index');
	}

	/**
	 * 경매게시판 생성
	 */
	public function dispAuctionAdminInsert()
	{
		// 스킨 목록을 구해옴
		$oModuleModel = getModel('module');
        $skin_list = $oModuleModel->getSkins($this->module_path);
        Context::set('skin_list',$skin_list);

		$oLayoutModel = getModel('layout');
		$layout_list = $oLayoutModel->getLayoutList();
		Context::set('layout_list', $layout_list);
		
		
		// 스킨 파일 지정
		$this->setTemplateFile('auctionAdminInsert');
	}

	/**
      * @brief 경매게시판 수정
     **/
    function dispAuctionAdminInfo() 
    {
        $this->dispAuctionAdminInsert();
    }

	/**
	 * 경매게시판 생성
	 */
	public function dispAuctionAdminDelete()
	{
		// 삭제할 module_srl 가져오기
		$module_srl = Context::get('module_srl');
			
		if (!$module_srl) {
			return new BaseObject (-1, '잘못된 요청입니다.');
		}

		// 모듈 정보 가져오기
		$oModuleModel = getModel('module');
		$module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
		
		if (!$module_info) {
			return new BaseObject (-1, '존재하지 않는 경매게시판입니다.');
		}


		// 템플릿에 데이터 전달
		Context::set('module_info', $module_info);
		Context::set('module_srl', $module_srl);

		// 스킨 파일 지정
		$this->setTemplateFile('delete');
	}

	

	/**
	 * 관리자 설정 화면 예제
	 */
	public function dispAuctionAdminConfig()
	{
		// 불러올 설정값 모델 불러오기
		$oLayoutModel = getModel('layout');
		$oModuleModel = getModel('module');

		// 현재 설정 상태 불러오기
		$config = $this->getConfig();

		$module_srl = Context::get('module_srl');

		// if(!$module_srl){
		// 	$module_srl = $oModuleModel->getModuleSrlByMid($config->mid);
		// }


		// 디버깅용
		// var_dump($module_srl);
		// var_dump($module_srl);
		

		// 레이아웃 리스트값 가져온 뒤 프론트 View 보내기
		Context::set('layout_list', $oLayoutModel->getLayoutList());
		
		// 모바일 레이아웃 리스트 가져온 뒤 프론트 View 보내기
		Context::set('mlayout_list', $oLayoutModel->getLayoutList(0, 'M'));

		// 모듈 스킨 리스트를 가져온 뒤 프론트 View 보내기
		Context::set('skin_list', $oModuleModel->getSkins($this->module_path));

		// 불러온 모듈 설정 값 프론트 View로 보내기
		Context::set('auction_config', $config);

		

		// 스킨 파일 지정
		$this->setTemplateFile('config');
	}
}