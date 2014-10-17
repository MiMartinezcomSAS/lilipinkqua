<div id="google-container"></div>
<div id="cd-zoom-in"></div>
<div id="cd-zoom-out"></div>
<select id="select" name="">
    <option value='4.598056000000001,-74.07583299999999,bogota'  <?php if($_GET['ci'] == 'bogota'){echo('selected');} ?>>Bogotá</option>
    <option value='6.230833,-75.59055599999999,medellin' <?php if($_GET['ci'] == 'cali'){echo('medellin');} ?> >Medellín</option>
    <option value='3.420556,-76.522222,cali' <?php if($_GET['ci'] == 'cali'){echo('selected');} ?>>Cali</option>
</select>
<ul id="ciudades">
<?php
global $post;
$args = array('category_name' => 'mapaCiudades');
$wp_query = new WP_Query( $args );
while ($wp_query->have_posts()) : $wp_query->the_post();

        ?>
        <li id="<?php echo get_post_meta($post->ID, 'ciudad', true); ?>">

            <div class="tableMap">
                <?php the_content();?>

            </div>
        </li>

<?php endwhile ?>
</ul>
<input id="ciudadGetLa" type="hidden" value="<?php echo($_GET['la']) ?>"/>
<input id="ciudadGetLo" type="hidden" value="<?php echo($_GET['lo']) ?>"/>
<input id="ciudadGetCi" type="hidden" value="<?php echo($_GET['ci']) ?>"/>
