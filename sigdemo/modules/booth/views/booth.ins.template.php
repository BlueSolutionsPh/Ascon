
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Booth registration</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Booth registration</h3>
        <div class="content">
          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  HTML::replace_empty_array_value($post, "client_id"), array("id" => "booth_ins_client_id", "required" => "true")) ?>
                <dd>
                <dt>Name of facility</dt>
                <dd>
                  <select id="booth_ins_shop" name="shop">
<?php foreach ($arr_all_shop as $key => $shop):?>
                    <option value="<?php echo $key;?>" data-client_id="<?php echo $shop['client_id'];?>"<?php echo ($post['shop'] == $key) ? ' selected' : '';?>><?php echo $shop['shop_name'];?></option>
<?php endforeach;?>
                  </select>
                <dd>
                <dt>Installation floor</dt>
                <dd>
                  <?php echo Form::select("floor_id",    $arr_all_floor,  HTML::replace_empty_array_value($post, "floor_id"), array("id" => "booth_ins_floor_id", "required" => "true")) ?>
                </dd>
                <dt>Booth name</dt>
                <dd>
                  <?php echo Form::input("booth_name", HTML::replace_empty_array_value($post, "booth_name"), array("id" => "booth_ins_booth_name", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※ Within 20 characters
                </dd>
                <dt>sex</dt>
                <dd>
                  <?php echo Form::select("sex_id",   $arr_all_sex_id,  HTML::replace_empty_array_value($post, "sex_id"),   array("id" => "booth_ins_sex_id",   "required" => "true")) ?>
                </dd>
                <dt>Utilization time</dt>
                <dd>
                  <div style="width:100px;margin:5px 0 5px 10px;float:left;">
                    <?php echo Form::checkbox("twentyfour_flg", "1", (HTML::replace_empty_array_value($post, "twentyfour_flg") === "1"), array("id" => "booth_ins_twentyfour_flg")) ?> <?php echo Form::label("twentyfour_flg", "24時間")?>
                  </div>
                  <?php echo Form::select('sta_t-h', $map_list['time_h'], HTML::replace_empty_array_value($post, 'sta_t-h'), array("id" => "sta_t-h")) ?>
                  :
                  <?php echo Form::select('sta_t-m', $map_list['time_m'], HTML::replace_empty_array_value($post, 'sta_t-m'), array("id" => "sta_t-m")) ?>
                   ～
                  <?php echo Form::select('end_t-h', $map_list['time_h'], HTML::replace_empty_array_value($post, 'end_t-h'), array("id" => "end_t-h")) ?>
                  :
                  <?php echo Form::select('end_t-m', $map_list['time_m'], HTML::replace_empty_array_value($post, 'end_t-m'), array("id" => "end_t-m")) ?>
                </dd>
                <dt>Wi-Fi SSID</dt>
                <dd>
                  <?php echo Form::input("wifissid", HTML::replace_empty_array_value($post, "wifissid"), array("id" => "booth_ins_wifissid", "maxlength" => "64", "class" => "input350")) ?>
                  ※ Within 64 characters
                </dd>
                <dt>Wi-Fi パスワード</dt>
                <dd>
                  <?php echo Form::input("wifipass", HTML::replace_empty_array_value($post, "wifipass"), array("id" => "booth_ins_wifipass", "maxlength" => "64", "class" => "input350")) ?>
                  ※ Within 64 characters
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_BOOTH, "Return", array("id" => "booth_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "booth_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
