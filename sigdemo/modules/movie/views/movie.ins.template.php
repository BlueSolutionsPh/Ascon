
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Movie registration</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Movie registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">

                <dt>Movie title name</dt>
                <dd>
                  <?php echo Form::input("movie_name", HTML::replace_empty_array_value($post, "movie_name"), array("id" => "movie_ins_movie_name", "required" => "true", "maxlength" => "60", "class" => "input350")) ?>※ Within 60 characters
                </dd>

                <dt>Movie file selection</dt>
                <dd>
                  <?php echo Form::file("movie_file", array("id" => "movie_ins_movie_file", "required" => "true", "size" => "50")) ?>
                  ※Registable extension(
                  <?php echo View::get_movie_exte() ?>
                  )
                </dd>
<!--
                <dt>Select telop file</dt>
                <dd>
                  <?php echo Form::file("image_file", array("id" => "movie_ins_image_file", "size" => "50")) ?>
                  ※Registable extension(
                  <?php echo View::get_image_exte() ?>
                  )
                </dd>
-->
                <dt>Advertisement type</dt>
                <dd>
                  <?php echo Form::select("ad_flag", $arr_all_ad,  HTML::replace_empty_array_value($post, "ad_flag"), array("id" => "movie_ins_ad_flag", "required" => "true")) ?>
                </dd>

                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "movie_ins_client_id", "required" => "true")) ?>
                </dd>

                <dt>Validity period</dt>
                <dd>
                  <?php echo Form::input("sta_dt", $post["sta_dt"], array("id" => "movie_ins_sta_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                    ～
                  <?php echo Form::input("end_dt", $post["end_dt"], array("id" => "movie_ins_end_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                </dd>

                <dt>Movie tag</dt>
                <dd>
                  <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "movie_ins_arr_tag", "multiple" => "multiple")) ?>
                </dd>

              </dl>

            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_MOVIE, "Return", array("id" => "movie_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "movie_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
