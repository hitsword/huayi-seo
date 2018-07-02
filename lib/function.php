<?php if ( is_home()||is_front_page() ) { ?><title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) { echo '-第'; echo get_query_var('page'); echo '页';}?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page()&&!is_front_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category()||is_tax() ) { ?><title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_year() ) { ?><title><?php the_time('Y年'); ?>所有内容 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?>份所有内容 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_day() ) { ?><title><?php the_time('Y年n月j日'); ?>所有内容 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title><?php } ?><?php } ?>
<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() ){
  global $post;
  if ($post->post_excerpt) {
    $description  = $post->post_excerpt;
  } else {
    if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
      $post_content = $result['1'];
    } else {
      $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
      $post_content = $post_content_r['0'];
    }
    $description = utf8Substr($post_content,0,220);
  } 
  $keywords = "";
  $tags = wp_get_post_tags($post->ID);
  foreach ($tags as $tag ) {
    $keywords = $keywords . $tag->name . ",";
  }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_page()&&!is_front_page() ) { ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="<?php echo trim(wp_title('',0)); ?>,<?php bloginfo('name'); ?>" />
<?php } ?>
<?php if ( is_category()||is_tax() ) { ?>
<meta name="description" content="<?php echo strip_tags(category_description()); ?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo single_tag_title(); ?>" />
<?php } ?>
<?php if ( is_home()||is_front_page() ) { ?>
<meta name="keywords" content="<?php echo get_option('huayi_seo_keywords') ? get_option('huayi_seo_keywords') : bloginfo('name'); ?>" />
<meta name="description" content="<?php echo get_option('huayi_seo_description') ? get_option('huayi_seo_description') : bloginfo('description'); ?>" />
<?php } ?>