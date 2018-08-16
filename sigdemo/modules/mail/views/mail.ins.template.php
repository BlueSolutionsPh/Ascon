

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Mail setting E-mail address registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "dev_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">E-mail address registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>mail address</dt>
                <dd>
                  <?php echo Form::input("mail_addr", HTML::replace_empty_array_value($post, "mail_addr"), array("id" => "mail_ins_mail_addr", "required" => "true", "maxlength" => "200", "class" => "input500")) ?>
                  ※ Within 100 characters
                </dd>
                <dt>Remarks</dt>
                <dd>
                  <?php echo Form::textarea("note", HTML::replace_empty_array_value($post, "note"), array("id" => "mail_ins_note", "maxlength" => "500", "class" => "input500")) ?>
                  ※ Within 500 characters
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_MAIL, "Return", array("id" => "mail_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "mail_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
