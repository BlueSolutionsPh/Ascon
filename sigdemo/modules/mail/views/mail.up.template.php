
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Mail setting [Update e-mail address]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "dev_up_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Email address update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("mail_id", $post["mail_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>mail address</dt>
                <dd>
                  <?php echo Form::input("mail_addr", $post["mail_addr"], array("id" => "mail_up_mail_addr", "required" => "true", "maxlength" => "200", "size" => "200", "class" => "input500")) ?>
                  ※ Within 100 characters
                </dd>
                <dt>Remarks</dt>
                <dd>
                  <?php echo Form::textarea("note", $post["note"], array("id" => "mail_up_note", "required" => "true", "maxlength" => "500", "class" => "input500")) ?>
                  ※ Within 500 characters
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_MAIL, "Return", array("id" => "mail_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "mail_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
