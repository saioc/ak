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
tt_get_header();
?>
<div class="wrapper container no-aside">
    <div class="main inner-wrap">
        <div class="box text-center" id="404-box">
            <h1>404</h1>
            <p class="404-msg"><?php _e('The page you were looking for doesn\'t exist' , 'tt'); ?></p>
            <div class="btns">
                <a class="btn btn-lg btn-success link-home" id="linkBackHome" href="<?php echo home_url(); ?>" title="<?php _e('Go Back Home', 'tt'); ?>" role="button"><?php _e('Redirect to home after <span class="num">5</span>s', 'tt'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php
tt_get_footer();