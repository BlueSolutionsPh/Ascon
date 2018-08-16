
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting [Still image updat]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "image_up_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Still image update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("image_id", $post["image_id"]) ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">
                <dt>Still image name</dt>
                <dd>
                  <?php echo Form::input("image_name", $post["image_name"], array("id" => "image_up_image_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>
                  ※ Within 60 characters
                </dd>
                <?php if(isset($post["orig_file_name"]) && $post["orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("image_file", "Still image file") ?></dt>
                  <dd><?php echo Form::label("image_file", $post["orig_file_name"] . $post["orig_file_exte"]) ?></dd>
                <?php endif ?>

                <dt>size</dt>
                <dd>
                  <?php echo Html::chars($post["draw_size"]) ?>
                </dd>

                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", HTML::fix_dt_str($post["sta_dt"]), array("id" => "image_up_sta_dt", "class" => "input125 datetime", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?> ～ <?php echo Form::input("end_dt", HTML::fix_dt_str($post["end_dt"]), array("id" => "image_up_end_dt", "class" => "input125 datetime_end", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                </dd>
                <dt>tag</dt>
                <dd>
                  <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "image_up_arr_tag", "multiple" => "multiple")) ?>
                </dd>
              </dl>
              <dl class="dl_input_02" style="float:left;">
                <dt>attribute</dt>
                <dd>
                  <?php echo Form::select("property_id", $arr_all_property, HTML::replace_empty_array_value($post, "property_id", array()), array("id" => "image_up_property", "size"=>count($arr_all_property) )) ?>
                </dd>
              </dl>
            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_IMAGE, "Return", array("id" => "image_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "image_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
