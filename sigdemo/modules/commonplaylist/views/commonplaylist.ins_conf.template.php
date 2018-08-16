
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Register common playlist</div>
        </div>
      </div>
    </div>

    <div id="main">
      <div class="box_01">
        <h3 class="title">Register common playlist</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Common playlist name</dt>
                <dd>
                  <?php echo Html::chars($post["playlist_name"]) ?>
                </dd>
                <dt>Registered content</dt>
                <dd>
                    <?php foreach($arr_movie as $movie_id): ?>
                        <?php echo Html::chars($arr_all_movie[$movie_id]['movie_name']) ?><br />
                    <?php endforeach; ?>
                </dd>

                <dt>sex</dt>
                <dd>
                  <?php echo $arr_sex[$post["sex_id"]] ?>
                </dd>
                <dt>Delivery time zone</dt>
                <dd>
                  <?php echo $arr_time_zone[$post["timezone_id"]] ?>
                </dd>
                <dt>Delivery month</dt>
                <dd>
                  <?php echo $arr_delivery_month[$post["deliverymonth_id"]] ?>
                </dd>
                <dt>Delivery period</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?>
                     ～
                  <?php echo Html::chars($post["end_dt"]) ?>
                </dd>
            </dl>
          </div>

          <div class="text_01">Confirm the above contents and press "confirm" button</div>
          <div class="btn_area_02">
            <?php echo Form::button(NULL, "Return", array("id" => "commonplaylist_ins_conf_back", "onclick" => "func_back2()", 'class'=>'btn1 btn_l')) ?>
            <?php echo Form::button(NULL, "Confirmation", array("id" => "commonplaylist_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
        <?php echo Form::close() ?>
        <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
