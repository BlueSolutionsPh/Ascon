
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Content setting [smart content list]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "html_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Smart Content List</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "html_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Smurf content tag</td><td><?php echo Form::select("html_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "html_tag_1"), array("id" => "html_html_tag_1")) ?></td></tr>
                <tr><td>Smaho content name</td><td><?php echo Form::input("html_name", HTML::replace_empty_array_value($post, "html_name"), array("id" => "html_html_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "html_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "html_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Smaho content name</th>
              <th scope="col">changer</th>
              <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_UP) || Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
                <th scope="col" style="width:50px">
                  <INPUT TYPE="button" onClick="On_BoxChecked(
                    <?php
                      foreach($arr_html as $html){
                         echo $html->html_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="Select all">
                  <INPUT TYPE="button" onClick="Off_BoxChecked(
                    <?php
                      foreach($arr_html as $html){
                         echo $html->html_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="All cancellation">
                </th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_html as $html): ?>
            <tr>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($html->html_url)): ?>
                  <?php echo HTML::anchor($html->html_url, Kohana_HTML::entities($html->html_name), array("id" => "html_file_" . $html->html_id), null, false) ?>
                <?php else: ?>
                  <?php echo(Kohana_HTML::entities($html->html_name)); ?>
                <?php endif ?>
              </td>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($html, "update_user"))); ?></td>

              <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_UP) || Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("html_id", $html->html_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "html_up_" . $html->html_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("html_id", $html->html_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "html_del_" . $html->html_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
                <td>
                  <div style="margin-top:2px" align="center">
                    <?php echo Form::checkbox("chk_html[]" , $html->html_id,(HTML::replace_empty_array_value($post, "chk_html") === $html->html_id),array("id" => "chk_" . $html->html_id , "onClick" => "check()")) ?>
                  </div>
                </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_HTML, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="html_lumpdel" value="Delete all" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>
          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
