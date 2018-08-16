
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">List of playlists by client</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">List of playlists by client</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "playlist_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Contract client name</td><td><?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "playlist_client_id")) ?></td></tr>
                <tr><td>Delivery month</td><td><?php echo Form::select("deliverymonth_id", $arr_delivery_month,  HTML::replace_empty_array_value($post, "deliverymonth_id"),array("id" => "playlist_deliverymonth_id")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "playlist_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins_seltmpl") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "playlist_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Playlist name</th>
              <th scope="col" class="th_width_middle">Delivery time zone</th>
              <th scope="col" class="th_width_long">Delivery period</th>
              <th scope="col" class="th_width_long">Contract client</th>
              <?php if(Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_UP) || Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_playlist as $playlist): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "playlist_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "timezone_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($playlist, "sta_dt"),0,10) )); ?> ～
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($playlist, "end_dt"),0,10) )); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "client_name"))); ?></td>

              <?php if(Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_UP) || Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_DEL)): ?>
              <td class="td_button_center">
                <div>
                <?php if(Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up_seltmpl") ?>
                  <?php echo Form::hidden("playlist_id", $playlist->playlist_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "playlist_up" . $playlist->playlist_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                </div>
                <?php if(Auth::auth_check(MODULE_NAME_PLAYLIST, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("playlist_id", $playlist->playlist_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "playlist_del_" . $playlist->playlist_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                </div>
               </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
