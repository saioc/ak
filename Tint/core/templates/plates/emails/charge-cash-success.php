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
<?php $this->layout('base', array('blogName' => $blogName, 'logo' => tt_get_option('tt_logo'), 'home' => home_url(), 'shopHome' => tt_url_for('shop_archive'))) ?>

<p>您已成功充值了<?=$this->e($cashNum)?>元，当前余额为：<?=$this->e($currentCash)?>，如有任何疑问，请及时联系我们（Email:<a href="mailto:<?=$this->e($adminEmail)?>" target="_blank"><?=$this->e($adminEmail)?></a>）。</p>
