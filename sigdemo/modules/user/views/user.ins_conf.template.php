
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Administrator registration</div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="box_01">
        <h3 class="title">Administrator registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Administrator type</dt>
                <dd>
                  <?php echo $arr_all_auth_grp[$post["auth_grp_id"]] ?>
                </dd>
                <dt>Administrator name</dt>
                <dd>
                  <?php echo Html::chars($post["user_name"]) ?>
                </dd>
                <dt>Account (email address)</dt>
                <dd>
                  <?php echo Html::chars($post["login_acnt"]) ?>
                </dd>
                <dt>password</dt>
                <dd>
                  <?php echo Html::chars($post["passwd"]) ?>
                </dd>
                <dt>For password confirmation)</dt>
                <dd>
                  <?php echo Html::chars($post["passwd_veri"]) ?>
                </dd>
                <dt>Contract client name</dt>
                <dd>
                  <?php echo $arr_all_client[$post["client_id"]] ?>
                </dd>
                <dt>State</dt>
                <dd>
                  <?php echo $arr_all_invalid_flag[$post["invalid_flag"]] ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "user_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>"$('input[name=act]').val('back')")) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "user_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
