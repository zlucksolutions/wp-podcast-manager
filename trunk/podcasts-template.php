<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
  </header><!-- .entry-header -->

  <div class="entry-excerpt">
    <?php the_excerpt(); ?>

    <!-- THIS IS WHERE THE FUN PART GOES -->

  </div><!-- .entry-excerpt -->
  <div class="post_info">
    <span itemprop="dateCreated" class="entry_date"><?php the_date(); ?></span>
  </div>

</article><!-- #post-## -->