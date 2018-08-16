
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Tag list</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "tag_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">To the menu</h3>
        <div class="content">
          <?php if(Auth::auth_check(MODULE_NAME_TAG, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::hidden("tag_cat_id", "movie") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "tag_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <h3>Video tag list</h3>
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Tag name</th>
              <?php if(Auth::auth_check(MODULE_NAME_TAG, ACTION_DEL)): ?>
                <th scope="col" style="width:140px"></th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_movie_tag as $tag): ?>
            <tr>
              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($tag, "movie_tag_name"))); ?></td>

              <td>
              <?php if(Auth::auth_check(MODULE_NAME_TAG, ACTION_UP)): ?>
                <?php echo Form::open() ?>
                <?php echo Form::hidden("disp", "up") ?>
                <?php echo Form::hidden("tag_cat_id", "movie") ?>
                <?php echo Form::hidden("tag_id", $tag->movie_tag_id) ?>
                <?php echo Form::submit(NULL, "Edit", array("id" => "tag_movie_up_" . $tag->movie_tag_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                <?php echo Form::close() ?>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_TAG, ACTION_DEL)): ?>
                <?php echo Form::open() ?>
                <?php echo Form::hidden("disp", "del") ?>
                <?php echo Form::hidden("tag_cat_id", "movie") ?>
                <?php echo Form::hidden("tag_id", $tag->movie_tag_id) ?>
                <?php echo Form::submit(NULL, "Delete", array("id" => "tag_movie_del_" . $tag->movie_tag_id, 'class' => 'btn3', 'style' => 'float:right;')) ?>
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
