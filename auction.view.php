<?php

/**
 * 경매모듈
 *
 * Copyright (c) 위드레브
 *
 */
class AuctionView extends Auction
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 스킨 경로 지정
		$this->setTemplatePath($this->module_path . 'skins/' . ($this->module_info->skin ?: 'default'));
	}

	/**
	 * 메인 화면
	 */
	public function dispAuctionIndex()
	{
		// 스킨 파일명 지정
		$this->setTemplateFile('index');
	}

	/**
	 * 작성 화면
	 */
	public function dispAuctionInsert()
	{
		// 텍스트 에디터 불러오기
		$option = new stdClass();
		$oEditorModel = getModel('editor');
		$option->primary_key_name = $auction_srl;
		$option->content_key_name = 'auction_content';
		$option->allow_fileupload = true;
		$option->enable_autosave = false;
		$option->enable_default_component = true;
		$option->enable_component = false;
		$option->resizable = false;
		$option->height = 300;
		$editor = $oEditorModel->getEditor($auction_srl, $option);

		// 프론트에서 사용할 수 있도록 템플릿 변수로 설정
		Context::set('editor', $editor);

		// 스킨 파일명 지정
		$this->setTemplateFile('insert');
	}
}