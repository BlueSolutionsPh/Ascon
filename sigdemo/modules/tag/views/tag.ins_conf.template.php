
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Tag registration</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "tag_ins_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Tag registration</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Tag name</dt>
                <dd>
                  <?php echo Html::chars($post["tag_name"]) ?>
                </dd>
                <dt>Tag classification</dt>
                <dd>
                  <?php echo $arr_all_tag_cat[$post["tag_cat_id"]] ?><br />
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "tag_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "tag_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
