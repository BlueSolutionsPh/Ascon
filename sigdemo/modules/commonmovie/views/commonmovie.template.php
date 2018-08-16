
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Content setting [common video list]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "commonmovie_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result) ?>
      <div class="box_01">
        <h3 class="title">Common video list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "commonmovie_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Movie name</td><td><?php echo Form::input("movie_name", HTML::replace_empty_array_value($post, "movie_name"), array("id" => "commonmovie_movie_name", "maxlength" => "20", "class" => "input350")) ?></td></tr>
                <tr><td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "commonmovie_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_INS)): ?>
          <div class="btn_area_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::button(NULL, "sign up", array("id" => "commonmovie_ins", "type" => "submit", 'class'=>'btn1')) ?>
            <?php echo Form::close() ?>
          </div>
          <?php endif ?>
          <?php echo $pagination ?>
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col">Movie name</th>
              <th scope="col">expiration date<br>start  end</th>
              <th scope="col" style="width:70px">Playback time</th>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
                <th scope="col" style="width:135px"></th>
              <?php endif ?>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
                <th scope="col" style="width:50px">
                  <INPUT TYPE="button" onClick="On_BoxChecked(
                    <?php
                      foreach($arr_movie as $movie){
                         echo $movie->movie_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="Select all">
                  <INPUT TYPE="button" onClick="Off_BoxChecked(
                    <?php
                      foreach($arr_movie as $movie){
                         echo $movie->movie_id.",";
                      }
                      echo "0";
                    ?>
                  )" VALUE="All cancellation">
                </th>
              <?php endif ?>
            </tr>

            <?php foreach ($arr_movie as $movie): ?>
            <tr>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($movie->movie_url)): ?>
                  <?php echo HTML::anchor($movie->movie_url, Kohana_HTML::entities($movie->movie_name), array("id" => "commonmovie_file_" . $movie->movie_id), null, false) ?>
                <?php else: ?>
                  <?php echo(Kohana_HTML::entities($movie->movie_name)); ?>
                <?php endif ?>
              </td>
              <td><?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($movie, "sta_dt"),0,16) )); ?><br>
                  <?php echo(Kohana_HTML::entities( substr(HTML::replace_empty_str($movie, "end_dt"),0,16) )); ?></td>
              <td class="td_playtime">
              <?php if(isset($movie->play_time) && $movie->play_time !== ""): ?>
                <?php echo($movie->play_time); ?>
              <?php else: ?>
                -
              <?php endif ?>
              </td>

              <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_UP) || Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
              <td>
                <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_UP)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "up") ?>
                  <?php echo Form::hidden("movie_id", $movie->movie_id) ?>
                  <?php echo Form::submit(NULL, "Edit", array("id" => "commonmovie_up_" . $movie->movie_id, 'class'=>'btn3', 'style' => 'float:left;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
                <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
                  <?php echo Form::open() ?>
                  <?php echo Form::hidden("disp", "del") ?>
                  <?php echo Form::hidden("movie_id", $movie->movie_id) ?>
                  <?php echo Form::submit(NULL, "Delete", array("id" => "commonmovie_del_" . $movie->movie_id, 'class'=>'btn3', 'style' => 'float:right;')) ?>
                  <?php echo Form::close() ?>
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
                <td>
                  <div style="margin-top:2px" align="center">
                    <?php echo Form::checkbox("chk_movie[]" , $movie->movie_id,(HTML::replace_empty_array_value($post, "chk_movie") === $movie->movie_id),array("id" => "chk_" . $movie->movie_id , "onClick" => "check()")) ?>
                  </div>
                </td>
              <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            <?php if(Auth::auth_check(MODULE_NAME_COMMONMOVIE, ACTION_DEL)): ?>
              <tr>
                <?php echo Form::open(null,array("name"=>"form_lump_del", "method"=>"post")) ?>
                <input type="hidden" name="disp" value="lump_del">
                <input type="button" id="commonmovie_lumpdel" value="一括削除" style="float:right" onClick="bulk_deletion()" disabled>
                <?php echo Form::close() ?>
              </tr>
            <?php endif; ?>
          </table>
          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
