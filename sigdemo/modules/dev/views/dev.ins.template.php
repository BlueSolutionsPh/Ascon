

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Device registration</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Device registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("prog_name", time()) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  HTML::replace_empty_array_value($post, "client_id"), array("id" => "dev_ins_client_id", "required" => "true")) ?>
                </dd>
                <dt>Name of facility</dt>
                <dd>
                  <select id="dev_ins_shop" name="shop">
<?php foreach ($arr_all_shop as $key => $shop):?>
                    <option value="<?php echo $key;?>" data-client_id="<?php echo $shop['client_id'];?>"<?php echo ($post['shop'] == $key) ? ' selected' : '';?>><?php echo $shop['shop_name'];?></option>
<?php endforeach;?>
                  </select>
                </dd>
                <dt>Installation floor</dt>
                <dd>
                  <?php echo Form::select("floor_id",    $arr_all_floor,  HTML::replace_empty_array_value($post, "floor_id"), array("id" => "dev_ins_floor_id", "required" => "true")) ?>
                </dd>
                <dt>Booth name</dt>
                <dd>
                  <select id="dev_ins_booth_id" name="booth_id">
<?php foreach ($arr_all_booth as $key => $booth):?>
                    <option value="<?php echo $key;?>" data-shop_id="<?php echo $booth['shop_id'];?>" data-floor_id="<?php echo $booth['floor_id'];?>" data-sex_id="<?php echo $booth['sex_id'];?>"<?php echo ($post['booth_id'] == $key) ? ' selected' : '';?>><?php echo $booth['booth_name'];?></option>
<?php endforeach;?>
                  </select>
                </dd>
                <dt>sex</dt>
                <dd>
                  <?php echo Form::select("sex_id",   $arr_all_sex_id,  HTML::replace_empty_array_value($post, "sex_id"),   array("id" => "dev_ins_sex_id",   "required" => "true")) ?>
                </dd>
                <dt>Serial number</dt>
                <dd>
                  <?php echo Form::input("serial_no", HTML::replace_empty_array_value($post, "serial_no"), array("id" => "dev_ins_serial_no", "required" => "true", "maxlength" => "20", "size" => "50", "class" => "input250")) ?>
                </dd>
                <dt>Terminal type</dt>
                <dd>
                  <?php echo Form::select("unit_flag", $arr_all_unit_flag,  HTML::replace_empty_array_value($post, "unit_flag"),array("id" => "dev_ins_unit_flag",    "required" => "true")) ?>
                </dd>
                <dt>State</dt>
                <dd>
                  <?php echo Form::select("invalid_flag", $arr_all_invalid_flag, HTML::replace_empty_array_value($post, "invalid_flag"), array("id" => "dev_ins_invalid_flag", "required" => "true")) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_DEV, "Return", array("id" => "dev_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "dev_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
