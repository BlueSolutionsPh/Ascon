
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Booth update</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Booth update</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("booth_id", $post["booth_id"]) ?>
          <?php echo Form::hidden("prog_name", time()) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  $post["client_id"], array("id" => "booth_up_client_id", "required" => "true")) ?>
                </dd>
                <dt>Name of facility</dt>
                <dd>
                  <select id="booth_up_shop" name="shop">
<?php foreach ($arr_all_shop as $key => $shop):?>
                    <option value="<?php echo $key;?>" data-client_id="<?php echo $shop['client_id'];?>"<?php echo ($post['shop'] == $key) ? ' selected' : '';?>><?php echo $shop['shop_name'];?></option>
<?php endforeach;?>
                  </select>
                </dd>
                <dt>Installation floor</dt>
                <dd>
                  <?php echo Form::select("floor_id", $arr_all_floor, $post["floor_id"], array("id" => "booth_up_floor_id", "required" => "true")) ?>
                </dd>
                <dt>Booth name</dt>
                <dd>
                  <?php echo Form::input("booth_name", HTML::replace_empty_array_value($post, "booth_name"), array("id" => "booth_up_booth_name", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※ Within 20 characters
                </dd>
                <dt>sex</dt>
                <dd>
                  <?php echo Form::select("sex_id",    $arr_all_sex_id,    $post["sex_id"], array("id" => "booth_up_sex_id", "required" => "true")) ?>
                </dd>

                <dt>Utilization time</dt>
                <dd>
                  <div style="width:100px;margin:5px 0 5px 10px;float:left;">
                    <?php if($post["twentyfour_flg"] === 1): ?>
                      <?php echo Form::checkbox("twentyfour_flg", "1", (HTML::replace_empty_array_value($post, "twentyfour_flg") === "1"), array("id" => "booth_ins_twentyfour_flg", "checked" => "checked")) ?> <?php echo Form::label("twentyfour_flg", "24時間")?>
                    <?php else: ?>
                      <?php echo Form::checkbox("twentyfour_flg", "1", (HTML::replace_empty_array_value($post, "twentyfour_flg") === "1"), array("id" => "booth_ins_twentyfour_flg")) ?> <?php echo Form::label("twentyfour_flg", "24時間")?>
                    <?php endif ?>
                  </div>
                  <?php echo Form::select('sta_t-h', $map_list['time_h'], $post['sta_t-h'], array("id" => "sta_t-h")) ?>
                  :
                  <?php echo Form::select('sta_t-m', $map_list['time_m'], $post['sta_t-m'], array("id" => "sta_t-m")) ?>
                   ～
                  <?php echo Form::select('end_t-h', $map_list['time_h'], $post['end_t-h'], array("id" => "end_t-h")) ?>
                  :
                  <?php echo Form::select('end_t-m', $map_list['time_m'], $post['end_t-m'], array("id" => "end_t-m")) ?>
                </dd>
                <dt>Wi-Fi SSID</dt>
                <dd>
                  <?php echo Form::input("wifissid", HTML::replace_empty_array_value($post, "wifissid"), array("id" => "booth_up_wifissid", "maxlength" => "64", "class" => "input350")) ?>
                  ※ Within 64 characters
                </dd>
                <dt>Wi-Fi password</dt>
                <dd>
                  <?php echo Form::input("wifipass", HTML::replace_empty_array_value($post, "wifipass"), array("id" => "booth_up_wifipass", "maxlength" => "64", "class" => "input350")) ?>
                  ※ Within 64 characters
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_BOOTH, "Return", array("id" => "booth_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "booth_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
