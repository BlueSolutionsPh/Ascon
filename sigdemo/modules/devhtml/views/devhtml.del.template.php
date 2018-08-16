
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Sumaho delivery setting [smaho delivery deletion]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "devhtml_del_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Smart phone delivery deletion</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "del") ?>
        <?php echo Form::hidden("act", "del") ?>
        <?php echo Form::hidden("dev_html_rela_id", $dev_html_rela_id) ?>

          <div class="text_02">Delete the following smartphone delivery settings?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th scope="row" width="20%">Device name</th>
                <td><?php echo(Kohana_HTML::entities($dev_html_rela->dev_name)); ?></td>
              </tr>
              <tr>
                <th scope="row" width="20%">Distribution start date and time</th>
                <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($dev_html_rela->sta_dt))); ?></td>
              </tr>
              <tr>
              <th scope="row" width="20%">Delivery end date and time</th>
                <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($dev_html_rela->end_dt))); ?></td>
              </tr>
              <?php if(isset($dev_html_rela->html_name)): ?>
                <tr>
                  <th scope="row" width="20%">Setting smart content name</th>
                  <td><?php echo(Kohana_HTML::entities($dev_html_rela->html_name)) ?></td>
                </tr>
              <?php endif ?>
            </table>
          </div>

          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_DEVHTML, "Return", array("id" => "devhtml_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "devhtml_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
