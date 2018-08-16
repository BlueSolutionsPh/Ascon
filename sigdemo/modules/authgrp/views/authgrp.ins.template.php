
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Administrator type registration</div>
        </div>
      </div>
    </div>
    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Administrator type registration</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Authority name</dt>
                <dd>
                  <?php echo Form::input("auth_grp_name", HTML::replace_empty_array_value($post, "auth_grp_name"), array("id" => "authgrp_ins_auth_grp_name", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※ Within 20 characters
                </dd>

                <dt>Authority management</dt>
                <dd>
                  <div style="margin:5px;"><?php echo Form::button("btn_all", "全チェック", array("id" => "authgrp_ins_btn_all", "type" => "button", "class" => "btn6", "onclick" => "func_chk_all_btn(this)")) ?></div>
                  <?php foreach($arr_module_cat as $module_cat => $arr_module_cat_child): ?>
                    <div style="margin:5px; padding:5px; border-top:1px solid;">
                      <div style="margin:5px;font-weight:bold;"><?php echo Controller_Template::$arr_module_cat_disp_name_map[$module_cat] ?></div>
                      <?php $i = 0 ?>
                      <?php foreach($arr_module_cat_child as $module_cat_child => $arr_module): ?>
                        <?php if($i > 0): ?><br /><?php endif ?>
                          <?php foreach($arr_module as $module): ?>
                            <div style="margin:5px 10px 5px 15px; padding-right:10px;">
                              <div style="float:left"><?php echo Form::button("btn_" . $module["module"], $module["module_name"], array("id" => "authgrp_ins_btn_" . $module["module"], "type" => "button", "style" => "width:170px;margin-right:10px;", "class" => "btn6", "onclick" => "func_chk_btn(this)")) ?></div>
                              <?php $j = 1 ?>
                              <?php foreach($module["arr_auth"] as $auth): ?>
                                <?php while($j < $auth["display_order"]): ?>
                                  <div style="width:100px;margin:5px 0 5px 10px;float:left;"></div>
                                  <?php $j++ ?>
                                <?php endwhile ?>
                                <div style="width:100px;margin:5px 0 5px 10px;float:left;">
                                  <?php echo Form::checkbox("arr_auth[]", $auth["auth_id"], in_array($auth["auth_id"], HTML::replace_empty_array_value($post, "arr_auth", array())), array("id" => "authgrp_ins_auth_" . $auth["auth_id"])) ?>
                                  <?php echo Form::label("auth_" . $auth["auth_id"], $auth["auth_name"]) ?>
                                </div>
                               <?php $j++ ?>
                              <?php endforeach ?>
                              <div class="clear"></div>
                            </div>
                          <?php endforeach ?>
                        <?php $i++ ?>
                      <?php endforeach ?>
                    </div>
                  <?php endforeach ?>
                  <div class="clear"></div>
                </dd>
              </dl>
            </div>

            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_AUTHGRP, "Return", array("id" => "authgrp_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "authgrp_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
