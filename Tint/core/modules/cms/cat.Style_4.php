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
<div class="cms-cat cms-cat-s4">
    <?php
    global $cat_data;
    $posts = $cat_data->posts;
    $i = 0;
    foreach ($posts as $post) {
        $r = fmod($i, 3) + 1;
        $i++;
        if ($i <= 3) {
            ?>
            <div class="col col-large col-1_3 col-s<?php echo $r; ?>">
                <article id="<?php echo 'post-' . $post['ID']; ?>" class="post type-post status-publish <?php echo 'format-' . $post['format']; ?>">
                    <div class="entry-thumb hover-scale">
                        <a href="<?php echo $post['permalink']; ?>"><img src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $post['thumb']; ?>" class="thumb-medium wp-post-image lazy" alt="<?php echo $post['title']; ?>"></a>
                    </div>
                    <div class="entry-detail">
                        <h3 class="entry-title">
                            <a href="<?php echo $post['permalink']; ?>"><?php echo $post['title']; ?></a>
                        </h3>
                        <div class="entry-meta">
                            <span class="datetime text-muted"><i class="tico tico-alarm"></i><?php echo $post['datetime']; ?></span>
                            <span class="views-count text-muted"><i class="tico tico-eye"></i><?php printf(__('%d (Views)', 'tt'), $post['views']); ?></span>
                            <span class="comments-count text-muted"><i class="tico tico-comments-o"></i><?php printf(__('%d (Comments)', 'tt'), $post['comment_count']); ?></span>
                        </div>
                        <p class="entry-excerpt"><?php echo $post['excerpt']; ?></p>
                    </div>
                </article>
            </div>
            <?php
        } elseif ($i <= 9) {
            ?>
        <div class="col col-small col-1_3 col-s<?php echo $r; ?>">
            <article id="<?php echo 'post-' . $post['ID']; ?>" class="post type-post status-publish <?php echo 'format-' . $post['format']; ?>">
                <div class="entry-thumb hover-scale">
                    <a href="<?php echo $post['permalink']; ?>"><img width="250" height="170" src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $post['thumb']; ?>" class="thumb-medium wp-post-image lazy" alt="<?php echo $post['title']; ?>" style="max-height: 175px;"></a>
                </div>
                <div class="entry-detail">
                    <h3 class="entry-title">
                        <a href="<?php echo $post['permalink']; ?>"><?php echo $post['title']; ?></a>
                    </h3>
                </div>
            </article>
        </div>
            <?php
        }
    }
    ?>
</div>