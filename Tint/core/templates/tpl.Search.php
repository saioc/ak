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
<?php global $tt_vars; ?>
<?php $tt_vars['search'] = get_search_query(); ?>
<?php $tt_vars['page'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
<?php tt_get_header(); ?>
<div id="content" class="wrapper right-aside">
    <?php $vm = SearchVM::getInstance($tt_vars['page'], $tt_vars['search']); ?>
    <?php if($vm->isCache && $vm->cacheTime) { ?>
        <!-- Search results cached <?php echo $vm->cacheTime; ?> -->
    <?php } ?>
    <?php $data = $vm->modelData; $tt_vars['data'] = $data; ?>
  <?php if (tt_get_option('tt_enable_k_fbsbt', true)) { ?>
    <!-- Billboard -->
    <section class="billboard search-header">
        <div class="container text-center">
            <h1><i class="tico tico-search"></i><?php printf(__('Search %s', 'tt'), $tt_vars['search']); ?></h1>
            <p><?php printf(__('%d results in total', 'tt'), $data->count); ?></p>
        </div>
    </section>
  <?php } ?>
    <section id="mod-insideContent" class="main-wrap container content-section clearfix">
        <!-- 搜索结果 -->
        <?php load_mod('mod.SearchPosts'); ?>
        <!-- 边栏 -->
        <?php load_mod('mod.Sidebar'); ?>
    </section>
</div>
<?php tt_get_footer(); ?>