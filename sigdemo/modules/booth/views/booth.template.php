
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Booth list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Booth list</h3>
        <div class="content">
          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "booth_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Contract client name</td><td><?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "dev_ins_client_id")) ?></td></tr>
                <tr>
                  <td>Name of facility</td>
                  <td>
                  <select id="dev_ins_shop" name="shop">
<?php foreach ($arr_all_shop as $key => $shop):?>
                    <option value="<?php echo $key;?>" data-client_id="<?php echo $shop['client_id'];?>"<?php echo ($post['shop'] == $key) ? ' selected' : '';?>><?php echo $shop['shop_name'];?></option>
<?php endforeach;?>
                  </select>
                  </td>
                </tr>
                <tr><td>Installation floor</td><td><?php echo Form::select("floor_id",     $arr_all_floor, HTML::replace_empty_array_value($post, "floor_id"),     array("id" => "dev_ins_floor_id")) ?></td></tr>
                <tr><td>sex</td><td><?php echo Form::select("sex_id", $arr_all_sex_id,  HTML::replace_empty_array_value($post, "sex_id"),array("id" => "dev_sex_id")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "検索", array("id" => "booth_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_BOOTH, ACTION_INS)):?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "booth_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Booth name</th>
              <th scope="col" class="th_width_long">Contract client name</th>
              <th scope="col" class="th_width_long">Name of facility</th>
              <th scope="col" class="th_width_short">Installation floor</th>
              <th scope="col" class="th_width_short">sex</th>
              <th scope="col" class="th_width_short">Number of terminals</th>
              <?php if(Auth::auth_check(MODULE_NAME_BOOTH, ACTION_UP) || Auth::auth_check(MODULE_NAME_BOOTH, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_booth as $booth): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($booth, "booth_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($booth, "client_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($booth, "shop_name"))); ?></td>
              <td class="td_text_center"><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($booth, "floor_name"))); ?></td>
              <td class="td_text_center"><?php if($booth->sex_id === 1): ?>woman<?php else: ?>Man<?php endif ?></td>
              <td class="td_playtime td_text_center">
                <?php if(!empty($booth->dev_cnt)): ?>
                  <?php echo(HTML::anchor("/" . MODULE_NAME_DEV, $booth->dev_cnt, array("id" => "booth_dev_" . $booth->booth_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>

              <?php if(Auth::auth_check(MODULE_NAME_BOOTH, ACTION_UP) || Auth::auth_check(MODULE_NAME_BOOTH, ACTION_DEL)): ?>
              <td class="td_button_center">
                <?php if(Auth::auth_check(MODULE_NAME_BOOTH, ACTION_UP)):?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("booth_id", $booth->booth_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "booth_up_" . $booth->booth_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
                <?php if(Auth::auth_check(MODULE_NAME_BOOTH, ACTION_DEL)):?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("booth_id", $booth->booth_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "booth_del_" . $booth->booth_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
