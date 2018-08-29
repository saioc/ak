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
<?php if (tt_get_option('tt_enable_tinection_home', false) && (!isset($_GET['mod']) || $_GET['mod'] != 'blog')): ?>
    <?php load_tpl('tpl.CmsHome'); ?>
<?php else: ?>
    <?php load_tpl('tpl.NewHome'); ?>
<?php endif; ?>