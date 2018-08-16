
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Facility update</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Facility update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("shop_id", $post["shop_id"]) ?>
          <?php echo Form::hidden("client_id", $post["client_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Contract client name</dt>
                <dd>
                  <?php echo $arr_all_client[$post["client_id"]] ?>
                </dd>
                <dt>Name of facility</dt>
                <dd>
                  <?php echo Html::chars($post["shop_name"]) ?>
                </dd>
                <!-- <dt>Signage start time</dt> -->
                <!-- <dd> -->
                <!--   <?php echo Html::chars($post["sta_t&#45;h"]) ?> -->
                <!--   : -->
                <!--   <?php echo Html::chars($post["sta_t&#45;m"]) ?> -->
                <!-- </dd> -->
                <!-- <dt>Signage end time</dt> -->
                <!-- <dd> -->
                <!--   <?php echo Html::chars($post["end_t&#45;h"]) ?> -->
                <!--   : -->
                <!--   <?php echo Html::chars($post["end_t&#45;m"]) ?> -->
                <!-- </dd> -->
                <!-- <dt>Remarks</dt> -->
                <!-- <dd> -->
                <!--   <?php echo nl2br(Html::chars($post["note"])) ?> -->
                <!-- </dd> -->
                <!-- <dt>tag</dt> -->
                <!-- <dd> -->
                <!--   <?php if(isset($post["arr_tag"])){foreach ((array)$post["arr_tag"] as $tag): ?> -->
                <!--     <?php echo $arr_all_tag[$tag] ?><br /> -->
                <!--   <?php endforeach;} ?> -->
                <!-- </dd> -->
                <dt>Postal code</dt>
                <dd>
                  <?php echo Html::chars($post["post"]) ?>
                </dd>
                <dt>Street address</dt>
                <dd>
                  <?php echo Html::chars($post["address"]) ?>
                </dd>
                <dt>longitude latitude</dt>
                <dd>
                  <?php echo Html::chars($post["lat"]) ?>／
                  <?php echo Html::chars($post["lon"]) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "shop_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "shop_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
