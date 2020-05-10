<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nextstrap
 */

get_header();


div class="container pt-4"> <!--Cabeza de entrada-->
		<div class="row no-gutters"> <!--Información de la entrada-->
				<div class="col"></div>
				<div class="col-md-8 col-12">
					<div class="row pt-1 no-gutters"> <!--Categoría-->
						<div class="col-12 d-flex">
						</div>
					</div>
					<h1 class="titulo-post"><?php the_title(); ?></h1>
				</div>
				<div class="col"></div>
		</div>
		<div class="row no-gutters align-items-center"> <!--Botones para compartir contenido en redes sociales-->
			<div class="col"></div>
			<div class="col-md-6 col-12 d-flex d-none d-md-block">
				<div class="row">
					<div class="col-auto pr-0">
						<h6 class="categoria texto-sm mb-0" style="line-height: 25px;"><?php the_category( ', ' ); ?> - </h6>
					</div>
					<div class="col pl-0">
						<p class="text-muted texto-sm mb-0 pl-2 work-sans"><?php echo get_the_date(); ?></p></div>
					</div>
				</div>
			<div class="col-md-2 col-12">
				<div class="row d-flex justify-content-end no-gutters">
					<?php wp_share_botones(); ?>
				</div>
			</div>
			<div class="col"></div>
		</div>
		<div class="row"> <!--Imagen destacada-->
			<div class="col"></div>
			<div class="col-md-10 col-12 p-0">
					<figure class="figure d-block mt-3">
						<?php //Caption query
						$get_description = get_post(get_post_thumbnail_id())->post_excerpt;
						the_post_thumbnail('full', array( 'class' => 'card-img-top d-block full' ));
						if (!empty($get_description)){//Si la descripción no está vacía, muestra el div
						echo '<figcaption class="text-center py-2">' . $get_description . '</figcaption>';
						echo '<hr>';
						}
						?>
					</figure>
			</div>
			<div class="col"></div>
		</div>
	</div>

	<div class="container"> <!--Container-->
		<div class="row"> <!--row-->
			<div class="col"></div>
			<div class="col-lg-8 col-10 post">
				<!--<resumen><//?php the_excerpt(); ?></resumen>-->
				<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="col"></div>
		</div> <!--row-->
		<div class="row py-5"> <!--row-->
			<div class="col"></div>
			<div class="col-md-8 col-12"> <!--Col-md-8-->
				<?php
					$tags = wp_get_post_tags($post->ID);
					$html = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
					foreach ( $tags as $tag ) {
						$tag_link = get_tag_link( $tag->term_id );
						$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug} p-2 mx-1 badge badge-light text-capitalize'>";
						$html .= "{$tag->name}</a>";
					}
					$html .= '</div>';
					echo $html;
				?>
				<div class="row d-flex justify-content-end pt-3">
					<?php wp_share_botones(); ?>
				</div>
			</div> <!--Col-md-8-->
			<div class="col"></div>

			</div>
		</div> <!--Row-->
	</div> <!--Container-->

	<!-- <div class="container"> Autorxs
		<div class="row pb-5">
			<div class="col"></div>
			<div class="col-lg-8 col-12">
			<hr class="pb-5">
				<div class="row">
					<div class="col-10">

					</div>
					<div class="col-2 align-self-center">
						<div class="row d-flex justify-content-center">

						</div>
					</div>
				</div>
			</div>
			<div class="col"></div>
		</div>
	</div> -->

		</div> <!--row-->
	</div> <!--Container-->


	<div class="bg-light"> <!--Relacionados-->
		<div class="container pb-5">
		<h1 class="cabecera text-uppercase pt-5 pb-3 texto-md">Contenido relacionado</h1>
			<div class="card-deck">

		<?php
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
		$first_tag = $tags[0]->term_id;

	  $args=array(
        'tag__in' => array($first_tag),
        'post__not_in' => array($post->ID),
        'posts_per_page'=>3,
        'ignore_sticky_posts'=>1,
     );


		$wp_relacionados = new WP_Query($args);
		if( $wp_relacionados->have_posts() ) {
		while ($wp_relacionados->have_posts()) : $wp_relacionados->the_post(); ?>

			   <a href="<?php the_permalink() ?>">
				    <div class="card col-12 col-md-4 mb-4 pt-3 bg-transparent">
						<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail('full', array( 'class' => 'card-img-top chica' ));
						} else { ?>
						<img src="https://gitlab.com/plumbago/pdp/raw/master/Captura%20de%20Pantalla%202019-12-09%20a%20la(s)%2021.54.40.png" class="card-img-top" alt="<?php the_title(); ?>" />
						<?php } ?>
          </a>
					<div class="card-body pl-0 pt-3">
						<h1 class="card-title ultimas text-center texto-md">
							<a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
						</h1>
					</div> <!--Card-body-->
				</div> <!--Card-->
			<?php endwhile; } wp_reset_query(); } ?>
			</div> <!--Card deck-->
		</div> <!--Container-->
    </div> <!--Relacionados-->



get_footer();
