
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Content Settings [Common Telop List]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commontext_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Common telop list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "commontext_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Telop name</td><td><?php echo Form::input("text_name", HTML::replace_empty_array_value($post, "text_name"), array("id" => "commontext_text_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td>playlist</td><td><?php echo Form::select("playlist_id", $arr_all_playlist, HTML::replace_empty_array_value($post, "playlist_id"), array("id" => "commontext_playlist_id")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "commontext_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "commontext_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Telop name</th>
              <th scope="col">expiration date<br>Start  End</th>
              <th scope="col" style="width:50px">word count</th>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
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
              <td style="text-align:center;">
              <?php if(isset($text->text_msg) && $text->text_msg !== ""): ?>
                <?php echo(mb_strlen($text->text_msg)); ?>
              <?php else: ?>
                -
              <?php endif ?>
              </td>

              <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("text_id", $text->text_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "commontext_up_" . $text->text_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("text_id", $text->text_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "commontext_del_" . $text->text_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
                <td>
                  <div style="margin-top:2px" align="center">
                    <?php echo Form::checkbox("chk_text[]" , $text->text_id,(HTML::replace_empty_array_value($post, "chk_text") === $text->text_id),array("id" => "chk_" . $text->text_id , "onClick" => "check()")) ?>
                  </div>
                </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_COMMONTEXT, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="commontext_lumpdel" value="Delete all" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>
          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
