
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Booth update</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Booth update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("booth_id", $post["booth_id"]) ?>

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
                  <?php echo Html::chars($post["booth_name"]) ?>
                </dd>
                <dt>sex</dt>
                <dd>
                  <?php echo $arr_all_sex_id[$post["sex_id"]] ?>
                </dd>
                <dt>Utilization time</dt>
                <dd>
                  <?php if(isset($post["twentyfour_flg"]) && $post["twentyfour_flg"] === "1"): ?>
                    24hours
                  <?php else: ?>
                    <?php echo Html::chars($post["sta_t-h"]) ?>
                    :
                    <?php echo Html::chars($post["sta_t-m"]) ?>
                     ～
                    <?php echo Html::chars($post["end_t-h"]) ?>
                    :
                    <?php echo Html::chars($post["end_t-m"]) ?>
                  <?php endif ?>
                </dd>
                <dt>Wi-Fi SSID</dt>
                <dd>
                  <?php echo Html::chars($post["wifissid"]) ?>
                </dd>
                <dt>Wi-Fi password</dt>
                <dd>
                  <?php echo Html::chars($post["wifipass"]) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "booth_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation`", array("id" => "booth_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
