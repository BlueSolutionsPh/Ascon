
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Batch sound registration】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "メニューへ", array("id" => "movie_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Batch bulk registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">
                <dt>File　　※Registable extension(<?php echo View::get_sound_exte() ?>) </dt>
                <dd>
                  <?php echo Form::file("arr_sound_file[]", array("id" => "soundall_ins_sound_file", "required" => "true", "size" => "50", "multiple" => "multiple", "onchange" => "handleFiles(this.file)")) ?>
                </dd>
                <dt>tag</dt>
                <dd>
                  <?php echo Form::select("arr_tag[]", $arr_all_tag, HTML::replace_empty_array_value($post, "arr_tag", array()), array("id" => "movie_ins_arr_tag", "multiple" => "multiple")) ?>
                </dd>
                <div id="disp" ></div>
              </dl>
              <dl class="dl_input_02" style="float:left;">
                <dt>attribute</dt>
                <dd>
                  <?php echo Form::select("property_id", $arr_all_property, HTML::replace_empty_array_value($post, "property_id", array()), array("id" => "movie_ins_property", "size"=>count($arr_all_property) )) ?>
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
