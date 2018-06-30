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
<?php $fullSlide = tt_get_option('tt_enable_home_full_width_slides', false); ?>
<div id="content" class="wrapper container right-aside">
    <?php load_mod(('banners/bn.Top')); ?>
    <?php if(tt_get_option('tt_enable_home_slides', false)) : ?>
        <!-- 顶部Slides + Popular -->
        <section id="mod-show" class="content-section clearfix <?php if ($fullSlide) echo 'full'; ?>">
            <?php load_mod('mod.HomeSlide'); ?>
            <?php if ($fullSlide == false) { load_mod('mod.HomePopular'); } ?>
        </section>
        <?php load_mod(('banners/bn.Slide.Bottom')); ?>
    <?php endif; ?>
    <!-- 分类模块与边栏 -->
    <section id="mod-insideContent" class="main-wrap content-section clearfix">
        <!-- 分类模块列表 -->
        <?php load_mod('mod.HomeCMSCats'); ?>
        <!-- 边栏 -->
        <?php load_mod('mod.Sidebar'); ?>
    </section>
    <?php if(tt_get_option('tt_home_products_recommendation', false)) { ?>
        <!-- 商品展示 -->
        <section id="mod-sales" class="content-section clearfix">
            <?php load_mod('mod.ProductGallery', true); ?>
        </section>
    <?php } ?>
    <?php load_mod(('banners/bn.Bottom')); ?>
</div>
<?php tt_get_footer(); ?>