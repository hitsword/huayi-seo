<?php
/*
Plugin Name: HuaYi WordPress SEO
Plugin URI: http://www.huayizhiyun.com
Description: WordPress SEO优化插件.
Version: 1.0
Author: 华怡智云
Author URI: http://www.huayizhiyun.com
License: GPL
Copyright: 华怡智云
*/

/* 定义常量 */
define('HUAYI_WPSEO_URL',plugin_dir_url(__FILE__));//定义插件目录常量

/* 加载基本文件 */
require_once('lib/init.php');//调用初始化文件
//require_once('lib/function.php');//调用公共函数文件

if (!function_exists( 'huayi_seo' )) {
  remove_action( 'wp_head', '_wp_render_title_tag', 1 );
  function huayi_seo(){
    include_once ('lib/function.php');
  }
  add_action('wp_head','huayi_seo',1);
}