<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UC_Santa_Cruz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php
        get_template_part( 'template-parts/breadcrumbs', 'all' );
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				ucsc_underscore_posted_on();
                ucsc_underscore_posted_by();

				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php ucsc_underscore_post_thumbnail(); ?>

	<div class="entry-content">
		<?php

        $degrees_offered = get_field_object('degrees_offered');
        $degrees = $degrees_offered['value'];
        // var_dump($degrees);
        if ($degrees !=''){
            echo '<div id="major-tabs" class="major-tabs">';
            echo '<ul role="tablist">';
            echo '<li id="overview-tab"  role="presentation"><a href="#" class="tab-link" data-rel="overview"role="tab">Overview</a></li>';
            if(in_array('ba', $degrees) || in_array('bs', $degrees)){
                echo '<li id="ba-tab"  role="presentation"><a href="#" class="tab-link" data-rel="ba" role="tab">Bachelor\'s</a></li>';
            }
            if(in_array('ma', $degrees) || in_array('ms', $degrees)):
                echo '<li id="ma-tab"  role="presentation"><a href="#" class="tab-link" data-rel="ma" role="tab">Master\'s</a></li>';
            endif;
            if(in_array('phd', $degrees)):
                echo '<li id="phd-tab"  role="presentation"><a href="#" class="tab-link" data-rel="phd" role="tab">Doctoral</a></li>';
            endif;
            if(in_array('undergradminor', $degrees) || in_array('gradminor', $degrees)):
                echo '<li id="minor-tab"  role="presentation"><a href="#" class="tab-link" data-rel="minor" role="tab">Minor</a></li>';
            endif;
            if(in_array('c', $degrees)):
                echo '<li id="courses-tab"  role="presentation"><a href="#" class="tab-link" data-rel="courses" role="tab">Courses</a></li>';
            endif;
              echo '</ul>';
              echo '</div>';
              echo '<div style="clear:both"></div>';

              echo '<div class="majorcontainers">';
              echo '<div id="overview" class="tab-content">'.get_field('overview').'</div>';
              if(in_array('ba', $degrees) || in_array('bs', $degrees)) {
                echo '<div id="ba" class="tab-content">'.get_field('bachelor_degree').'</div>';
               }
            if(in_array('ma', $degrees) || in_array('ms', $degrees)) {
                echo '<div id="ma" class="tab-content">'.get_field('master_degree').'</div>';
                }
            if (in_array("phd", $degrees)) {
                echo '<div id="phd" class="tab-content">'.get_field('doctoral_degree').'</div>';
                }
            if(in_array('undergradminor', $degrees) || in_array('gradminor', $degrees)){
                echo '<div id="minor" class="tab-content">'.get_field('minor').'</div>';
                }
            // if (in_array("faculty", $major_tabs)) {
            //     echo '<div id="faculty" class="tab-content">'.get_field('faculty').'</div>';
            //     }
            if (in_array("c", $degrees)) {
                echo '<div id="courses" class="tab-content">'.get_field('courses').'</div>';
                }
            echo '</div>';
            }

        /**
         *
         * Lots of coding here. Loop to retrieve repeatable
         * fields. Don't want to lose it.
         */
        // $major_components = get_post_meta( get_the_ID(), '_ucsc_major_components_group', true );
        // echo '<div><ul>';
        // foreach ((array) $major_components as $key => $entry){
        //     $component = $content = '';

        //     if (isset($entry['major_component_checkbox'])){
        //         $component = esc_html($entry['major_component_checkbox']);
        //     }

        //     if (isset($entry['major_component_text'])){
        //         $content = wpautop($entry['major_component_text']);
        //         // $content = esc_html($entry['major_component_wysiwyg']);
        //     }

        //     echo '<li>';
        //     echo '<span>'.$component.'</span>';
        //     echo '<span>'.$content.'</span>';
        //     echo '</li>';

        // }
        // echo '</ul></div>';

        /**
         * BEGINNING OF ORIGINAL UNDERSCORES CODE
         */
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ucsc-underscore' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ucsc-underscore' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ucsc_underscore_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
