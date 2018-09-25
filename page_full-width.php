<?php
/* Template Name: Full-Width Template */
    get_header();
?>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="text-center text-uppercase text-white"><?php echo get_the_title(); ?></h2>
            <hr class="star-light mb-5">
            <div class="row">
                <?php
                    if (have_posts()):
                        while(have_posts()):
                            the_post();
                            the_content();
                        endwhile;
                    endif;
                ?>
                <div class="col-lg-12 ml-auto">
                    <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>