
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Ticker registration】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "text_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Ticker registration</h3>
        <div class="content">
          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:60%">
                <dt>Telop name</dt>
                <dd>
                  <?php echo Form::input("text_name", HTML::replace_empty_array_value($post, "text_name"), array("id" => "text_ins_text_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>
                  ※Within 60 characters
                </dd>
                <dt>Ticker contents</dt>
                <dd>
                  <?php echo Form::textarea("text_msg", HTML::replace_empty_array_value($post, "text_msg"), array("id" => "text_ins_text_msg", "required" => "true", "maxlength" => "500", "class" => "input500")) ?>
                  ※500 character limit
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "sta_dt")), array("id" => "text_ins_sta_dt", "class" => "input125 datetime", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?> ～ <?php echo Form::input("end_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "end_dt")), array("id" => "text_ins_end_dt", "class" => "input125 datetime_end", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                </dd>
                <dt>tag</dt>
                <dd>
                  <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "text_ins_arr_tag", "multiple" => "multiple")) ?>
                </dd>
              </dl>
              <dl class="dl_input_02" style="float:left;">
                <dt>attribute</dt>
                <dd>
                  <?php echo Form::select("property_id", $arr_all_property, HTML::replace_empty_array_value($post, "property_id", array()), array("id" => "text_ins_property", "size"=>count($arr_all_property) )) ?>
                </dd>
              </dl>
            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_TEXT, "Return", array("id" => "text_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "text_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
