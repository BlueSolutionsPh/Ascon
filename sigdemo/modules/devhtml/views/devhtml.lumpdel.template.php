
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Sumaho delivery setting [Delete all smartphone delivery]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "devhtml_del_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delete all smartphone delivery</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "lump_del") ?>
        <?php echo Form::hidden("act", "lump_del") ?>
        <?php for($i=0;$i<count($dev_html_rela_id);$i++){ ?>
        <?php echo Form::hidden("chk_devhtml[$i]", $dev_html_rela_id[$i]); ?>
        <?php } ?>
          <div class="text_02">Delete the following smartphone delivery settings?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col">Device name</th>
                <th scope="col" style="width:150px">Distribution start date and time</th>
                <th scope="col" style="width:150px">Delivery end date and time</th>
                <th scope="col">Setting smart content name</th>
              </tr>
              <?php $tmp_dev_name = null ?>
              <?php for($i=0;$i<count($dev_html_rela);$i++){ ?>
                <tr>
                  <?php if($tmp_dev_name !== $dev_html_rela[$i]->dev_name): ?>
                    <?php $tmp_dev_name = $dev_html_rela[$i]->dev_name ?>
                      <?php for($j=$i;$j<count($dev_html_rela);$j++){ ?>
                        <?php if($tmp_dev_name !== $dev_html_rela[$j]->dev_name): ?>
                          <td rowspan="<?php echo ($j-$i); ?>">
                            <?php echo(Kohana_HTML::entities($dev_html_rela[$i]->dev_name)); ?>
                          </td>
                          <?php break ?>
                        <?php endif ?>
                      <?php } ?>
                      <?php if($j == count($dev_html_rela)): ?>
                        <td rowspan="<?php echo ($j-$i); ?>">
                          <?php echo(Kohana_HTML::entities($dev_html_rela[$i]->dev_name)); ?>
                        </td>
                      <?php endif ?>
                  <?php endif ?>
                  <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($dev_html_rela[$i]->sta_dt))); ?></td>
                  <td><?php echo(HTML::fix_dt_str(Kohana_HTML::entities($dev_html_rela[$i]->end_dt))); ?></td>
                  <?php if(isset($dev_html_rela[$i]->html_name)): ?>
                    <td><?php echo(Kohana_HTML::entities($dev_html_rela[$i]->html_name)) ?></td>
                  <?php endif ?>
                </tr>
              <?php } ?>
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
