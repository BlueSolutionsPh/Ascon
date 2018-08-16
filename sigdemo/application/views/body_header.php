
<!-- #header -->
<div id="header">
  <div id="headertop">
    <div id="headertop_inner" class="clearfix">
      <h1>
        アスコンサイネージ
        <?php if(Session::get_target_client_name() !== false): ?>
        　<?php echo("Operation target client:" . Session::get_target_client_name()); ?>
        <?php endif ?>
      </h1>
      <?php if(Auth::instance()->logged_in()): ?>
        <div id="header_state"><?php echo HTML::anchor("/" . MODULE_NAME_LOGIN . "/logout", "Logout", array("id" => "body_header_logout"), null, false) ?></div>
      <?php endif ?>
    </div>
  </div>
  <div id="header_inner" class="clearfix">
    <div id="site_title">
      <?php if(file_exists(DOCROOT.'/images/common/title_header.png')) { ?>
      <a href="menu"><img src="<?php echo URL::site('images/common').'/title_header.png';?>"/></a>
      <?php }else{ ?>
      Ascon signage
      <?php } ?>
    </div>
    <div id="logo_header"></div>
  </div>
  <?php if(Auth::instance()->logged_in()): ?>
    <div id="header_menu">
      <div id="header_menu_inner">
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_USER, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "menu",  array("id" => "body_header_menu"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_USER, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_USER, "Administrator",  array("id" => "body_header_user"), null, false) ?></span>
        <?php endif ?>
        <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_CLIENT, "Contract client",  array("id" => "body_header_client"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_SHOP, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_SHOP, "Facility",  array("id" => "body_header_shop"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_SHOP, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_BOOTH, "booth",  array("id" => "body_header_booth"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_DEV, "Terminal",  array("id" => "body_header_dev"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_MOVIE, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_MOVIE, "Movie", array("id" => "body_header_movie"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, "Common playlist", array("id" => "body_header_commonplaylist"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_PLAYLIST, "playlist", array("id" => "body_header_playlist"), null, false) ?></span>
        <?php endif ?>
        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVPROG, ACTION_SEL)): ?>
          <span><?php echo HTML::anchor("/" . MODULE_NAME_PROG, "A TV schedule",  array("id" => "body_header_prog"), null, false) ?></span>
        <?php endif ?>
      </div>
    </div>
  <?php endif ?>
</div>
<!-- /#header -->
