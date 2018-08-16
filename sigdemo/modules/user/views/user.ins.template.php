
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Administrator registration</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Administrator registration</h3>
        <div class="content">
          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Administrator type</dt>
                <dd>
                  <?php echo Form::select("auth_grp_id", $arr_all_auth_grp, HTML::replace_empty_array_value($post, "auth_grp_id"), array("id" => "user_ins_auth_grp_id", "required" => "true")) ?>
                </dd>
                <dt>Administrator name</dt>
                <dd>
                  <?php echo Form::input("user_name", HTML::replace_empty_array_value($post, "user_name"), array("id" => "user_ins_user_name", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※Within 20 characters
                </dd>
                <dt>Account (email address)</dt>
                <dd>
                  <?php echo Form::input("login_acnt", HTML::replace_empty_array_value($post, "login_acnt"), array("id" => "user_ins_login_acnt", "required" => "true", "maxlength" => "256", "class" => "input500")) ?>
                  ※Within 256 characters
                </dd>
                <dt>password</dt>
                <dd>
                  <?php echo Form::password("passwd", HTML::replace_empty_array_value($post ,"passwd"), array("id" => "user_ins_passwd", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※Within 20 characters
                </dd>
                <dt>password（For confirmation）</dt>
                <dd>
                  <?php echo Form::password("passwd_veri", HTML::replace_empty_array_value($post, "passwd_veri"), array("id" => "user_ins_passwd_veri", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※Within 20 characters
                </dd>
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client,  HTML::replace_empty_array_value($post, "client_id"), array("id" => "dev_ins_client_id", "required" => "true")) ?>
                </dd>
                <dt>State</dt>
                <dd>
                  <?php echo Form::select("invalid_flag", $arr_all_invalid_flag, HTML::replace_empty_array_value($post, "invalid_flag"), array("id" => "user_ins_invalid_flag", "required" => "true")) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_USER, "Return", array("id" => "user_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "user_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
