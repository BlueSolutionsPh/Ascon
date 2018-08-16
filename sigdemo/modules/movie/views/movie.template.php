
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Movie list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Movie list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "movie_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Movie title name</td><td><?php echo Form::select("movie_id", $arr_all_movie, HTML::replace_empty_array_value($post, "movie_id"), array("id" => "movie_movie_id")) ?></td></tr>
                <tr><td>Advertisement type</td><td><?php echo Form::select("ad_flag", $arr_all_ad, HTML::replace_empty_array_value($post, "ad_flag"), array("id" => "movie_ad_flag")) ?></td></tr>
                <tr><td>Contract client name</td><td><?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "movie_client_id")) ?></td></tr>
                <tr><td>Distribution effective date and time</td>
                    <td><?php echo Form::input("movie_date", $post["movie_date"], array("id" => "movie_movie_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?></td></tr>
                <tr><td>Movie tag</td><td><?php echo Form::select("movie_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "movie_tag_1"), array("id" => "movie_movie_tag_1")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "movie_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_MOVIE, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "movie_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>

          <?php echo $pagination ?>

          <div style="height:200px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_short"></th>
              <th scope="col" class="th_width_long">Movie title name</th>
              <th scope="col" class="th_width_middle">Advertisement type</th>
              <th scope="col" class="th_width_long">Contract client name</th>
              <th scope="col" class="th_width_long">expiration date</th>
              <?php if(Auth::auth_check(MODULE_NAME_MOVIE, ACTION_UP) || Auth::auth_check(MODULE_NAME_MOVIE, ACTION_DEL)): ?>
                <th scope="col" class="th_width_button"></th>
              <?php endif ?>
            </tr>

            <?php $i=1; foreach ($arr_movie as $movie): ?>
            <tr>
              <td class="td_text_center"><?php echo $i?></td>

              <td>
                <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($movie->movie_url)): ?>
                  <?php echo HTML::anchor($movie->movie_url, Kohana_HTML::entities($movie->movie_name), array("id" => "movie_file_" . $movie->movie_id), null, false) ?>
                <?php else: ?>
                  <?php echo(Kohana_HTML::entities($movie->movie_name)); ?>
                <?php endif ?>
              </td>

              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($movie, "ad_name"))); ?></td>

              <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($movie, "client_name"))); ?></td>

              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($movie, "sta_dt"),0,10) )); ?> ～
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($movie, "end_dt"),0,10) )); ?></td>


              <?php if(Auth::auth_check(MODULE_NAME_MOVIE, ACTION_UP) || Auth::auth_check(MODULE_NAME_MOVIE, ACTION_DEL)): ?>
              <td class="td_button_center">

                <?php if(Auth::auth_check(MODULE_NAME_MOVIE, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("movie_id", $movie->movie_id) ?>
                  <?php echo Form::hidden("image_id", $movie->image_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "movie_up_" . $movie->movie_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_MOVIE, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("movie_id", $movie->movie_id) ?>
                  <?php echo Form::hidden("image_id", $movie->image_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "movie_del_" . $movie->movie_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>

            </tr>
            <?php $i++; endforeach; ?>

          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
