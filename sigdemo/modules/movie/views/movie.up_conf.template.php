

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Update movie</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Update movie</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("movie_id", $post["movie_id"]) ?>
          <?php echo Form::hidden("image_id", $post["image_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Movie title name</dt>
                <dd>
                  <?php echo Html::chars($post["movie_name"]) ?>
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
                  <?php echo $arr_all_ad[$post["ad_flag"]] ?>
                </dd>

                <dt>Contract client name</dt>
                <dd>
                  <?php echo $arr_all_client[$post["client_id"]] ?>
                </dd>

                <dt>expiration date</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?> ～ <?php echo Html::chars($post["end_dt"]) ?>
                </dd>

                <dt>Movie tag</dt>
                <dd>
                  <?php if(isset($post["arr_tag"])){foreach ((array)$post["arr_tag"] as $tag): ?>
                    <?php echo $arr_all_tag[$tag] ?><br />
                  <?php endforeach;} ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "movie_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "movie_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
