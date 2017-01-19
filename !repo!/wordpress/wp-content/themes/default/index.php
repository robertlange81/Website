<?php include ('wp-blog-header.php'); ?>
<html>
<head>
<link rel="stylesheet" href="sreen_light.css" type="text/css" media="screen" />
</head>
<body>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
<div class="meta"><?php _e("einsortiert unter:"); ?> <?php the_category(',') ?>
<?php the_time() ?>
<?php edit_post_link(__('edit')); ?>
</div>

<div class="storycontent">
<?php the_content(__('(weiterlesen...)')); ?>
</div>

<div class="feedback">
<?php wp_link_pages(); ?>
<?php comments_popup_link(__('0 Kommentare'), __('1 Kommentar'), __('% Kommentare')); ?>
</div>

</div>

<?php comments_template(); ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, nichts gefunden.'); ?></p>
<?php endif; ?>
</body>
</html>