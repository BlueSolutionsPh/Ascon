
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Device registration</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Device registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo $arr_all_client[$post["client_id"]] ?>
                </dd>
                <dt>Name of facility</dt>
                <dd>
                  <?php echo $arr_all_shop[$post["shop"]]["shop_name"] ?>
                </dd>
                <dt>Installation floor</dt>
                <dd>
                  <?php echo $arr_all_floor[$post["floor_id"]] ?>
                </dd>
                <dt>Booth name</dt>
                <dd>
                  <?php echo $arr_all_booth[$post["booth_id"]]["booth_name"] ?>
                </dd>
                <dt>sex</dt>
                <dd>
                  <?php echo $arr_all_sex_id[$post["sex_id"]] ?>
                </dd>
                <dt>Serial number</dt>
                <dd>
                  <?php echo Html::chars($post["serial_no"]) ?>
                </dd>
                <dt>Terminal type</dt>
                <dd>
                  <?php echo $arr_all_unit_flag[$post["unit_flag"]] ?>
                </dd>
                <dt>State</dt>
                <dd>
                  <?php echo $arr_all_invalid_flag[$post["invalid_flag"]] ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "dev_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "dev_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
