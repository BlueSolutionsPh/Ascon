
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Sumaho delivery setting [smart distribution list]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "devhtml_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Smart phone distribution list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "devhtml_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Terminal tag</td><td><?php echo Form::select("dev_tag_1", $arr_all_dev_tag, HTML::replace_empty_array_value($post, "dev_tag_1"), array("id" => "devhtml_dev_tag_1")) ?></td></tr>
                <tr><td>Device name</td><td><?php echo Form::input("dev_name", HTML::replace_empty_array_value($post, "dev_name"), array("id" => "devhtml_dev_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td>Installation store tag</td><td><?php echo Form::select("shop_tag_1", $arr_all_shop_tag, HTML::replace_empty_array_value($post, "shop_tag_1"), array("id" => "devhtml_shop_tag_1")) ?></td></tr>
                <tr><td>Installation store name</td><td><?php echo Form::input("shop_name", HTML::replace_empty_array_value($post, "shop_name"), array("id" => "devhtml_shop_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "検索", array("id" => "devhtml_search", "type" => "submit", 'class'=>'btn3')) ?>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "devhtml_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Device name</th>
              <th scope="col" style="width:110px;">Distribution start date and time</th>
              <th scope="col" style="width:110px;">Delivery end date and time</th>
              <th scope="col">Smaho content name</th>
              <th scope="col">changer</th>
              <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
                <th scope="col" style="width:70px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
                <th scope="col" style="width:50px">
                  <INPUT TYPE="button" onClick="On_BoxChecked(
                    <?php
                      foreach($arr_dev as $dev){
                        if(!empty($dev->arr_devhtml)){
                          foreach($dev->arr_devhtml as $i => $devhtml){
                           echo $devhtml->dev_html_rela_id.",";
                          }
                        }
                      }
                      echo "0";
                    ?>
                  )" VALUE="Select all">
                  <INPUT TYPE="button" onClick="Off_BoxChecked(
                    <?php
                      foreach($arr_dev as $dev){
                        if(!empty($dev->arr_devhtml)){
                          foreach($dev->arr_devhtml as $i => $devhtml){
                           echo $devhtml->dev_html_rela_id.",";
                          }
                        }
                      }
                      echo "0";
                    ?>
                  )" VALUE="All cancellation">
                </th>
              <?php endif ?>
            </tr>

            <?php foreach($arr_dev as $dev): ?>
              <?php if(!empty($dev->arr_devhtml)):?>
                <?php foreach($dev->arr_devhtml as $i => $devhtml): ?>
                <tr>
                  <?php if($i === 0):?>
                  <td rowspan="<?php echo(count($dev->arr_devhtml)) ?>">
                    <?php if(Auth::auth_check(MODULE_NAME_DEVHTMLVIEW, ACTION_SEL)): ?>
                      <?php echo(HTML::anchor("/" . MODULE_NAME_DEVHTMLVIEW . "/index/" . $dev->dev_id, Kohana_HTML::entities($dev->dev_name), array("id" => "devhtml_devhtmlview_" . $dev->dev_id), null, false))?>
                    <?php else: ?>
                      <?php echo Kohana_HTML::entities($dev->dev_name) ?>
                    <?php endif ?>
                  </td>
                  <?php endif ?>
                  <td style="text-align:center;"><?php echo(HTML::fix_dt_str(Kohana_HTML::entities(HTML::replace_empty_str($devhtml, "sta_dt")))); ?></td>
                  <td style="text-align:center;"><?php echo(HTML::fix_dt_str(Kohana_HTML::entities(HTML::replace_empty_str($devhtml, "end_dt")))); ?></td>
                  <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($devhtml, "html_name"))); ?></td>
                  <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($devhtml, "update_user"))); ?></td>

                  <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
                    <td>
                      <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
                        <?php echo Form::open() ?>
                        <?php echo Form::hidden("disp", "del") ?>
                        <?php echo Form::hidden("dev_html_rela_id", $devhtml->dev_html_rela_id) ?>
                        <?php echo Form::submit(NULL, "削除", array("id" => "devhtml_del_" . $devhtml->dev_html_rela_id, 'class'=>'btn3', 'style'=>'width:100%;')) ?>
                        <?php echo Form::close() ?>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>
                  <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
                    <td>
                      <div style="margin-top:2px" align="center">
                        <?php echo Form::checkbox("chk_devhtml[]" , $devhtml->dev_html_rela_id,(HTML::replace_empty_array_value($post, "chk_devhtml") === $devhtml->dev_html_rela_id),array("id" => "chk_" . $devhtml->dev_html_rela_id , "onClick" => "check()")) ?>
                      </div>
                    </td>
                  <?php endif; ?>

                <?php endforeach; ?>
              </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_DEVHTML, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="devhtml_lumpdel" value="一括削除" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
