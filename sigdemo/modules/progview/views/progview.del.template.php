    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Program guide setting 【Program guide (date designation) deletion】</div>
          <div class="menu_link"><?  echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "progview_del_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Program guide (date designation) deletion</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "del") ?>
          <?php echo Form::hidden("act", "del") ?>
          <?php echo Form::hidden("prog_id", $prog_id) ?>

          <div class="text_02">Program guide (date designation) deletion</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th scope="row" width="20%">Device name</th>
                <td><?php echo(Kohana_HTML::entities($prog->dev_name)); ?></td>
              </tr>
              <tr>
                <th scope="row" width="20%">ant's classification</th>
                <td><?php echo(Kohana_HTML::entities($arr_all_ants_version[$prog->ants_version])); ?></td>
              </tr>
              <tr>
                <th scope="row" width="20%">Distribution start date and time</th>
                <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($prog->sta_dt))); ?></td>
              </tr>
              <tr>
              <th scope="row" width="20%">Delivery end date and time</th>
                <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($prog->end_dt))); ?></td>
              </tr>
              <?php if(!empty($prog->arr_playlist)): ?>
                <?php foreach($prog->arr_playlist as $i => $playlist): ?>
                  <tr>
                    <th scope="row" width="20%">Playlist name</th>
                    <td><?php echo(Kohana_HTML::entities($playlist->playlist_name)) ?></td>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>
            </table>
          </div>
          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo(HTML::anchor($url, "Return", array("id" => "progview_del_back", "class" => "btn1 btn_l"), null, false))?>
            <?php echo Form::button(NULL, "Delete", array("id" => "progview_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
          <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main --> 
