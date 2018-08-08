<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UC_Santa_Cruz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- breadcrumbs -->
		<div class="breadcrumbs">
			<p>
			<?php if (function_exists('yoast_breadcrumb')){
				yoast_breadcrumb();
			}?>
			</p>
		</div>
		<?php the_title( '<h1 class="entry-title programs">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php ucsc_underscore_post_thumbnail(); ?>
    <?php get_template_part( 'template-parts/academics', 'subpages' ); ?>
	<div class="entry-content">
		<?php
        // the_content();
        // Call Programs post
        $args = array (
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            );
        $program_query = new WP_Query ($args);
        if($program_query->have_posts()): while ($program_query->have_posts()):$program_query->the_post();

        //Set up the parts
        $program_image = get_the_post_thumbnail($post_id, 'thumbnail');
        $program_title = get_the_title();
        $program_subtitle = get_post_meta(get_the_ID(), '_ucsc_program_subtitle_text', true);
        $program_blurb = wpautop(get_post_meta(get_the_ID(), '_ucsc_program_blurb_wysiwyg', true));
        $program_departments = get_post_meta(get_the_ID(), '_ucsc_attached_cmb2_attached_department', true);

        $program_majors = get_post_meta(get_the_ID(), '_ucsc_attached_cmb2_attached_majors', true);
        
        //print_r($program_departments);
        $degree_args = array (
            'taxonomy' => 'degrees-offered',
            'hide_empty' => true,
        );
        $degrees = new WP_Term_Query($degree_args);
        echo '<div class="program-row">';
        echo '<div class="program-image">'.$program_image.'</div>';
        echo '<div class="program-content">';
        echo '<h3>'.$program_title.'</h3>';
        if ($program_subtitle !=''){
            echo '<p>'.$program_subtitle.'</p>';
        }
        

        if (!empty($degrees->terms)){
            echo '<ul>';
            foreach ($degrees->terms as $degree){
                if ($degree->name != ''){
                echo '<li>'.$degree->name.'</li>';
            }
        }
            echo '</ul>';
            
        }
        // $degrees = get_terms($degree_args);
        // if (!empty($degrees)&& !is_wp_error($degrees)) {
            // echo '<ul>';
            // foreach ($degrees as $degree){
                // echo '<li>'.$degree->name.'</li>';
            // }
            // echo '</ul>';
        // }
        echo '<div class="program-blurb">'.$program_blurb.'</div>';
        echo '</div>';//end Program Content
        echo '<div class="program-footer">';
        echo '<div class="program-department-link">';
        foreach ($program_departments as $department){
            // $dept_post = get_post($department);
            // $dept_title = $dept_post->post_title;
            $dept_link = esc_url(get_permalink($department));
            echo '<a href="'.$dept_link.'">Department Home</a>';
        }
        echo '</div>';
        echo '<div class="program-major-link">';
        foreach ($program_majors as $major){
            $maj_link = esc_url(get_permalink($major));
            // var_dump($department);
            // var_dump($dept_link);
            echo '<a href="'.$maj_link.'">Degree Requirements</a>';
        }
        echo '</div>';
        echo '<button class="program-more-button">More</button>';
        
        
        echo '</div>'; //end Program Footer
        echo '</div>';//end Program Row
        wp_reset_postdata();
        endwhile; endif;
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ucsc-underscore' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ucsc-underscore' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->