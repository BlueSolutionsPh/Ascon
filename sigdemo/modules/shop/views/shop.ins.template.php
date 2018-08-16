
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Facility registration</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Facility registration</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <!--<?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>-->
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("client_id", $post["client_id"]) ?>
                  
            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  $post["client_id"], array("id" => "shop_ins_client_id", "required" => "true")) ?>
                </dd>
                <dt>Name of facility</dt>
                <dd>
                  <?php echo Form::input("shop_name", HTML::replace_empty_array_value($post, "shop_name"), array("id" => "shop_ins_shop_name", "required" => "true", "maxlength" => "60", "class" => "input350")) ?>
                  ※Within 60 characters
                </dd>

                <dt>Postal code</dt>
                <dd>
                  <?php echo Form::input("post", $post["post"], array("id" => "shop_ins_post", "required" => "true", "maxlength" => "10", "class" => "input250")) ?>
                  <button id="search-ins_post" type="button">Automatic search</button>
                </dd>
                <dt>Street address</dt>
                <dd>
                  <?php echo Form::input("address", $post["address"], array("id" => "shop_ins_address", "required" => "true", "maxlength" => "256", "class" => "input500")) ?>
                  ※Within 256 characters
                </dd>
                <dt>longitude・latitude</dt>
                <dd>
                  <?php echo Form::input("lat", $post["lat"], array("id" => "shop_ins_lat", "required" => "true", "maxlength" => "20")) ?>／
                  <?php echo Form::input("lon", $post["lon"], array("id" => "shop_ins_lon", "required" => "true", "maxlength" => "20")) ?>
                </dd>
              </dl>
              <div id="map" style="height: 300px; width: 50%;"></div>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_SHOP, "Return", array("id" => "shop_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "shop_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div id="json" style="display: none;"><?php echo $json?></div>
    <!-- #/main --> 
