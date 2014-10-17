<div id="google-container"></div>
<div id="cd-zoom-in"></div>
<div id="cd-zoom-out"></div>
<select id="select" name="">
    <option value='4.598056000000001,-74.07583299999999'>Bogotá</option>
    <option value='6.230833,-75.59055599999999'>Medellín</option>
    <option value='3.420556,-76.522222'>Calí</option>
</select>
<ul id="ciudades">
<?php
$args = array('category_name' => 'mapaCiudades');
$wp_query = new WP_Query( $args );
while ($wp_query->have_posts()) : $wp_query->the_post();

        ?>
        <li>
            <div class="inline back-blue <?php echo get_post_meta($post->ID, 'color', true); ?>">

                <h4><?php the_title(); ?></h4>
            </div>
            <div class="inline back-blue <?php echo get_post_meta($post->ID, 'color', true); ?>">
                <?php the_content(); ?>
            </div>

        </li>

<?php endwhile ?>
</ul>