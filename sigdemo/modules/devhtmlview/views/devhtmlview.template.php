
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Sumaho delivery setting by terminal [Smartphone distribution by terminal]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "devhtmlview_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Smartphone distribution by terminal</h3>
        <div class="content">

          <h3>Smartphone distribution by device</h3>
          <p class="text01">
          <?php echo Form::label("dev_name", "端末名：") ?>
          <?php echo Form::label("dev_name", $dev_name) ?>
          </p>

          <?php if(!empty($arr_dev_html_rela)):?>
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col" style="width:150px">Start date and time</th>
                <th scope="col" style="width:150px">End date and time</th>
                <th scope="col">Smurf content</th>
                <?php if(Session::get_target_client_id() !== false && (Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_INS) || Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_UP) || Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_DEL))): ?>
                  <th scope="col" style="width:135px"></th>
                <?php endif ?>
              </tr>

              <?php $arr_dev_html_rela_id = array() ?>
              <?php foreach ($arr_dev_html_rela as $dev_html_rela): ?>
                <tr class="dev_html_rela_<?php echo($dev_html_rela->dev_html_rela_id) ?>">

                  <?php if(isset($dev_html_rela_id) && (string)$dev_html_rela->dev_html_rela_id === $dev_html_rela_id && in_array($dev_html_rela->dev_html_rela_id, $arr_dev_html_rela_id) === false):?>
                    <td><?php echo Form::input("sta_dt", HTML::fix_dt_str(HTML::replace_empty_str($dev_html_rela, "sta_dt")), array("id" => "devhtmlview_sta_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime')) ?></td>
                    <td><?php echo Form::input("end_dt", HTML::fix_dt_str(HTML::replace_empty_str($dev_html_rela, "end_dt")), array("id" => "devhtmlview_end_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime_end')) ?></td>
                  <?php else: ?>
                    <td style="text-align:center"><?php echo HTML::fix_dt_str(HTML::replace_empty_str($dev_html_rela, "sta_dt")) ?></td>
                    <td style="text-align:center"><?php echo HTML::fix_dt_str(HTML::replace_empty_str($dev_html_rela, "end_dt")) ?></td>
                  <?php endif ?>

                  <td>
                    <?php if(isset($dev_html_rela_id) && (string)$dev_html_rela->dev_html_rela_id === $dev_html_rela_id && in_array($dev_html_rela->dev_html_rela_id, $arr_dev_html_rela_id) === false):?>
                      <?php if(isset($dev_html_rela->html_id)): ?>
                        <?php echo Form::select("html", $arr_all_html, $dev_html_rela->html_id, array("id" => "devhtmlview_html", "required" => "true")) ?>
                      <?php else: ?>
                        <?php echo Form::select("html", $arr_all_html, "", array("id" => "devhtmlview_html", "required" => "true")) ?>
                      <?php endif ?>
                    <?php else: ?>
                      <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($dev_html_rela->html_url)): ?>
                        <?php echo HTML::anchor($dev_html_rela->html_url, Kohana_HTML::entities($dev_html_rela->html_name), array("id" => "devhtmlview_file_" . $dev_html_rela->html_id), null, false) ?>
                      <?php else: ?>
                        <?php echo(Kohana_HTML::entities($dev_html_rela->html_name)); ?>
                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <?php if(Session::get_target_client_id() !== false && (Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_INS) || Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_UP) || Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_DEL))): ?>
                    <td>
                    <?php if(!isset($dev_html_rela_id) && in_array($dev_html_rela->dev_html_rela_id, $arr_dev_html_rela_id) === false): ?>
                      <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_UP)): ?>
                        <?php echo Form::open() ?>
                        <?php echo Form::hidden("disp", "up") ?>
                        <?php echo Form::hidden("dev_html_rela_id", $dev_html_rela->dev_html_rela_id) ?>
                        <?php echo Form::submit(NULL, "Edit", array("id" => "devhtmlview_up_" . $dev_html_rela->dev_html_rela_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                        <?php echo Form::close() ?>
                      <?php endif ?>
                      <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_DEL)): ?>
                        <?php echo Form::open() ?>
                        <?php echo Form::hidden("disp", "del") ?>
                        <?php echo Form::hidden("dev_html_rela_id", $dev_html_rela->dev_html_rela_id) ?>
                        <?php echo Form::submit(NULL, "Delete", array("id" => "devhtmlview_del_" . $dev_html_rela->dev_html_rela_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                        <?php echo Form::close() ?>
                      <?php endif ?>
                    <?php elseif(isset($dev_html_rela_id) && (string)$dev_html_rela->dev_html_rela_id === $dev_html_rela_id && in_array($dev_html_rela->dev_html_rela_id, $arr_dev_html_rela_id) === false): ?>
                      <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_UP)): ?>
                        <?php echo Form::open(null, array("id" => "form")) ?>
                        <?php echo Form::hidden("disp", "up") ?>
                        <?php echo Form::hidden("act", "up") ?>
                        <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                        <?php echo Form::hidden("dev_html_rela_id", $dev_html_rela->dev_html_rela_id) ?>
                        <?php echo Form::hidden("dev_html_rela_name", time()) ?>
                        <?php echo Form::submit(null, "Save", array("id" => "devhtmlview_save_" . $dev_html_rela->dev_html_rela_id, "onclick" => "func_up()", 'class'=>'btn3', 'style' => 'float:left;')) ?>
                        <?php echo Form::close() ?>
                      <?php endif ?>
                      <?php echo Form::open() ?>
                      <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                      <?php echo Form::submit(NULL, "Cancel", array("id" => "devhtmlview_cancel_" . $dev_html_rela->dev_html_rela_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                      <?php echo Form::close() ?>
                    <?php else: ?>
                      <?php echo("-") ?>
                    <?php endif ?>
                  </td>
                  <?php endif ?>

                  <?php if(in_array($dev_html_rela->dev_html_rela_id, $arr_dev_html_rela_id) === false): ?>
                    <?php array_push($arr_dev_html_rela_id, $dev_html_rela->dev_html_rela_id) ?>
                  <?php endif ?>
                </tr>
              <?php endforeach; ?>

              <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_INS)): ?>
                <?php if(!isset($dev_html_rela_id)):?>
                  <tr>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "ins") ?>
                    <?php echo Form::hidden("act", "ins") ?>
                    <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                    <?php echo Form::hidden("dev_html_rela_name", time()) ?>
                    <td><?php echo Form::input("sta_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "sta_dt")), array("id" => "devhtmlview_sta_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime')) ?></td>
                    <td><?php echo Form::input("end_dt", HTML::fix_dt_str(HTML::replace_empty_array_value($post, "end_dt")), array("id" => "devhtmlview_end_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime_end')) ?></td>
                    <td><?php echo Form::select("html", $arr_all_html, HTML::replace_empty_array_value($post, "html"), array("id" => "devhtmlview_html", "required" => "true")) ?></td>
                    <td><?php echo Form::submit(NULL, "add to", array('class'=>'btn3')) ?></td>
                    <?php echo Form::close() ?>
                  </tr>
                <?php endif ?>
              <?php endif ?>

            </table>
          <?php endif ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
