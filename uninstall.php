<?php
/**
 * uninstalling huayi wordpress seo
 */
if(! defined('WP_UNINSTALL_PLUGIN'))exit(); // 如果 uninstall 不是从 WordPress 调用，则退出
/* 删除 wp_options 表中的对应记录 */ 
delete_option('huayi_keywords'); 
delete_option('huayi_description');