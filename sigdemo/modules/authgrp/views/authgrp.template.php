
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Administrator type list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Administrator type list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "authgrp_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Authority name</td><td><?php echo Form::input("auth_grp_name", HTML::replace_empty_array_value($post, "auth_grp_name"), array("id" => "authgrp_auth_grp_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "authgrp_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "authgrp_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_long">Authority name</th>
              <th scope="col" class="th_width_long">changer</th>
              <?php if(Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_UP) || Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_auth_grp as $auth_grp): ?>
            <tr>
              <td><?php echo(Kohana_HTML::entities($auth_grp->auth_grp_name)); ?></td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($auth_grp, "update_user"))); ?></td>
              <?php if(Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_UP) || Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("auth_grp_id", $auth_grp->auth_grp_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "authgrp_up_" . $auth_grp->auth_grp_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_AUTHGRP, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("auth_grp_id", $auth_grp->auth_grp_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "authgrp_del_" . $auth_grp->auth_grp_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
