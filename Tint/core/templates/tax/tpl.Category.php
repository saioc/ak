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
<?php tt_get_header(); ?>
<?php
    $cat_id = get_queried_object_id();
    $alt_tpl_cats = tt_get_option('tt_alt_template_cats', array());
    if (isset($alt_tpl_cats[$cat_id]) && $alt_tpl_cats[$cat_id]) {
        load_mod('mod.Category.Blocks');
    } else {
        load_mod('mod.Category.Normal');
    }
?>
<?php tt_get_footer(); ?>