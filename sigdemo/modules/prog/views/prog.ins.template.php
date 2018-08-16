
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Program guide setting [Program guide (date and time designation) registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "prog_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title"> Program guide (date designation) registration</h3>
        <div class="content">
          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>
          <?php echo Form::select("arr_dev[]", null, null, array("id" => "prog_ins_arr_dev", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::hidden("prog_name", time()) ?>
          <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
            <?php echo Form::hidden("ants_version_tmp", $arr_all_ants_version_tmp, array("id" => "dev_ins_ants_version_tmp")) ?>
          <?php endif ?>

            <div class="hr_wrapper_01">
              <div class="progleft" style="margin-bottom:10px;">
                <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                  <tbody>
                    <tr class="even">
                      <td>Distribution start date and time</td>
                      <td><?php echo Form::input("sta_dt", HTML::replace_empty_array_value($post, "sta_dt"), array("id" => "prog_ins_sta_dt", "required" => "true", "size" => "25", "maxlength" => "16", 'class'=>'input125 datetime_2m')) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Delivery end date and time</td>
                      <td><?php echo Form::input("end_dt", HTML::replace_empty_array_value($post, "end_dt"), array("id" => "prog_ins_end_dt", "required" => "true", "size" => "25", "maxlength" => "16", 'class'=>'input125 datetime_2m_end')) ?></td>
                    </tr>
                    <tr class="even">
                      <td>playlist</td>
                      <td><?php echo Form::select("ch_1", $arr_all_playlist, HTML::replace_empty_array_value($post, "ch_1"), array("id" => "prog_ins_ch_1")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Overwrite</td>
                      <td><?php echo Form::checkbox("over_write", "true", (HTML::replace_empty_array_value($post, "over_write") === "true"), array("id" => "prog_ins_over_write")) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="progright" style="margin-bottom:10px;">
                <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                  <tbody>
                    <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
                      <tr class="even">
                      <td>ant's classification</td>
                      <td><?php
                        $playlist_info = json_encode($post["playlist_ants_version"]);
                        echo Form::select("ants_version", $arr_all_ants_version, HTML::replace_empty_array_value($post, "ants_version"),
                      	array("id" => "dev_ins_ants_version", "required" => "true", "onchange" => "func_reset('false','',". $playlist_info. ")")) ?>
                        <span class="popup_help" data-message="※ When terminal is selected, ant's type can not be changed.">[?]</span>
                      </td></tr>
                    <?php else: ?>
                      <tr class="even">
                      <td style="display: none;"> ant's type</td>
                      <td style="display: none;"><?php echo Form::select("ants_version", $arr_all_ants_version, ANTS_TWO_KIND, array("id" => "dev_ins_ants_version", "required" => "true")) ?></td></tr>
                    <?php endif ?>
                    <tr class="even">
                      <td>Store name search</td>
                      <td><?php echo Form::input("shop_name", HTML::replace_empty_array_value($post, "shop_name"), array("id" => "prog_ins_shop_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal name search</td>
                      <td><?php echo Form::input("dev_name", HTML::replace_empty_array_value($post, "dev_name"), array("id" => "prog_ins_dev_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal Remarks Search</td>
                      <td><?php echo Form::input("note", HTML::replace_empty_array_value($post, "note"), array("id" => "prog_ins_note", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal tag search</td>
                      <td>
                        <?php echo Form::select("dev_tag", $arr_all_tag, HTML::replace_empty_array_value($post, "dev_tag"), array("id" => "prog_ins_dev_tag")) ?>
                        <?php echo Form::button("search", "Search", array("id" => "prog_ins_search", "type" => "button", "onclick" => "func_search()")) ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>

              <div class="progleft" style="margin-left:5px;">
                <dl class="dl_input_02">
                  <dt>Select terminal  <span id="dev_count" style="margin-left: 10px;"></span></dt>
                  <dd>
                    <?php echo Form::select("tmp_arr_dev[]", $arr_sel_dev, null, array("id" => "prog_ins_tmp_arr_dev", "multiple" => "multiple", "style" => "width:100%;height:300px;")) ?>
                  </dd>
                </dl>
              </div>

              <div class="progright">
                <dl class="dl_input_02">
                  <dt>Terminal</dt>
                  <dd>
                    <?php echo Form::select("arr_search_dev[]", $arr_all_dev, null, array("id" => "prog_ins_arr_search_dev", "multiple" => "multiple", "style" => "width:100%;height:300px;")) ?>
                  </dd>
                </dl>
              </div>
              <div class="clear"></div>
              <div style="text-align:center;">
                <?php echo Form::button("del", "Delete →", array("id" => "prog_ins_del", "type" => "button", "onclick" => "func_del()")) ?>
                <?php echo Form::button("add", "← add to", array("id" => "prog_ins_ins", "type" => "button", "onclick" => "func_add()")) ?>
              </div>
            </div>

            <div class="text_01">上記内容を確認して「登録」ボタンを押す</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_DEVPROG, "Return", array("id" => "prog_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "prog_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r', 'onclick'=>'func_ins()')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
<?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
  <script>
    //var ants_version = "<?php echo ANTS_TWO_KIND;?>";
    var ants_version = "<?php echo $post["ants_version"];?>";
    var playlist_info = <?php echo json_encode($post["playlist_ants_version"]);?>;
    func_reset('true',ants_version,playlist_info);
  </script>
<?php endif ?>
    <!-- #/main -->
