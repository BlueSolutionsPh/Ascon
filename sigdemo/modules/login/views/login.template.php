
    <div class="top_title login">
      <div class="top_title_wrapper">
        <div class="top_title_inner">Login</div>
      </div>
    </div>
    <div id="main">
        <div class="content">
          <?php if(!empty($login_ng)): ?>
            <div class="loginError">I failed to login</div>
          <?php endif ?>
          <?php echo Form::open() ?>
            <dl class="dl_login clearfix">
              <dd>
                <label for="login_user">Login ID</label><?php echo Form::input("user", $post["user"], array("id" => "login_user", "maxlength" => "20", "class" => "input350")) ?>
              </dd>
              <dd>
                <label for="login_pass">password</label><?php echo Form::password("pass", $post["pass"], array("id" => "login_pass", "maxlength" => "20", "class" => "input350")) ?>
              </dd>
            </dl>
            <div class="btn_area_03">
              <?php echo Form::button(NULL, "Login", array("id" => "login_submit", "type" => "submit", 'class'=>'btn1')) ?>
            </div>
           </div>
          <?php echo Form::close() ?>
        </div>

    </div>
    <!-- #/main -->
