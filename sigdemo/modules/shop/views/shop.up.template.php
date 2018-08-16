
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Store update</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Store update</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("shop_id", $post["shop_id"]) ?>
          <?php echo Form::hidden("client_id", $post["client_id"]) ?>
          <?php echo Form::hidden("prog_name", time()) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  $post["client_id"], array("id" => "shop_up_client_id", "required" => "true")) ?>
                </dd>
                <dt>Store name</dt>
                <dd>
                  <?php echo Form::input("shop_name", $post["shop_name"], array("id" => "shop_up_shop_name", "required" => "true", "maxlength" => "60", "class" => "input350")) ?>
                  ※Within 60 characters
                </dd>
                <!-- <dt>Signage start time<span class="popup_help" data&#45;message="When operating for 24 hours, please set it at the same time as the start and end">[?]</span></dt> -->
                <!-- <dd> -->
                <!--   <?php echo Form::select('sta_t&#45;h', $map_list['time_h'], $post['sta_t&#45;h'], array("id" => "sta_t&#45;h")) ?> -->
                <!--   : -->
                <!--   <?php echo Form::select('sta_t&#45;m', $map_list['time_m'], $post['sta_t&#45;m'], array("id" => "sta_t&#45;m")) ?> -->
                <!-- </dd> -->
                <!-- <dt>Signage end time<span class="popup_help" data&#45;message="When operating for 24 hours, please set it at the same time as the start and end">[?]</span></dt> -->
                <!-- <dd> -->
                <!--   <?php echo Form::select('end_t&#45;h', $map_list['time_h'], $post['end_t&#45;h'], array("id" => "end_t&#45;h")) ?> -->
                <!--   : -->
                <!--   <?php echo Form::select('end_t&#45;m', $map_list['time_m'], $post['end_t&#45;m'], array("id" => "end_t&#45;m")) ?> -->
                <!-- </dd> -->
                <!-- <dt>Remarks</dt> -->
                <!-- <dd> -->
                <!--   <?php echo Form::textarea("note", $post["note"], array("id" => "shop_up_note", "required" => "true", "maxlength" => "500", "class" => "input500")) ?> -->
                <!--   ※500 character limit -->
                <!-- </dd> -->
                <!-- <dt>tag</dt> -->
                <!-- <dd> -->
                <!--   <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "shop_up_arr_tag", "multiple" => "multiple")) ?> -->
                <!-- </dd> -->
                <dt>Postal code</dt>
                <dd>
                  <?php echo Form::input("post", $post["post"], array("id" => "shop_up_post", "required" => "true", "maxlength" => "10", "class" => "input250")) ?>
                  <button id="search-up_post" type="button">Automatic search</button>
                </dd>
                <dt>Street address</dt>
                <dd>
                  <?php echo Form::input("address", $post["address"], array("id" => "shop_up_address", "required" => "true", "maxlength" => "256", "class" => "input500")) ?>
                  ※Within 256 characters
                </dd>
                <dt>longitude・latitude</dt>
                <dd>
                  <?php echo Form::input("lat", $post["lat"], array("id" => "shop_up_lat", "required" => "true", "maxlength" => "20" )) ?>
                  <?php echo Form::input("lon", $post["lon"], array("id" => "shop_up_lon", "required" => "true", "maxlength" => "20" )) ?>
                </dd>
              </dl>
              <div id="map" style="height: 300px; width: 50%;"></div>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_SHOP, "Return", array("id" => "shop_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "shop_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div id="json" style="display: none;"><?php echo $json?></div>
    <!-- #/main --> 
