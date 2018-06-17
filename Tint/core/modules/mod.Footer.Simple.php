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
<!-- Footer -->
<footer class="footer simple-footer">
    <div class="foot-copyright">&copy;&nbsp;<?php echo tt_copyright_year(); ?><?php echo ' ' . get_bloginfo('name') . ' All Right Reserved · <b style="color: #ff4425;">♥</b>&nbsp;<a href="https://www.kuacg.com/" title="KuAcg" rel="link" target="_blank">KuAcg</a> & Design by <a href="https://www.kuacg.com/" rel="link" title="酷ACG">酷ACG.</a>'; ?>
    </div>
</footer>
<?php if (tt_get_option('tt_enable_k_bkpfdh', true)) { ?>
<!-- 版块动画特效JS -->
<?php if( wp_is_mobile() ) { ?>
<script type="text/javascript" src="<?php echo THEME_ASSET.'/js/custom-m.js'; ?>"></script>
<?php }else{ ?>
<script type="text/javascript" src="<?php echo THEME_ASSET.'/js/custom.js'; ?>"></script>
<?php } ?>
<script>POWERMODE.colorful = true;POWERMODE.shake = false;document.body.addEventListener('input', POWERMODE);</script>
<?php } ?>
<?php if(tt_get_option('tt_foot_code')) { echo tt_get_option('tt_foot_code'); } ?>
<?php wp_footer(); ?>
<!--<?php echo get_num_queries();?> queries in <?php timer_stop(1); ?> seconds.-->
</body>
</html>