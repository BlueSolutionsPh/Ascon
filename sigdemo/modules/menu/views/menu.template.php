
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">menu</div></div>
      </div>
    </div>

    <div id="main">
<?php if(Session::get_target_client_id() === false && Session::is_admin()): ?>
        <div id="msg">
          <h3 class="title">Confirmation</h3>
          <div class="content"><div style="color:#00F;">Please select the operation target client</div></div>
        </div>
<?php endif ?>
      <?php echo View::get_action_msg($arr_action_result) ?>
      <?php echo $irregular_msg ?>
        <div id="main_contents_top">
<?php if(
          (Auth::auth_check(MODULE_NAME_CLIENT, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_USER, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL))
): ?>
          <div class="top_box top_menu">
            <div class="title type01">
              <div class="title_img"><img src="./img/top_img01.png"></div>
              <div class="title_text"><h3>system management</h3></div>
            </div>
            <ul>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_USER, ACTION_SEL)): ?>
              <li><a href="user">Administrator settings</a></li>
<?php endif ?>
<!--
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL)): ?>
              <li><a href="dev">死活監視</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL)): ?>
              <li><a href="dev">ログ履歴</a></li>
<?php endif ?>
-->
            </ul>
          </div>
<?php endif ?>
<?php if(
          (Auth::auth_check(MODULE_NAME_CLIENT, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_SHOP, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_BOOTH, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL))
): ?>
          <div class="top_box top_menu">
            <div class="title type02">
              <div class="title_img"><img src="./img/top_img02.png"></div>
              <div class="title_text"><h3>Location</h3></div>
            </div>
            <ul>
<?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_SEL)): ?>
              <li><a id="menu_client" href="client">Contract client</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_SHOP, ACTION_SEL)): ?>
              <li><a id="menu_shop" href="shop">Facility</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_BOOTH, ACTION_SEL)): ?>
              <li><a id="menu_booth" href="booth">booth</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEV, ACTION_SEL)): ?>
              <li><a id="menu_dev" href="dev">Terminal</a></li>
<?php endif ?>
            </ul>
          </div>
<?php endif ?>
<?php if(
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_MOVIE, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVPROG, ACTION_SEL))
): ?>
          <div class="top_box top_menu">
            <div class="title type03">
              <div class="title_img"><img src="./img/top_img03.png"></div>
              <div class="title_text"><h3>Image</h3></div>
            </div>
            <ul>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_MOVIE, ACTION_SEL)): ?>
              <li><a id="menu_movie" href="movie">Video</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_SEL)): ?>
              <li><a id="menu_commonplaylist" href="commonplaylist">Common playlist</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_SEL)): ?>
              <li><a id="menu_playlist" href="playlist">playlist</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVPROG, ACTION_SEL)): ?>
              <li><a id="menu_prog" href="prog">Program guide management</a></li>
<?php endif ?>
            </ul>
          </div>
<?php endif ?>
<?php if(
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_SHOP, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_CLIENT, ACTION_SEL)) ||
          (Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_TIMEZONE, ACTION_UP))
): ?>
          <div class="top_box top_menu">
            <div class="title type04">
              <div class="title_img"><img src="./img/top_img03.png"></div>
              <div class="title_text"><h3>Master</h3></div>
            </div>
            <ul>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_SEL)): ?>
              <li><a id="menu_authgrp" href="authgrp">Administrator type</a></li>
<?php endif ?>
<?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_TIMEZONE, ACTION_UP)): ?>
              <li><a id="menu_timezone" href="timezone">Delivery time type</a></li>
<?php endif ?>
            </ul>
          </div>
<?php endif ?>
        <div class="clear"></div>
      </div>
    </div>
    <!-- #/main -->
