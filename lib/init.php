<?php
/* 注册激活插件时要调用的函数 */ 
  register_activation_hook( __FILE__, 'huayi_wpseo_install');   
  /* 在数据库的 wp_options 表中添加一条记录，第二个参数为默认值 */ 
  function huayi_wpseo_install() {
    add_option('huayi_seo_keywords', '', '', 'yes');//首页关键词
    add_option('huayi_seo_description', '', '', 'yes');//首页描述
  }

/* 注册停用插件时要调用的函数 */ 
  //register_deactivation_hook( __FILE__, 'huayi_wpseo_remove' );  
  /* 删除 wp_options 表中的对应记录 */ 
  function huayi_wpseo_remove() {
    delete_option('huayi_seo_keywords');
    delete_option('huayi_seo_description');
  }

  if( is_admin() ) {
    /*  利用 admin_menu 钩子，添加菜单 */
    add_action('admin_menu', 'huayi_wpseo_menu');
  }

  function huayi_wpseo_menu() {
    /* add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);  */
    /* 页名称，菜单名称，访问级别，菜单别名，点击该菜单时的回调函数（用以显示设置页面） */
    add_menu_page('WordPress SEO', 'WPSEO', 'administrator','huayi_wpseo', 'huayi_wpseo_html_page');
  }

  function huayi_wpseo_html_page() {
    ?>
      <div class="wrap">
        <h2>WordPress SEO</h2>
        <form method="post" action="options.php" novalidate="novalidate">
          <!-- 下面这行代码用来保存表单中内容到数据库 -->  
          <?php wp_nonce_field('update-options'); ?>  
          <input type="hidden" name="page_options" value="huayi_seo_keywords,huayi_seo_description" />
          <input type="hidden" name="action" value="update" />
          <p>WordPress SEO设置</p>
          <table class="form-table">
            <tr>
              <th scope="row"><label for="huayi_seo_keywords" ><?php _e('首页关键词') ?></label></th>
              <td><input name="huayi_seo_keywords" type="text" id="huayi_seo_keywords" value="<?php form_option('huayi_seo_keywords'); ?>" class="regular-text" />
              <p class="description" id="keywords-description"><?php _e( '自定义首页关键词.' ) ?></p></td>
            </tr>
            <tr>
              <th scope="row"><label for="huayi_seo_description" ><?php _e('首页描述') ?></label></th>
              <td>
                <textarea name="huayi_seo_description" rows="10" cols="50" id="huayi_seo_description" class="regular-text code"><?php form_option('huayi_seo_description'); ?></textarea>
                <p class="description" id="description-description">自定义首页描述</p>
              </td>
            </tr>
          </table>
          <?php submit_button(); ?>
        </form>
      </div>
    <?php  
  }