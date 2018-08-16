

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Contract client update</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Contract client update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("client_id", $post["client_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>client name</dt>
                <dd>
                  <?php echo Html::chars($post["client_name"]) ?>
                </dd>
                <dt>Content file size total maximum value (GB)</dt>
                <dd>
                  <?php echo Html::chars($post["max_total_cts_file_size"]) ?>
                </dd>
                <dt>Remarks</dt>
                <dd>
                  <?php echo nl2br(Html::chars($post["note"])) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "client_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "client_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
