<?php
get_header();
?>
				<div id="main" class="group">
					<div id="blog" class="left-col">
						<?php if ( have_posts() ) : while ( have_posts() ) :
							the_post(); ?>
							<div class="post">
								<h2><?php the_title(); ?></h2>
								
								<?php the_content(); ?>
							</div>

						<?php endwhile; else: ?>
							<p><?php _e('No Posts were found. Sorry!'); ?></p>
						<?php endif; ?>
						
					</div>
					<?php get_sidebar(); ?>
				</div>

<?php
get_footer();
?>