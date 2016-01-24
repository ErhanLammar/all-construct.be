<?php

$icon_styles = array();
if(!empty($instance['icons']['color'])) $icon_styles[] = 'color: '.$instance['icons']['color'];
if(!empty($instance['icons']['size'])) $icon_styles[] = 'font-size: '.$instance['icons']['size'];

$btn_class = array('iw-so-article-btn');
if( !empty($instance['styling']['btn-hover']) ) $btn_class[] = 'iw-so-article-btn-hover';
if( !empty($instance['styling']['btn-click']) ) $btn_class[] = 'iw-so-article-btn-click';

if( $instance['design']['columns'] == 1 ):
	$cols = ' iw-small-12';
elseif( $instance['design']['columns'] == 2 ):
	$cols = ' iw-medium-6 iw-small-12';
elseif( $instance['design']['columns'] == 3 ):
	$cols = ' iw-large-4 iw-medium-6 iw-small-12';
elseif( $instance['design']['columns'] == 4 ):
	$cols = ' iw-large-3 iw-medium-6 iw-small-12';
endif;

if ( $instance['design']['responsive'] ):
	$img_col_class = ' iw-large-4 iw-medium-5';
	$ctnt_col_class = ' iw-large-8 iw-medium-7';
else:
	$img_col_class = ' iw-large-4 iw-medium-5 iw-small-4';
	$ctnt_col_class = ' iw-large-8 iw-medium-7 iw-small-8';
endif;

if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
?>

<?php
// Setting up posts query

$post_selector_pseudo_query = $instance['posts'];
$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );
$query_result = new WP_Query( $processed_query );
?>

<?php

// Looping through the posts

if($query_result->have_posts()) : ?>

	<div class="iw-row" data-equalizer>

		<?php while($query_result->have_posts()) : $query_result->the_post(); ?>

			<div class="iw-so-article<?php echo $cols; ?> iw-cols" data-equalizer-watch>

				<div class="iw-row iw-so-thumb-left">

					<div class="iw-left iw-cols<?php echo $img_col_class; ?>">

						<div class="iw-so-article-thumb">

							<a href="<?php the_permalink(); ?>"><center><?php the_post_thumbnail($instance['design']['img-size']); ?></center></a>

							<?php 
							if ( get_post_format() && $instance['design']['format'] ):
								echo siteorigin_widget_get_icon( $instance['icons'][get_post_format()], $icon_styles );
							elseif ( $instance['design']['format'] ):
								echo siteorigin_widget_get_icon( $instance['icons']['standard'], $icon_styles );
							endif;
							?>

						</div>

					</div>

					<div class="iw-right iw-cols<?php echo $ctnt_col_class; ?>">

						<?php if ($instance['design']['byline-above']) : ?>

							<?php $byline_above = apply_filters( 'wpinked_byline', $instance['design']['byline-above'] ); ?>

							<p class="iw-so-article-byline-above <?php echo $instance['styling']['align']; ?>">

								<?php echo sprintf( $byline_above, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

							</p>

						<?php endif; ?>

						<h2 class="iw-so-article-title <?php echo $instance['styling']['align']; ?>"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

						<?php if ($instance['design']['byline-below']) : ?>

							<?php $byline_below = apply_filters( 'wpinked_byline', $instance['design']['byline-below'] ); ?>

							<p class="iw-so-article-byline-below <?php echo $instance['styling']['align']; ?>">

								<?php echo sprintf( $byline_below, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

							</p>

						<?php endif; ?>

						<?php if ( $instance['design']['content'] ): ?>

							<div class="iw-so-article-full">
								<?php global $more; $more = 1; the_content(); ?>
							</div>

						<?php elseif ( $instance['design']['excerpt'] ): ?>

							<p class="iw-so-article-excerpt <?php echo $instance['styling']['align']; ?>">
								<?php if ( $instance['design']['e-link'] ): ?>
									<a href="<?php the_permalink(); ?>">
										<?php wpinked_so_post_excerpt( $instance['design']['excerpt-length'], $instance['design']['excerpt-after'] ); ?>
									</a>
								<?php else: ?>
									<?php wpinked_so_post_excerpt( $instance['design']['excerpt-length'], $instance['design']['excerpt-after'] ); ?>
								<?php endif; ?>
							</p>

						<?php endif; ?>

						<?php if ($instance['design']['byline-end']) : ?>

							<?php $byline_end = apply_filters( 'wpinked_byline', $instance['design']['byline-end'] ); ?>

							<p class="iw-so-article-byline-end <?php echo $instance['styling']['align']; ?>">

								<?php echo sprintf( $byline_end, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

							</p>

						<?php endif; ?>

						<?php if ($instance['design']['button']) : ?>

							<div class="iw-so-article-button">
								<a class="<?php echo esc_attr(implode(' ', $btn_class)); ?>" href="<?php the_permalink(); ?>">
									<?php echo $instance['design']['btn-text']; ?>
								</a>
							</div>

						<?php endif; ?>

					</div>

				</div>

			</div>    

		<?php endwhile; wp_reset_postdata(); ?>

	</div>

<?php endif; ?>