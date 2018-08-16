
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Common playlist list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Common playlist list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "commonplaylist_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Playlist name</td><td><?php echo Form::select("playlist_id", $arr_all_playlist, HTML::replace_empty_array_value($post, "playlist_id"), array("id" => "commonplaylist_playlist_id", "maxlength" => "60", "class" => "input350")) ?></td></tr>
                <tr><td>sex</td><td><?php echo Form::select("sex_id", $arr_sex,  HTML::replace_empty_array_value($post, "sex_id"),array("id" => "commonplaylist_sex_id")) ?></td></tr>
                <tr><td>Delivery time zone</td><td><?php echo Form::select("timezone_id", $arr_time_zone,  HTML::replace_empty_array_value($post, "timezone_id"),array("id" => "commonplaylist_timezone_id")) ?></td></tr>
                <tr><td>Delivery month</td><td><?php echo Form::select("deliverymonth_id", $arr_delivery_month,  HTML::replace_empty_array_value($post, "deliverymonth_id"),array("id" => "commonplaylist_deliverymonth_id")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "commonplaylist_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins_seltmpl") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "commonplaylist_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Playlist name</th>
              <th scope="col" class="th_width_short">sex</th>
              <th scope="col" class="th_width_middle">Delivery time zone</th>
              <th scope="col" class="th_width_middle">Distribution type</th>
              <th scope="col" class="th_width_long">Delivery period</th>
              <!-- <th scope="col" class="th_width_long">Contract client</th> -->
              <?php if(Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_playlist as $playlist): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "playlist_name"))); ?></td>
              <td class="td_text_center"><?php if($playlist->sex_id === 1): ?>woman<?php else: ?>Man<?php endif ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "timezone_name"))); ?></td>
              <td class="td_text_center">weekly</td>
              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($playlist, "sta_dt"),0,10) )); ?> ～
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($playlist, "end_dt"),0,10) )); ?></td>
              <!-- <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "client_name"))); ?></td> -->

              <?php if(Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_DEL)): ?>
              <td class="td_button_center">
                <div>
                <?php if(Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up_seltmpl") ?>
                  <?php echo Form::hidden("playlist_id", $playlist->playlist_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "commonplaylist_up_seltmpl" . $playlist->playlist_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                </div><div style="margin-top:2px">
                <?php if(Auth::auth_check(MODULE_NAME_COMMONPLAYLIST, ACTION_DEL)): ?>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "del") ?>
                    <?php echo Form::hidden("playlist_id", $playlist->playlist_id) ?>
                    <?php echo Form::submit(NULL, "Delete", array("id" => "commonplaylist_del_" . $playlist->playlist_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
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
