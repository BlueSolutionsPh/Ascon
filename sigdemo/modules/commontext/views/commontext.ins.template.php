
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting [Register common telop]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commontext_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Register common telop</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Telop name</dt>
                <dd>
                  <?php echo Form::input("text_name", HTML::replace_empty_array_value($post, "text_name"), array("id" => "commontext_ins_text_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>
                  ※ Within 60 characters
                </dd>
                <dt>Ticker contents</dt>
                <dd>
                  <?php echo Form::textarea("text_msg", HTML::replace_empty_array_value($post, "text_msg"), array("id" => "commontext_ins_text_msg", "required" => "true", "maxlength" => "500", "class" => "input500")) ?>
                  ※500文字以内
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "sta_dt")), array("id" => "commontext_ins_sta_dt", "class" => "input125 datetime", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?> ～ <?php echo Form::input("end_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "end_dt")), array("id" => "commontext_ins_end_dt", "class" => "input125 datetime_end", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_COMMONTEXT, "Return", array("id" => "commontext_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "commontext_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
