
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Sumaho delivery setting [smart delivery registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "devhtml_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Sumaho delivery registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>
          <?php echo Form::select("arr_dev[]", null, null, array("id" => "devhtml_ins_arr_dev", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::hidden("dev_html_rela_name", time()) ?>

            <div class="hr_wrapper_01">
              <div class="progleft" style="margin-bottom:10px;">
                <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                  <tbody>
                    <tr class="even">
                      <td>Distribution start date and time</td>
                      <td><?php echo Form::input("sta_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "sta_dt")), array("id" => "devhtml_ins_sta_dt", "required" => "true", "size" => "25", "maxlength" => "16", 'class'=>'input125 datetime_2m')) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Delivery end date and time</td>
                      <td><?php echo Form::input("end_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "end_dt")), array("id" => "devhtml_ins_end_dt", "required" => "true", "size" => "25", "maxlength" => "16", 'class'=>'input125 datetime_2m_end')) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Smurf content</td>
                      <td><?php echo Form::select("html", $arr_all_html, HTML::replace_empty_array_value($post, "html"), array("id" => "devhtml_ins_html", "required" => "true")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Overwrite</td>
                      <td><?php echo Form::checkbox("over_write", "true", (HTML::replace_empty_array_value($post, "over_write") === "true"), array("id" => "devhtml_ins_over_write")) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="progright" style="margin-bottom:10px;">
                <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                  <tbody>
                    <tr class="even">
                      <td>Store name search</td>
                      <td><?php echo Form::input("shop_name", HTML::replace_empty_array_value($post, "shop_name"), array("id" => "devhtml_ins_shop_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal name search</td>
                      <td><?php echo Form::input("dev_name", HTML::replace_empty_array_value($post, "dev_name"), array("id" => "devhtml_ins_dev_name", "maxlength" => "20", "size" => "40")) ?></td>
                    </tr>
                    <tr class="even">
                      <td>Terminal tag search</td>
                      <td>
                        <?php echo Form::select("dev_tag", $arr_all_tag, HTML::replace_empty_array_value($post, "dev_tag"), array("id" => "devhtml_ins_dev_tag")) ?>
                        <?php echo Form::button("search", "Search", array("id" => "devhtml_ins_search", "type" => "button", "onclick" => "func_search()")) ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>

              <div class="progleft" style="margin-left:5px;">
                <dl class="dl_input_02">
                  <dt>Select terminal</dt>
                  <dd>
                    <?php echo Form::select("tmp_arr_dev[]", $arr_sel_dev, null, array("id" => "devhtml_ins_tmp_arr_dev", "multiple" => "multiple", "style" => "width:100%;height:300px;")) ?>
                  </dd>
                </dl>
              </div>

              <div class="progright">
                <dl class="dl_input_02">
                  <dt>Terminal</dt>
                  <dd>
                    <?php echo Form::select("arr_search_dev[]", $arr_all_dev, null, array("id" => "devhtml_ins_arr_search_dev", "multiple" => "multiple", "style" => "width:100%;height:300px;")) ?>
                  </dd>
                </dl>
              </div>
              <div class="clear"></div>
              <div style="text-align:center;">
                  <?php echo Form::button("del", "Delete →", array("id" => "devhtml_ins_del", "type" => "button", "onclick" => "func_del()")) ?>
                  <?php echo Form::button("add", "← Add", array("id" => "devhtml_ins_ins", "type" => "button", "onclick" => "func_add()")) ?>
              </div>
            </div>

            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_DEVHTML, "Return", array("id" => "devhtml_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "devhtml_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r', 'onclick' => 'func_ins()')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
