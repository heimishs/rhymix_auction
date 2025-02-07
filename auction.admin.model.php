<?php

/**
 * 경매모듈
 *
 * Copyright (c) 위드레브
 *
 * Generated with https://www.poesis.dev/tools/modulegen
 */
class AuctionAdminModel extends Auction
{
    // 목록 가져오기
    function getAuctionAdminList($args)
    {
        $output = executeQueryArray('auction.getAuctionAdminList', $args);
        return $output;
    }
}