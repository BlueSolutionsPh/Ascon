
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Contract client listContract client list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Contract client list</h3>
        <div class="content">

          <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "client_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Contract client name</th>
              <th scope="col" class="th_width_short">Number of Facilities</th>
              <th scope="col" class="th_width_middle">Booths</th>
              <th scope="col" class="th_width_short">Number of terminals</th>
              <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_UP) || Auth::auth_check(MODULE_NAME_CLIENT, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_client as $client): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($client, "client_name"))); ?></td>
              <td class="td_text_center">
                <?php if(!empty($client->shop_cnt)): ?>
                  <?php echo(HTML::anchor("/" . MODULE_NAME_SHOP, $client->shop_cnt, array("id" => "client_shop_" . $client->client_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>
              <td class="td_text_center">
                <?php if(!empty($client->booth_cnt)): ?>
				  <?php echo(HTML::anchor("/" . MODULE_NAME_BOOTH, $client->booth_cnt, array("id" => "client_booth_" . $client->client_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>
              <td class="td_text_center">
                <?php if(!empty($client->dev_cnt)): ?>
                  <?php echo(HTML::anchor("/" . MODULE_NAME_DEV, $client->dev_cnt, array("id" => "client_dev_" . $client->client_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>
              <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_UP) || Auth::auth_check(MODULE_NAME_CLIENT, ACTION_DEL)): ?>
              <td class="td_button_center">
                <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("client_id", $client->client_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "client_up_" . $client->client_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>

                <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("client_id", $client->client_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "client_del_" . $client->client_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
              </td>
              <?php endif ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          </div>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
