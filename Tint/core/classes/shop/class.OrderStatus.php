<?php
/**
 * Copyright (c) 2014-2018, www.kuacg.com
 * All right reserved.
 *
 * @since 2.5.0
 * @package Tint-K
 * @author 酷ACG资源网
 * @date 2018/02/14 10:00
 * @link https://www.kuacg.com/18494.html
 */
?>
<?php

/**
 * Class OrderStatus
 *
 * 定义order的status enum
 */
final class OrderStatus {

    const DEFAULT_STATUS = 0;

    const WAIT_PAYMENT = 1;

    const PAYED_AND_WAIT_DELIVERY = 2;

    const DELIVERED_AND_WAIT_CONFIRM = 3;

    const TRADE_SUCCESS = 4;

    const TRADE_CLOSED = 9;
}