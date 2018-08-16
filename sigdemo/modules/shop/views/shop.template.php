
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Facilities list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Facilities list</h3>
        <div class="content">
          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "shop_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <!-- <tr><td>Store tag</td><td><?php echo Form::select("shop_tag_1", $arr_all_shop_tag, HTML::replace_empty_array_value($post, "shop_tag_1"), array("id" => "shop_shop_tag_1")) ?></td></tr> -->
                <tr><td>Contract client name</td><td><?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "shop_client_id")) ?>
                    <?php echo Form::button('list', "Search list", array("id" => "shop_search", "type" => "submit", 'class'=>'btn')) ?>
                    <?php echo Form::button('map', "Map search", array("id" => "map_search", "type" => "submit", 'class'=>'btn')) ?>
                </td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>
<?php if ($mode == 'map'): ?>
          <div>
            <div id="map"></div>
            <div class="map-text-area">
              <div class="toggle">
                <table class="map-text">
                  <tr>
                    <th class="title">Contract client name</th>
                    <td colspan="2" class="client_name"></td>
                  </tr>
                  <tr>
                    <th class="title">Name of facility</td>
                    <td colspan="2" class="shop_name"></td>
                  </tr>
                  <tr>
                    <th class="title">Street address</td>
                    <td colspan="2" class="address"></td>
                  </tr>
                  <tr>
                    <th class="title">Postal code</td>
                    <td colspan="2" class="post"></td>
                  </tr>
                  <tr>
                    <th class="title">longitude / latitude</td>
                    <td colspan="2" class="latlon"></td>
                  </tr>
                </table>
                <div class="btn_area_01">
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("act", "map") ?>
                  <?php echo Form::hidden("shop_id", $shop->shop_id) ?>
                  <?php echo Form::hidden("page_type", "map") ?>
                  <?php echo Form::submit(NULL, "編集", array("id" => "", 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                  <button id="menu_booth" type="button">ブース</button>
                </div>
              </div>
            </div>
          </div>
          <div id="json" style="display: none"><?php echo $json?></div>
<?php else: ?>
          <?php if(Auth::auth_check(MODULE_NAME_SHOP, ACTION_INS)):?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::hidden("act", "map") ?>
            <?php echo Form::hidden("page_type", "map") ?>
            <?php echo Form::button(NULL, "新規登録", array("id" => "shop_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Name of facility</th>
              <th scope="col" class="th_width_long">Contract client name</th>
              <th scope="col" class="th_width_middle">Booths</th>
              <th scope="col" class="th_width_short">Number of terminals</th>
              <?php if(Auth::auth_check(MODULE_NAME_SHOP, ACTION_UP) || Auth::auth_check(MODULE_NAME_SHOP, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>
            
            <?php $i=1; foreach ($arr_shop as $shop): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($shop, "shop_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($shop, "client_name"))); ?></td>
              <td class="td_text_center">
                <?php if(!empty($shop->booth_cnt)): ?>
                  <?php echo(HTML::anchor("/" . MODULE_NAME_BOOTH, $shop->booth_cnt, array("id" => "shop_booth_" . $shop->shop_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>
              <td class="td_text_center">
                <?php if(!empty($shop->dev_cnt)): ?>
                  <?php echo(HTML::anchor("/" . MODULE_NAME_DEV, $shop->dev_cnt, array("id" => "shop_dev_" . $shop->shop_id), null, false))?><br />
                <?php else: ?>
                  0
                <?php endif ?>
              </td>

              <?php if(Auth::auth_check(MODULE_NAME_SHOP, ACTION_UP) || Auth::auth_check(MODULE_NAME_SHOP, ACTION_DEL)): ?>
              <td class="td_button_center">
                <?php if(Auth::auth_check(MODULE_NAME_SHOP, ACTION_UP)):?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("act", "map") ?>
                  <?php echo Form::hidden("page_type", "map") ?>
                  <?php echo Form::hidden("shop_id", $shop->shop_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "shop_up_" . $shop->shop_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
                <?php if(Auth::auth_check(MODULE_NAME_SHOP, ACTION_DEL)):?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("shop_id", $shop->shop_id) ?>
                  <?php echo Form::hidden("client_id", $shop->client_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "shop_del_" . $shop->shop_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          </div>
          <?php echo $pagination ?>
<?php endif; ?>
        </div>
      </div>
    </div>
    <!-- #/main --> 
