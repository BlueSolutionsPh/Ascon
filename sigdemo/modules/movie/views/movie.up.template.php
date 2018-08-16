

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Update movie</div>
         </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Update movie</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>
          <?php echo Form::hidden("movie_id", $post["movie_id"]) ?>
          <?php echo Form::hidden("image_id", $post["image_id"]) ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">
                <dt>Movie title name</dt>
                <dd>
                  <?php echo Form::input("movie_name", $post["movie_name"], array("id" => "movie_up_movie_name", "required" => "true", "maxlength" => "60", "class" => "input350")) ?>※ Within 60 characters
                </dd>

                <?php if(isset($post["movie_orig_file_name"]) && $post["movie_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Movie file") ?></dt>
                  <dd><?php echo Form::label("movie_file", $post["movie_orig_file_name"] . $post["movie_orig_file_exte"]) ?></dd>
                <?php endif ?>

                <?php if(isset($post["sound_orig_file_name"]) && $post["sound_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("movie_file", "Audio file") ?></dt>
                  <dd><?php echo Form::label("movie_file", $post["sound_orig_file_name"] . $post["sound_orig_file_exte"]) ?></dd>
                <?php endif ?>

                <?php if(isset($post["image_orig_file_name"]) && $post["image_orig_file_name"] !== ""): ?>
                  <dt><?php echo Form::label("image_file", "Telop file") ?></dt>
                  <dd><?php echo Form::label("image_file", $post["image_orig_file_name"] . $post["image_orig_file_exte"]) ?></dd>
                <?php endif ?>

                <dt>Advertisement type</dt>
                <dd>
                  <?php echo Form::select("ad_flag", $arr_all_ad,  $post["ad_flag"], array("id" => "movie_up_ad_flag", "required" => "true")) ?>
                </dd>

                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  $post["client_id"], array("id" => "movie_up_client_id", "required" => "true")) ?>
                </dd>

                <dt>expiration date</dt>
                <dd>
                  <?php echo Form::input("sta_dt", substr($post["sta_dt"],0,10), array("id" => "movie_up_sta_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                    ～
                  <?php echo Form::input("end_dt", substr($post["end_dt"],0,10), array("id" => "movie_up_end_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                </dd>
                <dt>Movie tag</dt>
                <dd>
                  <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "movie_up_arr_tag", "multiple" => "multiple")) ?>
                </dd>

              </dl>

            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_MOVIE, "Return", array("id" => "movie_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "movie_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
