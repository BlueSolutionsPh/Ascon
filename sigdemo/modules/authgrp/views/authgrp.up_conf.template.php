
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Maintain administrator type</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Maintain administrator type</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "up") ?>
          <?php echo Form::hidden("auth_grp_id", $post["auth_grp_id"]) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Authority name</dt>
                <dd>
                  <div style="margin:10px;">
                    <?php echo Html::chars($post["auth_grp_name"]) ?>
                  </div>
                </dd>
                <dt>Permission content</dt>
                <dd>
                  <div>
                    <?php foreach($arr_module as $module): ?>
                      <div style="margin:10px;">
                      <?php $i = 0 ?>
                      <?php foreach($module["arr_auth"] as $auth): ?>
                        <?php if(!empty($post["arr_auth"]) && in_array($auth["auth_id"], $post["arr_auth"])): ?>
                          <?php if($i === 0): ?>
                            <?php echo $module["module_name"] ?><br />
                          <?php endif?>
                          <?php $i++ ?>
	                      <?php echo  "・" . $auth["auth_name"] ?><br />
                        <?php endif?>
                      <?php endforeach ?>
                      </div>
                    <?php endforeach ?>
                    <div class="clear"></div>
                  </div>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "authgrp_up_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "authgrp_up_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
