
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Program guide setting [Program guide (repeated designation) registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "progrgl_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Program guide (repeated designation) registration</h3>
        <div class="content">
          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>
          <?php echo Form::select("arr_dev[]", null, null, array("id" => "progrgl_ins_arr_dev", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::hidden("prog_name", time()) ?>

            <div class="hr_wrapper_01">
              <div class="progleft">
                <dl class="dl_input_02">
                  <dt>Select terminal <span id="dev_count" style="margin-left: 10px;"></span></dt>
                  <dd>
                  <?php echo Form::select("tmp_arr_dev[]", $arr_sel_dev, null, array("id" => "progrgl_ins_tmp_arr_dev", "multiple" => "multiple", "style" => "width:100%;height:255px;")) ?>
                  </dd>
                </dl>
              </div>

              <div class="progright">
                <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                  <tbody>
                    <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
                      <tr class="even">
                      <td>ant's type </td>
                      <td><?php
                        $playlist_info = json_encode($post["playlist_ants_version"]);
                        echo Form::select("ants_version", $arr_all_ants_version, HTML::replace_empty_array_value($post, "ants_version"),
                      	array("id" => "dev_ins_ants_version", "required" => "true", "onchange" => "func_reset('false','',". MAX_PROGRGL_PLAYLIST . ",". MAX_PROGRGL_DOW . ",". $playlist_info. ")")) ?>
                        <span class="popup_help" data-message="※ When terminal is selected, ant's type can not be changed.">[?]</span>
                      </td></tr>
                    <?php else: ?>
                      <tr class="even">
                      <td style="display: none;">ant's classification</td>
                      <td style="display: none;"><?php echo Form::select("ants_version", $arr_all_ants_version, ANTS_TWO_KIND, array("id" => "dev_ins_ants_version", "required" => "true")) ?></td></tr>
                    <?php endif ?>
                    <tr class="even">
                      <td>Store name search</td>
                      <td><?php echo Form::input("shop_name", HTML::replace_empty_array_value($post, "shop_name"), array("id" => "progrgl_ins_shop_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal name search</td>
                      <td><?php echo Form::input("dev_name", HTML::replace_empty_array_value($post, "dev_name"), array("id" => "progrgl_ins_dev_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal Remarks Search</td>
                      <td><?php echo Form::input("note", HTML::replace_empty_array_value($post, "note"), array("id" => "progrgl_ins_note", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal tag search</td>
                      <td>
                        <?php echo Form::select("dev_tag", $arr_all_tag, HTML::replace_empty_array_value($post, "dev_tag"), array("id" => "progrgl_ins_dev_tag")) ?>
                        <?php echo Form::button("search", "Search", array("id" => "progrgl_ins_search", "type" => "button", "onclick" => "func_search()")) ?>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <dl class="dl_input_02" style="margin-left:5px;margin-top:5px;">
                  <dt>Terminal</dt>
                  <dd>
                    <?php echo Form::select("arr_search_dev[]", $arr_all_dev, null, array("id" => "progrgl_ins_arr_search_dev", "multiple" => "multiple", "style" => "width:100%;height:130px;")) ?>
                  </dd>
                </dl>
              </div>
              <div class="clear"></div>
              <div style="text-align:center;">
                <?php echo Form::button("del", "Delete →", array("id" => "progrgl_ins_del", "type" => "button", "onclick" => "func_del()")) ?>
                <?php echo Form::button("add", "← add to", array("id" => "progrgl_ins_ins", "type" => "button", "onclick" => "func_add()")) ?>
              </div>
            </div>
            <div class="hr_wrapper_01">
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <th id="<?php echo("th_dow[" . $i . "]")?>" scope="col">
                    By day of the week<?php echo($i + 1)?><br />
                    <?php echo Form::radio_progrgl_ins($post, $i, "mon") ?>Month
                    <?php echo Form::radio_progrgl_ins($post, $i, "tues") ?>fire
                    <?php echo Form::radio_progrgl_ins($post, $i, "wednes") ?>water
                    <?php echo Form::radio_progrgl_ins($post, $i, "thurs") ?>wood
                    <?php echo Form::radio_progrgl_ins($post, $i, "fri") ?>Money
                    <?php echo Form::radio_progrgl_ins($post, $i, "satur") ?>soil
                    <?php echo Form::radio_progrgl_ins($post, $i, "sun") ?>Day
                  </th>
                <?php endfor ?>
              </tr>
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                <td style="text-align:center;">
                  Base all day<br />
                  <?php echo Form::select("base[" . $i . "]", $arr_all_playlist, $post["base"][$i], array("id" => "progrgl_ins_base_" . $i)) ?>
                </td>
                <?php endfor ?>
              </tr>

              <?php for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++):?>
                <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <td style="text-align:center;">
                  <?php echo Form::select("sta_time_h[" . $i . "][" . $j . "]", $time["time_h"], HTML::replace_empty_array_value($post, array("sta_time_h", $i, $j)), array("id" => "progrgl_ins_sta_time_h_" . $i . "_" . $j)) ?>：<?php echo Form::select("sta_time_m[" . $i . "][" . $j . "]", $time["time_m"], HTML::replace_empty_array_value($post, array("sta_time_m", $i, $j)), array("id" => "progrgl_ins_sta_time_m_" . $i . "_" . $j)) ?>～<?php echo Form::select("end_time_h[" . $i . "][" . $j . "]", $time["time_h"], HTML::replace_empty_array_value($post, array("end_time_h", $i, $j)), array("id" => "progrgl_ins_end_time_h_" . $i . "_" . $j)) ?>：<?php echo Form::select("end_time_m[" . $i . "][" . $j . "]", $time["time_m"], HTML::replace_empty_array_value($post, array("end_time_m", $i, $j)), array("id" => "progrgl_ins_end_time_m_" . $i . "_" . $j)) ?>
                  <?php echo Form::select("playlist[" . $i . "][" . $j . "]", $arr_all_playlist, $post["playlist"][$i][$j], array("id" => "progrgl_ins_playlist_" . $i . "_" . $j)) ?><br />
                  </td>
                <?php endfor ?>
                </tr>
              <?php endfor ?>
            </table>
            </div>

            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_DEVPROG, "Return", array("id" => "progrgl_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "progrgl_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r', 'onclick'=>'func_ins()')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>

        </div>
      </div>
    </div>
<?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
  <script>
    var ants_version = "<?php echo $post["ants_version"];?>";
    var max_playlist = "<?php echo MAX_PROGRGL_PLAYLIST;?>";
    var max_dow = "<?php echo MAX_PROGRGL_DOW;?>";
    var playlist_info = <?php echo json_encode($post["playlist_ants_version"]);?>;
    func_reset('true',ants_version,max_playlist,max_dow,playlist_info);
  </script>
<?php endif ?>
    <!-- #/main -->
