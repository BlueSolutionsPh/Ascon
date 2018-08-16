
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Client-specific playlist update</div>
        </div>
      </div>
    </div>

    <div id="main">
      <div class="box_01">
        <h3 class="title">Client-specific playlist update</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up", array("id" => "act")) ?>
          <?php echo Form::hidden("playlist_id", $post["playlist_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Playlist name</dt>
                <dd>
                  <?php echo Html::chars($post["playlist_name"]) ?>
                </dd>
                <dt>Registered content</dt>
                <dd>
<?php foreach ($arr_sex as $i => $sex_id): ?>
<?php foreach ($arr_time_zone as $y => $timezone_id): ?>
                  <?php echo $arr_sex[$i] ?>：<?php echo $arr_time_zone[$y] ?><br />
<?php foreach (${'arr_movie' . $i . $y} as $movie_id): ?>
                    <?php echo Html::chars($arr_all_movie[$movie_id]['movie_name']) ?><br />
<?php endforeach; ?>
                    <div class="hr_wrapper_03"></div>
                  <br />
<?php endforeach; ?>
<?php endforeach; ?>
                </dd>
                <dt>Contract client name</dt>
                <dd>
                  <?php echo $arr_all_client[$post["client_id"]] ?>
                </dd>
                <dt>Delivery month</dt>
                <dd>
                  <?php echo $arr_delivery_month[$post["deliverymonth_id"]] ?>
                </dd>
                <dt>Delivery period</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?> ～ <?php echo Html::chars($post["end_dt"]) ?>
                </dd>
            </dl>
          </div>

          <div class="text_01">Confirm the above contents and press "confirm" button</div>
          <div class="btn_area_02">
            <?php echo Form::button(NULL, "Return", array("id" => "playlist_up_conf_back", 'class'=>'btn1 btn_l')) ?>
            <?php echo Form::button(NULL, "Confirmation", array("id" => "playlist_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
        <?php echo Form::close() ?>
        <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
