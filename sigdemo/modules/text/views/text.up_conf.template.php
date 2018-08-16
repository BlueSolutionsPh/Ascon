

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content setting 【Ticker update】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "text_up_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Ticker update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("text_id", $post["text_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Telop name</dt>
                <dd>
                  <?php echo Html::chars($post["text_name"]) ?>
                </dd>
                <dt>Ticker contents</dt>
                <dd>
                  <?php echo nl2br(Html::chars($post["text_msg"])) ?>
                </dd>
                <dt>expiration date</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?> ～ <?php echo Html::chars($post["end_dt"]) ?>
                </dd>
                <dt>tag</dt>
                <dd>
                  <?php if(isset($post["arr_tag"])){foreach ((array)$post["arr_tag"] as $tag): ?>
                    <?php echo $arr_all_tag[$tag] ?><br />
                  <?php endforeach;} ?>
                </dd>
                <dt>attribute</dt>
                <dd>
                  <?php if(isset($post["property_id"])) echo $arr_all_property[$post["property_id"]] ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "text_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "text_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
