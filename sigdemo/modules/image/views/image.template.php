
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Content setting [Still image list]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "image_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Still image list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "image_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Static image tag</td><td><?php echo Form::select("image_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "image_tag_1"), array("id" => "image_image_tag_1")) ?></td></tr>
                <tr><td>Still image name</td><td><?php echo Form::input("image_name", HTML::replace_empty_array_value($post, "image_name"), array("id" => "image_image_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "検索", array("id" => "image_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "image_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Still image name</th>
              <th scope="col">expiration date<br>start  End</th>
              <th scope="col">attribute</th>
              <th scope="col">size</th>
              <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_UP) || Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
                <th scope="col" style="width:50px">
                  <INPUT TYPE="button" onClick="On_BoxChecked(
                    <?php
                      foreach($arr_image as $image){
                         echo $image->image_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="Select all">
                  <INPUT TYPE="button" onClick="Off_BoxChecked(
                    <?php
                      foreach($arr_image as $image){
                         echo $image->image_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="All cancellation">
                </th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_image as $image): ?>
            <tr>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($image->image_url)): ?>
                  <?php echo HTML::anchor($image->image_url, Kohana_HTML::entities($image->image_name), array("id" => "image_file_" . $image->image_id), null, false) ?>
                  <img src="<?php echo $image->thum_image_file ?>" style="height:36px;width:auto;" align="right" />
                <?php else: ?>
                  <?php echo(Kohana_HTML::entities($image->image_name)); ?>
                <?php endif ?>
              </td>
              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($image, "sta_dt"),0,16) )); ?><br>
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($image, "end_dt"),0,16) )); ?></td>
              <td><?php echo(Kohana_HTML::entities($arr_all_property[$image->property_id])); ?></td>
              <td>
              <?php if(isset($image->draw_size_name) && $image->draw_size_name !== ""): ?>
                <?php echo(Kohana_HTML::entities($image->draw_size_name)); ?>
              <?php else: ?>
                -
              <?php endif ?>
              </td>

              <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_UP) || Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("image_id", $image->image_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "image_up_" . $image->image_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("image_id", $image->image_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "image_del_" . $image->image_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
                <td>
                  <div style="margin-top:2px" align="center">
                    <?php echo Form::checkbox("chk_image[]" , $image->image_id,(HTML::replace_empty_array_value($post, "chk_image") === $image->image_id),array("id" => "chk_" . $image->image_id , "onClick" => "check()")) ?>
                  </div>
                </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_IMAGE, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="image_lumpdel" value="Delete all" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>
          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
