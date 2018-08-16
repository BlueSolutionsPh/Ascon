
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Batch sound registration】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "メニューへ", array("id" => "movie_ins_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Batch bulk registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
              <?php foreach ($post["sound_orig_file_name"] as $i => $cts): ?>
                <?php $i = 0; ?>
                <dt>Movie name</dt>
                <dd>
                  <?php echo Html::chars($cts) ?>
                </dd>
                <?php $i++; ?>
              <?php endforeach ?>
                <dt>tag　※The same tag is added to everything</dt>
                <dd>
                  <?php if(isset($post["arr_tag"])){foreach ((array)$post["arr_tag"] as $tag): ?>
                    <?php echo $arr_all_tag[$tag] ?><br />
                  <?php endforeach;} ?>
                </dd>
                <dt>attribute　※The same attribute is added to everything</dt>
                <dd>
                  <?php if(isset($post["property_id"])) echo $arr_all_property[$post["property_id"]] ?>
                </dd>

              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "movie_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "movie_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
