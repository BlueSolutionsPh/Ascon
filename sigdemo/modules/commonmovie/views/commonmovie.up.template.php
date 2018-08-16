

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting [common video update]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commonmovie_up_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Common video update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("movie_id", $post["movie_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Movie name</dt>
                <dd>
                  <?php echo Form::input("movie_name", $post["movie_name"], array("id" => "commonmovie_up_movie_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>
                  ※ Within 60 characters
                </dd>

                <?php if(isset($post["movie_orig_file_name"]) && $post["movie_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Movie file") ?></dt>
                  <dd>
                    <?php echo Form::label("movie_file", $post["movie_orig_file_name"] . $post["movie_orig_file_exte"]) ?>
                  </dd>
                  <dd style="display:none;">
                    <?php echo Form::checkbox("rotate_flag", "1", (HTML::replace_empty_array_value($post, "rotate_flag") === "1"), array("id" => "rotate_flag")) ?> <?php echo Form::label("rotate_flag", "For vertical display")?>
                  </dd>
                <?php endif ?>
                <?php if(isset($post["sound_orig_file_name"]) && $post["sound_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Audio file") ?></dt>
                  <dd><?php echo Form::label("movie_file", $post["sound_orig_file_name"] . $post["sound_orig_file_exte"]) ?></dd>
                <?php endif ?>
                <dt>Playback time</dt>
                <dd>
                  <?php echo Form::select('play_time-m', $map_list['play_time-m'], $post['play_time-m'], array("id" => "commonmovie_up_play_time-m")) ?>
                  :
                  <?php echo Form::select('play_time-s', $map_list['play_time-s'], $post['play_time-s'], array("id" => "commonmovie_up_play_time-s")) ?>
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", HTML::fix_dt_str($post["sta_dt"]), array("id" => "commonmovie_up_sta_dt", "class" => "input125 datetime", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?> ～ <?php echo Form::input("end_dt", HTML::fix_dt_str($post["end_dt"]), array("id" => "commonmovie_up_end_dt", "class" => "input125 datetime_end", "maxlength" => "16", 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_COMMONMOVIE, "Return", array("id" => "commonmovie_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "commonmovie_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
