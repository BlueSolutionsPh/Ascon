

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Mail settings</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "dev_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Email address list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
          <tr><td>Set an email address to notify the access status of the terminal</td></tr>
          </div>
          <?php if(Auth::auth_check(MODULE_NAME_MAIL, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "mail_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" style="width:400px">mail address</th>
              <th scope="col">Remarks </th>
              <?php if(Auth::auth_check(MODULE_NAME_MAIL, ACTION_UP) || Auth::auth_check(MODULE_NAME_MAIL, ACTION_DEL)): ?>
                <th scope="col" style="width:65px"></th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_mail as $mail): ?>
            <tr>
              <td><?php echo(Kohana_HTML::entities($mail->mail_addr)); ?></td>
              <td><?php echo(Kohana_HTML::entities($mail->note)); ?></td>


              <?php if(Auth::auth_check(MODULE_NAME_MAIL, ACTION_UP) || Auth::auth_check(MODULE_NAME_MAIL, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_MAIL, ACTION_UP)): ?>
                  <div style="margin-bottom:2px">
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "up") ?>
                    <?php echo Form::hidden("mail_id", $mail->mail_id) ?>
                    <?php echo Form::submit(NULL, "Edit", array("id" => "mail_up_" . $mail->mail_id, 'class'=>'btn3', 'style'=>'width:100%;')) ?>
                    <?php echo Form::close() ?>
                  </div>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_MAIL, ACTION_DEL)): ?>
                  <div>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "del") ?>
                    <?php echo Form::hidden("mail_id", $mail->mail_id) ?>
                    <?php echo Form::submit(NULL, "Delete", array("id" => "mail_del_" . $mail->mail_id, 'class'=>'btn3', 'style'=>'width:100%;')) ?>
                    <?php echo Form::close() ?>
                  </div>
                <?php endif; ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
