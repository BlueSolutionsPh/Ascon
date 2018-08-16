

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Device list</div>
        </div>
      </div>
    </div>


    <div id="mainlist">
      <?php if(ENABLE_CHECK_PROGRAM){ ?>
      <div class="box_01">
        <h3 class="title">番組表チェック</h3>
        <div class="content">
          <table class="tbl_01 tbl_yoko on">
          <tr><th>Terminal</th><th>date</th><th>エラー内容</th></tr>
          <?php foreach($checkStr as $item){ ?>
          <tr><td><?php echo $item['dev_name']; ?></td><td><?php echo $item['date']; ?></td><td><?php echo $item['reason']; ?></td></tr>
          <?php } ?>
          </table>
        </div>
      </div>
      <?php } ?>

      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Device list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "dev_search_form")) ?>
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

                <tr>
                  <td>Booth name</td>
                  <td>
                    <select id="dev_ins_booth_id" name="booth_id">
<?php foreach ($arr_all_booth as $key => $booth):?>
                      <option value="<?php echo $key;?>" data-shop_id="<?php echo $booth['shop_id'];?>" data-floor_id="<?php echo $booth['floor_id'];?>" data-sex_id="<?php echo $booth['sex_id'];?>"<?php echo ($post['booth_id'] == $key) ? ' selected' : '';?>><?php echo $booth['booth_name'];?></option>
<?php endforeach;?>
                    </select>
                  </td>
                </tr>

                 <tr><td>sex</td><td><?php echo Form::select("sex_id", $arr_all_sex_id,  HTML::replace_empty_array_value($post, "sex_id"),array("id" => "dev_sex_id")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "dev_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_DEV, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "dev_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Serial number</th>
              <th scope="col" class="th_width_long">Contract client name</th>
              <th scope="col" class="th_width_long">Name of facility</th>
              <th scope="col" class="th_width_middle">Booth name</th>
              <th scope="col" class="th_width_short">Installation floor</th>
              <th scope="col" class="th_width_short">sex</th>
              <th scope="col" class="th_width_short">Type</th>
              <th scope="col" class="th_width_short">State</th>
              <?php if(Auth::auth_check(MODULE_NAME_DEV, ACTION_UP) || Auth::auth_check(MODULE_NAME_DEV, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_dev as $dev): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><span<?php if ($dev->invalid_flag === 1):?> class="red"<?php endif;?>><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dev, "serial_no"))); ?></span></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dev, "client_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dev, "shop_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dev, "booth_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dev, "floor_name"))); ?></td>
              <td class="td_text_center"><?php echo ($dev->sex_id === 1) ? 'woman' : 'Man';?></td>
              <td class="td_text_center"><?php echo ($dev->unit_flag === 1) ? 'Cordless handset' : 'Master unit';?></td>
              <td class="td_text_center"><span<?php echo ($dev->invalid_flag === 1) ? ' class="red">Disabled' : '>Effectiveness';?></span></td>
              <?php if(Auth::auth_check(MODULE_NAME_DEV, ACTION_UP) || Auth::auth_check(MODULE_NAME_DEV, ACTION_DEL)): ?>
              <td class="td_button_center">
                <?php if(Auth::auth_check(MODULE_NAME_DEV, ACTION_UP)): ?>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "up") ?>
                    <?php echo Form::hidden("dev_id", $dev->dev_id) ?>
                    <?php echo Form::submit(NULL, "Edit", array("id" => "dev_up_" . $dev->dev_id, 'class'=>'btn3', 'style'=> 'float:left;')) ?>
                    <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_DEV, ACTION_DEL)): ?>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "del") ?>
                    <?php echo Form::hidden("dev_id",    $dev->dev_id) ?>
                    <?php echo Form::hidden("client_id", $dev->client_id) ?>
                    <?php echo Form::submit(NULL, "Delete", array("id" => "dev_del_" . $dev->dev_id, 'class'=>'btn3', 'style'=> 'float:right;')) ?>
                    <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          </div>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
