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
<!-- 返回顶部等固定按钮 -->
<div id="fix-controls" class="wow bounceInRight">
    <a class="scroll-to scroll-top" href="javascript:" data-tooltip="<?php _e('Scroll to top', 'tt'); ?>"><i class="tico tico-arrow-up2"></i></a>
    <?php if (tt_get_option('tt_enable_k_fdgj', true)) { ?>
    <!-- 右边浮窗扩展按钮注释开始 -->
    <?php if($qq = tt_get_option('tt_site_qq')) { ?>
    <a class="scroll-to scroll-comment" href="<?php echo 'http://wpa.qq.com/msgrd?v=3&uin=' . $qq . '&site=qq&menu=yes'; ?>" data-tooltip="QQ在线" target="_blank"><i class="tico tico-qq"></i></a>
    <?php } ?>
    <a class="scroll-to scroll-comment" href="/shop" data-tooltip="在线商城"><i class="tico tico-shopping-cart"></i></a>
    <a class="scroll-to scroll-search" href="javascript:void(0)" data-toggle="modal" data-target="#globalSearch" data-backdrop="1" data-tooltip="搜索"><i class="tico tico-search"></i></a>
    <!-- 右边浮窗扩展按钮注释结束 -->
    <?php } ?>
    <a class="scroll-to scroll-bottom" href="javascript:" data-tooltip="<?php _e('Scroll to bottom', 'tt'); ?>"><i class="tico tico-arrow-down2"></i></a>
</div>