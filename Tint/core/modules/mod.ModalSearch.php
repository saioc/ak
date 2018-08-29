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
<!-- 搜索模态框 -->
<div id="globalSearch" class="js-search search-form search-form-modal fadeZoomIn" role="dialog" aria-hidden="true">
    <form method="get" action="<?php echo home_url(); ?>" role="search">
        <div class="search-form-inner">
            <div class="search-form-box">
                <input class="form-search" type="text" name="s" placeholder="<?php _e('Type a keyword', 'tt'); ?>">
            </div>
        </div>
    </form>
</div>