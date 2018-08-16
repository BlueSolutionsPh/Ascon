
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Tag registration</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "tag_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Tag registration</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("tag_cat_id", $post["tag_cat_id"]) ?>
          
            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Tag name</dt>
                <dd>
                  <?php echo Form::input("tag_name", HTML::replace_empty_array_value($post, "tag_name"), array("id" => "tag_ins_tag_name", "maxlength" => "20", "size" => "50", "required" => "true")) ?>
                  ※Within 20 characters
                </dd>
                <dt>Tag classification</dt>
                <dd>
                  <?php echo $arr_all_tag_cat[$post["tag_cat_id"]] ?><br />
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_TAG, "Return", array("id" => "tag_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "tag_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
