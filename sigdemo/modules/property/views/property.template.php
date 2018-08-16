
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Attribute setting 【Attribute list】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "property_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Attribute List</h3>
        <div class="content">
          <?php if(Auth::auth_check(MODULE_NAME_PROPERTY, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "property_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <h3>Attribute List</h3>
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Attribute name</th>
              <?php if(Auth::auth_check(MODULE_NAME_PROPERTY, ACTION_DEL)): ?>
                <th scope="col" style="width:140px"></th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_property as $property): ?>
            <tr>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($property, "property_name"))); ?></td>

              <td>
              <?php if(Auth::auth_check(MODULE_NAME_PROPERTY, ACTION_UP)): ?>
                <?php echo Form::open() ?>
                <?php echo Form::hidden("disp", "up") ?>
                <?php echo Form::hidden("property_id", $property->property_id) ?>
                <?php echo Form::submit(NULL, "Edit", array("id" => "property_up_" . $property->property_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                <?php echo Form::close() ?>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_PROPERTY, ACTION_DEL)): ?>
                <?php echo Form::open() ?>
                <?php echo Form::hidden("disp", "del") ?>
                <?php echo Form::hidden("property_id", $property->property_id) ?>
                <?php echo Form::submit(NULL, "Delete", array("id" => "property_del_" . $property->property_id, 'class' => 'btn3', 'style' => 'float:right;')) ?>
                <?php echo Form::close() ?>
              <?php endif; ?>
              </td>

            </tr>
            <?php endforeach; ?>
          </table>

        </div>
      </div>

    </div>
    <!-- #/main --> 
