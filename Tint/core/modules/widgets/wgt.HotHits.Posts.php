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
 * Class HotHitPosts
 */
class HotHitPosts extends WP_Widget {
    function __construct() {
        parent::__construct(false, __('TT-Hot Hit Posts', 'tt'), array( 'description' => __('TT-Show several most viewed posts', 'tt') ,'classname' => 'widget_hot-posts widget_hothit-posts wow bounceInRight'));
    }

    function widget($args, $instance) {
        // parent::widget($args, $instance); // TODO: Change the autogenerated stub
        // extract($args);
        $vm = HotHitPostsVM::getInstance($instance['num']);
        if($vm->isCache && $vm->cacheTime) {
            echo '<!-- Hothit posts widget cached ' . $vm->cacheTime . ' -->';
        }
        $hothit_posts = $vm->modelData;
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if($instance['title']) { echo $args['before_title'] . $instance['title'] . $args['after_title']; } ?>
        <div class="widget-content">
        <?php foreach ($hothit_posts as $hothit_post) { ?>
            <article id="<?php echo 'post-' . $hothit_post['ID']; ?>" class="post type-post status-publish hothit-post">
                <div class="entry-thumb hover-scale">
                    <a href="<?php echo $hothit_post['permalink']; ?>"><img width="200" height="136" src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $hothit_post['thumb']; ?>" class="thumb-small wp-post-image lazy" alt="<?php echo $hothit_post['title']; ?>"></a>
                </div>
                <div class="entry-detail">
                    <h2 class="entry-title"><a href="<?php echo $hothit_post['permalink']; ?>" rel="bookmark"><?php echo $hothit_post['title']; ?></a></h2>
                    <div class="entry-meta entry-meta-1">
                        <span class="view-count text-muted"><i class="tico tico-eye"></i><?php echo $hothit_post['views']; ?></a></span>
                        <span class="entry-date text-muted"><time class="entry-date" datetime="<?php echo $hothit_post['datetime']; ?>" title="<?php echo $hothit_post['datetime']; ?>"><i class="tico tico-alarm"></i><?php echo $hothit_post['time']; ?></time></span>
                    </div>
                </div>
            </article>
        <?php } ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        // TODO 清除小工具缓存

        return $new_instance;
    }

    function form($instance) {
        $title = esc_attr(isset($instance['title']) ? $instance['title'] : __('HOT HITS', 'tt'));
        $num = absint(isset($instance['num']) ? $instance['num'] : 5);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title：','tt'); ?><input class="input-lg" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number：','tt'); ?></label><input class="input-lg" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text"  value="<?php echo $num; ?>" /></p>
        <?php
    }
}

/* 注册小工具 */
if ( ! function_exists( 'tt_register_widget_hot_hit_posts' ) ) {
    function tt_register_widget_hot_hit_posts() {
        register_widget( 'HotHitPosts' );
    }
}
add_action( 'widgets_init', 'tt_register_widget_hot_hit_posts' );