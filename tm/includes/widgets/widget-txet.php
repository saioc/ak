<?php
//2和1文章插件
//widget suxingme_txet

add_action('widgets_init', create_function('', 'return register_widget("suxingme_txet");'));
class suxingme_txet extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => '可以选择显示最新文章、随机文章。' );
		parent::__construct('suxingme_txet', __('文字文章'), $widget_ops);
	}

    function widget($args, $instance) {
        extract( $args );
		$limit = $instance['limit'];
		$title = apply_filters('widget_name', $instance['title']);
		$html =  $instance['html'];
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		echo $before_widget;
		echo $before_title.$title.$after_title; 
        echo suxingme_widget_txet($orderby,$limit,$cat,$html);
        echo $after_widget;	
    }


	function form($instance) {
		$instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$instance['html'] = ! empty( $instance['html'] ) ? esc_attr( $instance['html'] ) : '';
		$instance['orderby'] = ! empty( $instance['orderby'] ) ? esc_attr( $instance['orderby'] ) : '';
		$instance['cat'] = ! empty( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
		$instance['limit']    = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 5;
		show_category();
?>
<p style="clear: both;padding-top: 5px;">
	<label>显示标题：（例如：最新文章、随机文章）
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label> 排序方式：
		<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
			<option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
			<option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机文章</option>
		</select>
	</label>
</p>
<p>
	<label>
		分类限制：
		<p>只显示指定分类，填写数字，用英文逗号隔开，例如：1,2 </p>
		<p>排除指定分类的文章，填写负数，用英文逗号隔开，例如：-1,-2。</p>
		<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
	</label>
</p>
<p>
	<label> 显示数目：
		<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
	</label>
</p>
<p style="clear: both;padding-top: 5px;">
	<label>第三行html：（例如：广告）
	
	<textarea id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" class="widefat"  rows="6"> <?php echo $instance['html']; ?></textarea>
	</label>
</p>
<?php
	}
}

function suxingme_widget_txet($orderby,$limit,$cat,$html){
?>
		<ul class="">
			<?php
				$args = array(
								'post_status' => 'publish', // 只选公开的文章.
								'in_category' => array(get_the_ID()),//排除当前文章
								'ignore_sticky_posts' => 1, // 排除置頂文章.
								'orderby' =>  $orderby, // 排序方式.
								'cat'     => $cat,
								'order'   => 'DESC',
								'showposts' => $limit,
								'tax_query' => array( array( 
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array(
									//请根据需要保留要排除的文章形式
									'post-format-aside',
									
									),
								'operator' => 'NOT IN',
								) ),
							);
				$query_posts = new WP_Query();
				$query_posts->query($args);
				$i=1;
				while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
				<?php if($i == 3){ ?>
					<li style="border-bottom: #e5e5e5 1px solid;padding: 10px 0;background: #f2f2f2;color: #F74840;">
                              <?php	echo $html;	 ?> 
					</li>
				<?php }else{ ?>
					<li style=" border-bottom: #e5e5e5 1px solid; padding: 10px 0; ">
					 
					 	 
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_content(); ?></a>
							 
					
					 
					</li>
				<?php } $i++;} wp_reset_query();?>
		</ul>
<?php
}
?>