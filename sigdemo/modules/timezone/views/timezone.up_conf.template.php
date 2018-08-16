
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Distribution time type update</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Distribution time type update</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>朝</dt>
                <dd>
                  <?php echo Html::chars($post["sta_t-h_2"]) ?>
                  :
                  <?php echo Html::chars($post["sta_t-m_2"]) ?>
                   ～ 
                  <?php echo Html::chars($post["end_t-h_2"]) ?>
                  :
                  <?php echo Html::chars($post["end_t-m_2"]) ?>
                </dd>
                <dt>昼</dt>
                <dd>
                  <?php echo Html::chars($post["sta_t-h_3"]) ?>
                  :
                  <?php echo Html::chars($post["sta_t-m_3"]) ?>
                   ～ 
                  <?php echo Html::chars($post["end_t-h_3"]) ?>
                  :
                  <?php echo Html::chars($post["end_t-m_3"]) ?>
                </dd>
                <dt>夜</dt>
                <dd>
                  <?php echo Html::chars($post["sta_t-h_4"]) ?>
                  :
                  <?php echo Html::chars($post["sta_t-m_4"]) ?>
                   ～ 
                  <?php echo Html::chars($post["end_t-h_4"]) ?>
                  :
                  <?php echo Html::chars($post["end_t-m_4"]) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "booth_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "booth_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
