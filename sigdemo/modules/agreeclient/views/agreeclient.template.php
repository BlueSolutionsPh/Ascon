
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Contract client list</div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Contract client list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "client_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Contract client name</td><td><?php echo Form::select("user_id", $arr_user_name, HTML::replace_empty_array_value($post, "user_id"), array("id" => "user_user_id")) ?></td></tr>
                <tr><td>Client type</td><td><?php echo Form::select("auth_grp_id", $arr_all_auth_grp, HTML::replace_empty_array_value($post, "auth_grp_id"), array("id" => "user_auth_grp_id")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "client_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "Search", array("id" => "client_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:400px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <?php if(Session::is_admin()): ?>
                <th scope="col" style="width:65px"></th>
              <?php endif ?>
              <th scope="col">Contract client name</th>
              <th scope="col">Client type</th>
              <th scope="col" style="width:60px;">Number of Facilities</th>
              <th scope="col" style="width:60px;">Booths</th>
              <th scope="col" style="width:60px;">Number of terminals</th>
              <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_UP) || Auth::auth_check(MODULE_NAME_CLIENT, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_client as $client): ?>
            <tr>
              <td align="center"><?php echo $i?></td>

              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($client, "client_name"))); ?></td>

              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($client, "client_kind"))); ?></td>

              <td style="text-align:center;"><?php if(!empty($client->booth_cnt)): ?><?php echo(Kohana_HTML::entities($client->booth_cnt)); ?><?php else: ?>0<?php endif ?></td>

              <td style="text-align:center;"><?php if(!empty($client->shop_cnt)): ?><?php echo(Kohana_HTML::entities($client->shop_cnt)); ?><?php else: ?>0<?php endif ?></td>

              <td style="text-align:center;"><?php if(!empty($client->dev_cnt)): ?><?php echo(Kohana_HTML::entities($client->dev_cnt)); ?><?php else: ?>0<?php endif ?></td>

              <?php if(Auth::auth_check(MODULE_NAME_CLIENT, ACTION_UP) || Auth::auth_check(MODULE_NAME_CLIENT, ACTION_DEL)): ?>
              <td>
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
