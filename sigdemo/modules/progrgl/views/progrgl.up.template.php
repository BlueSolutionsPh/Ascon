
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Program guide setting [Program list (repeated designation) update]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "progrgl_up_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Program guide (repeated designation) update</h3>
        <div class="content">
          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf", array("id" => "act")) ?>
          <?php echo Form::hidden("ants_version", $post["ants_version"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Device name</dt>
                <dd>
                  <?php echo Form::label("dev_name", $post["dev_name"]) ?>
                </dd>
                <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
                  <dt>ant's classification</dt>
                  <dd>
                    <?php echo Form::label("ants_version", $arr_all_ants_version[$post["ants_version"]]) ?>
                  </dd>
                <?php endif ?>
              </dl>
            </div>

            <div class="hr_wrapper_01">
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <th id="<?php echo("th_dow[" . $i . "]")?>" scope="col">
                    By day of the week<?php echo($i + 1)?><br />
                    <?php echo Form::radio_progrgl_up($post, $i, "mon") ?>Month
                    <?php echo Form::radio_progrgl_up($post, $i, "tues") ?>fire
                    <?php echo Form::radio_progrgl_up($post, $i, "wednes") ?>water
                    <?php echo Form::radio_progrgl_up($post, $i, "thurs") ?>wood
                    <?php echo Form::radio_progrgl_up($post, $i, "fri") ?>Money
                    <?php echo Form::radio_progrgl_up($post, $i, "satur") ?>Soil
                    <?php echo Form::radio_progrgl_up($post, $i, "sun") ?>Day
                  </th>
                <?php endfor ?>
              </tr>
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <td style="text-align:center;">
                    Base all day<br />
                    <?php echo Form::select("base[" . $i . "]", $arr_all_playlist, $post["base"][$i], array("id" => "progrgl_up_base_" . $i)) ?>
                  </td>
                <?php endfor ?>
              </tr>

              <?php for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++):?>
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <td style="text-align:center;">
                  <?php echo Form::select("sta_time_h[" . $i . "][" . $j . "]", $time["time_h"], HTML::replace_empty_array_value($post, array("sta_time_h", $i, $j)), array("id" => "progrgl_up_sta_time_h_" . $i . "_" . $j)) ?>：<?php echo Form::select("sta_time_m[" . $i . "][" . $j . "]", $time["time_m"], HTML::replace_empty_array_value($post, array("sta_time_m", $i, $j)), array("id" => "progrgl_up_sta_time_m_" . $i . "_" . $j)) ?>～<?php echo Form::select("end_time_h[" . $i . "][" . $j . "]", $time["time_h"], HTML::replace_empty_array_value($post, array("end_time_h", $i, $j)), array("id" => "progrgl_up_end_time_h_" . $i . "_" . $j)) ?>：<?php echo Form::select("end_time_m[" . $i . "][" . $j . "]", $time["time_m"], HTML::replace_empty_array_value($post, array("end_time_m", $i, $j)), array("id" => "progrgl_up_end_time_m_" . $i . "_" . $j)) ?>
                  <?php echo Form::select("playlist[" . $i . "][" . $j . "]", $arr_all_playlist, $post["playlist"][$i][$j], array("id" => "progrgl_up_playlist_" . $i . "_" . $j)) ?><br />
                  </td>
                <?php endfor; ?>
              </tr>
              <?php endfor; ?>

            </table>
            </div>

            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_DEVPROG, "Return", array("id" => "progrgl_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Update", array("id" => "progrgl_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
