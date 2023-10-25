<?php
/* Template Name: General Template */
?>

<?php
get_header();
?>

<main class="page-main">
  <section class="service-page-container">
	<div class="row">
	  <div class="col-md-8 main-content-area">
		<div class="service-featured-image">
		  <img alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" src="<?php echo the_post_thumbnail_url(); ?>" />

		  <!-- Flexible Contents -->
		  <?php
		    // Check value exists.
		    if (have_rows('service_fixed_layout')) :

			    // Loop through rows.
				while (have_rows('service_fixed_layout')) :
the_row();

    			// Simple Paragraph
                if (get_row_layout() == 'paragraphs') : 
				?>

				<div class="service-simple-paragraph" style="margin-top: 0px;">
						<?php the_sub_field('content'); ?>
				</div>
				
				<?php
				// Catalog
                elseif (get_row_layout() == 'catalog') : 
				?>

				<div class="service-card-container catalog-section">
				    <div class="row d-flex justify-content-center">
					    <?php if ( get_sub_field( 'catalog_main_heading' ) ) : ?>
					        <h2 class="catalog-main-header"><?php the_sub_field('catalog_main_heading'); ?></h2>
					    <?php endif; ?>
					    
					    <?php if ( get_sub_field( 'catalog_main_image' ) ) : ?>
					        <figure class="catalog-main-image"><img src="<?php the_sub_field('catalog_main_image'); ?>" /></figure>
					    <?php endif; ?>
					    
					    <?php if ( get_sub_field( 'catalog_main_content' ) ) : ?>
					        <div class="description"><?php the_sub_field('catalog_main_content'); ?></div>
					    <?php endif; ?>
				    </div>
				    
				    <div class="row">
                        <div class="col-md-6">
				        <?php
                        foreach (get_sub_field('catalog_column_item') as $column_item ) :
                            //vdd(get_sub_field('catalog_column_item_details'));
    				            if ( isset( $column_item['$column_item'] ) ) : ?>
    					            <h2 class="catalog-sub-item-header"><?php echo esc_html( $column_item['$column_item'] ) ?></h2>
    					        <?php endif;
    						
                                foreach ( $column_item['catalog_column_item_details'] as $column_item_detail ) :
            						    ?>
            						    <div class="row" >
            						        <div class="col">
            						            <div class="title-file d-flex">
                						            <?php if ( isset( $column_item_detail['catalog_column_item_title'] ) ) : ?>
                            					        <h2 class="catalog-inner-header"><?php echo esc_html( $column_item_detail['catalog_column_item_title'] ); ?></h2>
                            					    <?php endif; ?>
                            					    -
                            					    <?php if ( isset( $column_item_detail['catalog_column_item_file'] ) ) : ?>
                            					        <a href="<?php echo esc_url( $column_item_detail['catalog_column_item_file'] ); ?>">PDF</a>
                            					    <?php endif; ?>
                        					    </div>
                        					    
                        					    <?php if ( isset( $column_item_detail['catalog_column_item_image'] ) ) : ?>
                        					        <figure class="catalog-main-image"><img src="<?php echo esc_url( $column_item_detail['catalog_column_item_image'] ); ?>" /></figure>
                        					    <?php endif; ?>
            						        </div>
            						    </div>
                					    <?php
                				endforeach;
    					    endforeach;
                        ?>
                        </div>
					</div>
				</div>

                <?php
                 // Service Grid
                elseif (get_row_layout() == 'service_grids') : 
                	?>

				<div class="service-card-container">
				  <div class="row">
						<?php
						if (have_rows('service_grid')) :
							while (have_rows('service_grid')) :
the_row();
								?>
						<div class="col-md-6">
						  <div class="service-card">
							<div class="service-card-icon">
							  <div class="service-card-icon-wrapper">
								<?php the_sub_field('icon'); ?>
							  </div>
							</div>
							<div class="service-card-content">
							  <h2 class="service-card-content-title"><?php the_sub_field('title'); ?></h2>
							  <div class="service-card-content-desc">
								<?php the_sub_field('description'); ?>
							  </div>
							</div>
						  </div>
						</div>
					  <?php
						  endwhile;
						endif;
						?>
				  </div>
				</div>

				  <?php
				  // Accordion List
				  elseif (get_row_layout() == 'accordion') : 
						?>

				<div class="service-accordion">
				  <div class="accordion" id="accordionExample">

						<?php
						$arr = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'];
						$i   = 0;
						if (have_rows('accordion_list_item')) :
							while (have_rows('accordion_list_item')) :
the_row();
								?>
						<div class="accordion-item">
						  <h2 class="accordion-header" id="heading<?php echo $arr[$i]; ?>">
							<?php if ($i === 0) { ?>
							  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $arr[$i]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $arr[$i]; ?>">
							  <?php } else { ?>
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $arr[$i]; ?>" aria-expanded="false" aria-controls="collapse<?php echo $arr[$i]; ?>">
								<?php } ?>
								<?php the_sub_field('accordion_title'); ?>
								</button>
						  </h2>
							<?php if ($i === 0) { ?>
							<div id="collapse<?php echo $arr[$i]; ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo $arr[$i]; ?>" data-bs-parent="#accordionExample">
							<?php } else { ?>
							  <div id="collapse<?php echo $arr[$i]; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $arr[$i]; ?>" data-bs-parent="#accordionExample">
							  <?php } ?>
							  <div class="accordion-body">
								<?php the_sub_field('accordion_description'); ?>
							  </div>
							  </div>
							</div>
						  <?php
								$i++;
						  endwhile;
						endif;
						?>
				  </div>
				</div>

				  <?php
				  // Left Image Right Content
				  elseif (get_row_layout() == 'left_image_right_content') : 
						?>

				<div class="service-two-column">
				  <div class="row">
					<div class="col-md-6">
						<?php
						$l_image = get_sub_field('image');
						?>
					  <img src="<?php echo esc_url($l_image['url']); ?>" alt="<?php echo esc_html($l_image['alt']); ?>" />
					</div>
					<div class="col-md-6">
						<?php the_sub_field('content'); ?>
					</div>
				  </div>
				</div>

				  <?php
				  // Right Image Left Content
				  elseif (get_row_layout() == 'right_image_left_content') : 
						?>

				<div class="service-two-column">
				  <div class="row">
					<div class="col-md-6">
						<?php the_sub_field('content'); ?>
					</div>
					<div class="col-md-6">
						<?php
						$l_image = get_sub_field('image');
						?>
					  <img src="<?php echo esc_url($l_image['url']); ?>" alt="<?php echo esc_html($l_image['alt']); ?>" />
					</div>
				  </div>
				</div>

			  <?php
				  endif;

			  endwhile;

		  else :
		  // Do something...
		  endif;
			?>
		</div>
	  </div>
	  <div class="col-md-4 aside-content-area">
		<?php if (is_active_sidebar('general_sidebar')) : ?>
		  <?php dynamic_sidebar('general_sidebar'); ?>
		<?php endif; ?>
	  </div>
	</div>
  </section>
</main>

<?php
get_footer();
?>
