
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Delete all smartphone contents】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "html_del_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delete all smartphone contents</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "lump_del") ?>
        <?php echo Form::hidden("act", "lump_del") ?>
        <?php for($i=0;$i<count($html_id);$i++){ ?>
        <?php echo Form::hidden("chk_html[$i]", $html_id[$i]); ?>
        <?php } ?>

          <div class="text_02">Delete the following smart content?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th rowspan="<?php echo(count($html_name)); ?>" valign="top" align="left" width="20%">Smaho content name</th>
                <?php for($i=0;$i<count($html_name);$i++){ ?>
                <td><?php echo(Kohana_HTML::entities($html_name[$i])); ?></td>
              </tr>
              <?php } ?>
            </table>
          </div>

          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_HTML, "Return", array("id" => "html_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "html_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
