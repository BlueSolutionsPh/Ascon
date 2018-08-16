
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Administrator list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Administrator list</h3>
        <div class="content">
          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "user_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Administrator type</td><td><?php echo Form::select("auth_grp_id", $arr_all_auth_grp, HTML::replace_empty_array_value($post, "auth_grp_id"), array("id" => "user_auth_grp_id")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "user_search", "type" => "submit", 'class'=>'btn3')) ?></td>
                </tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_USER, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "user_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:400px; overflow-y:scroll;">
          <table  class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Administrator name</th>
              <th scope="col" class="th_width_long">Account (email address)</th>
              <th scope="col" class="th_width_middle">Administrator type</th>
              <th scope="col" class="th_width_short">State</th>
              <?php if(Auth::auth_check(MODULE_NAME_USER, ACTION_UP) || Auth::auth_check(MODULE_NAME_USER, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>
            
            <?php $i=1; foreach ($arr_user as $user): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($user, "user_name"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($user, "login_acnt"))); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($user, "auth_grp_name"))); ?></td>
              <td class="td_text_center"><?php if($user->invalid_flag === 1): ?>Disabled<?php else: ?>Effectiveness<?php endif ?></td>
              <?php if(Auth::auth_check(MODULE_NAME_USER, ACTION_UP) || Auth::auth_check(MODULE_NAME_USER, ACTION_DEL)): ?>
              <td class="td_button_center">
                <?php if(Auth::auth_check(MODULE_NAME_USER, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("user_id", $user->user_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "user_up_" . $user->user_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif ?>
                <?php if(Auth::auth_check(MODULE_NAME_USER, ACTION_DEL)): ?>
                  <?php if($user->admin_flag === 0): ?>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "del") ?>
                    <?php echo Form::hidden("user_id", $user->user_id) ?>
                    <?php echo Form::submit(NULL, "Delete", array("id" => "user_del_" . $user->user_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php else: ?>
                    <?php echo Form::button(NULL, "Delete", array("id" => "user_del_" . $user->user_id, 'class'=>'btn3_disabled', 'disabled' => true, 'style' => 'float:right;')) ?>
                  <?php endif ?>
                  
                  <?php echo Form::close() ?>
                <?php endif ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          </div>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main --> 
