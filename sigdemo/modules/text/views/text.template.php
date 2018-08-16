
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Content setting 【Telop list】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "text_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Telop list</h3>
        <div class="content">
          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "text_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Telop list</td><td><?php echo Form::select("text_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "text_tag_1"), array("id" => "text_text_tag_1")) ?></td></tr>
                <tr><td>Telop name</td><td><?php echo Form::input("text_name", HTML::replace_empty_array_value($post, "text_name"), array("id" => "text_text_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td>playlist</td><td><?php echo Form::select("playlist_id", $arr_all_playlist, HTML::replace_empty_array_value($post, "playlist_id"), array("id" => "text_playlist_id")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "text_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "Search", array("id" => "text_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">sign up</th>
              <th scope="col">Telop name<br>↑ start ↓ end</th>
              <th scope="col">attribute</th>
              <th scope="col" style="width:50px">word count</th>
              <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_UP) || Auth::auth_check(MODULE_NAME_TEXT, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_DEL)): ?>
                <th scope="col" style="width:50px">
                  <INPUT TYPE="button" onClick="On_BoxChecked(
                    <?php 
                      foreach($arr_text as $text){
                         echo $text->text_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="Select all">
                  <INPUT TYPE="button" onClick="Off_BoxChecked(
                    <?php 
                      foreach($arr_text as $text){
                         echo $text->text_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="All cancellation">
                </th>
              <?php endif ?>
            </tr>
            
            <?php foreach ($arr_text as $text): ?>
            <tr>
              <td><?php echo(Kohana_HTML::entities($text->text_name)); ?></td>
              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($text, "sta_dt"),0,16) )); ?><br>
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($text, "end_dt"),0,16) )); ?></td>
              <td><?php echo(Kohana_HTML::entities($arr_all_property[$text->property_id])); ?></td>
              <td style="text-align:center;">
              <?php if(isset($text->text_msg) && $text->text_msg !== ""): ?>
                <?php echo(mb_strlen($text->text_msg)); ?>
              <?php else: ?>
                - 
              <?php endif ?>
              </td>
              
              <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_UP) || Auth::auth_check(MODULE_NAME_TEXT, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("text_id", $text->text_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "text_up_" . $text->text_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("text_id", $text->text_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "text_del_" . $text->text_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_TEXT, ACTION_DEL)): ?>
                <td>
                  <div style="margin-top:2px" align="center">
                    <?php echo Form::checkbox("chk_text[]" , $text->text_id,(HTML::replace_empty_array_value($post, "chk_text") === $text->text_id),array("id" => "chk_" . $text->text_id , "onClick" => "check()")) ?>
                  </div>
                </td>
              <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="text_lumpdel" value="Delete all" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>
          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main --> 
