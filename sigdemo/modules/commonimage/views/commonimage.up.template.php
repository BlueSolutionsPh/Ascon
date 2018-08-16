
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Common still image update】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commonimage_up_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Common still image update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("image_id", $post["image_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Still image name</dt>
                <dd>
                  <?php echo Form::input("image_name", $post["image_name"], array("id" => "commonimage_up_image_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>
                  ※ Within 60 characters
                </dd>

                <?php if(isset($post["orig_file_name"]) && $post["orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("image_file", "静止画ファイル") ?></dt>
                  <dd><?php echo Form::label("image_file", $post["orig_file_name"] . $post["orig_file_exte"]) ?></dd>
                <?php endif ?>
                <dt>size</dt>
                <dd>
                  <?php echo Html::chars($post["draw_size"]) ?>
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", HTML::fix_dt_str($post["sta_dt"]), array("id" => "commonimage_up_sta_dt", "class" => "input125 datetime", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?> ～ <?php echo Form::input("end_dt", HTML::fix_dt_str($post["end_dt"]), array("id" => "commonimage_up_end_dt", "class" => "input125 datetime_end", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_COMMONIMAGE, "Return", array("id" => "commonimage_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "commonimage_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
