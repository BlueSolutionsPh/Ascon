

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting [common video update]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commonmovie_up_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Common video update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("movie_id", $post["movie_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Movie name</dt>
                <dd>
                  <?php echo Html::chars($post["movie_name"]) ?>
                </dd>

                <?php if(isset($post["movie_orig_file_name"]) && $post["movie_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Movie file") ?></dt>
                  <dd>
                    <?php echo Form::label("movie_file", $post["movie_orig_file_name"] . $post["movie_orig_file_exte"]) ?>
                    <?php if(isset($post["rotate_flag"]) && $post["rotate_flag"] === "1"): ?>(For vertical display)<?php endif ?>
                  </dd>
                <?php endif ?>
                <?php if(isset($post["sound_orig_file_name"]) && $post["sound_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Audio file") ?></dt>
                  <dd><?php echo Form::label("movie_file", $post["sound_orig_file_name"] . $post["sound_orig_file_exte"]) ?></dd>
                <?php endif ?>

                <dt>Playback time</dt>
                <dd>
                  <?php echo Html::chars($post["play_time-m"]) ?>
                  :
                  <?php echo Html::chars($post["play_time-s"]) ?>
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?> ～ <?php echo Html::chars($post["end_dt"]) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "commonmovie_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "commonmovie_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
