
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">共通プレイリスト更新</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">共通プレイリスト更新</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("disp", "up", array("id" => "disp")) ?>
          <?php echo Form::hidden("act", "up", array("id" => "act")) ?>
          <?php echo Form::hidden("playlist_id", $post["playlist_id"]) ?>
          <?php echo Form::hidden("max_playlist", MAX_COMMONPLAYLIST) ?>
          <?php echo Form::select("arr_movie[]", null, null, array("id" => "commonplaylist_up_arr_movie", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>

          <div class="hr_wrapper_01">
             <table cellspacing="1" cellpadding="3" border="0">
               <tr>
                 <th>Common playlist name</th>
                 <td>
                   <?php echo Html::chars($post["playlist_name"]) ?>
                 </td>
               </tr>
               <tr>
                 <th>sex</th>
                 <td>
                   <?php echo $arr_sex[$post["sex_id"]] ?>
                 </td>
               </tr>
               <tr>
                 <th>Delivery time zone</th>
                 <td>
                   <?php echo $arr_time_zone[$post["timezone_id"]] ?>
                 </td>
               </tr>
               <tr>
                 <th>Delivery month</th>
                 <td>
                   <?php echo $arr_delivery_month[$post["deliverymonth_id"]] ?>
                 </td>
               </tr>
               <tr>
                 <th>Delivery period</th>
                 <td>
                    <?php echo $post["sta_dt"] ?>
                     ～
                    <?php echo $post["end_dt"] ?>
                 </td>
               </tr>
               <tr>
                 <th>Duplicate playlist name</th>
                 <td>
                   <?php echo Form::select("cp_playlist_id", $arr_all_playlist,  HTML::replace_empty_array_value($post, "cp_playlist_id"),array("id" => "commonplaylist_up_cp_playlist_id")) ?>
                   <?php echo Form::button("setting", "Replication", array("id" => "commonplaylist_up_setting", "type" => "submit", 'class'=>'btn3')) ?>
                   ※If you select the original playlist, it duplicates the state before update.
                 </td>
               </tr>
             </table>
          </div>

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "commonplaylist_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Movie title name</td><td><?php echo Form::input("movie_name", HTML::replace_empty_array_value($post, "movie_name"), array("id" => "commonplaylist_up_movie_name", "maxlength" => "60", "class" => "input350")) ?></td></tr>
                <tr><td>Video tag</td><td><?php echo Form::select("movie_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "movie_tag_1"), array("id" => "commonplaylist_up_movie_tag_1")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "commonplaylist_up_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>

              <div style="height: 10px"> </div>
              <div class="progleft" style="margin-left:5px;">
                <dl class="dl_input_02">
                  <dt>Movie title</dt>
                  <dd>
                    <div class="draglist">
                      <table _fixedhead="row:1">
                        <thead>
                          <tr>
                            <th class="ui-state-default"> </th>
                            <th class="ui-state-default">Movie title name</th>
                            <th class="ui-state-default">Validity period</th>
                            <th class="ui-state-default">Video tag</th>
                          </tr>
                        </thead>
                        <tbody>
<?php $cnt = 1;?>
<?php foreach ($arr_all_movie as $id => $movie):?>
                          <tr class="drag">
                            <td class="ui-state-default node"><?php echo $cnt++;?></td>
                            <td class="ui-state-default" data-id="<?php echo $id;?>"><span class="value"><?php echo $movie['movie_name'];?></span></td>
                            <td class="ui-state-default node"><?php echo date('Y-m-d', strtotime($movie['sta_dt'])) . ' ～ ' . date('Y-m-d', strtotime($movie['end_dt']));?></td>
                            <td class="ui-state-default node"><?php echo $movie['movie_tag_name'];?></td>
                          </tr>
<?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </dd>
                </dl>
              </div>
              <div class="progright">
                <dl class="dl_input_02">
                  <dt>プレイリスト</dt>
                  <dd>
                    <div class="droplist">
                      <table _fixedhead="row:1">
                        <thead>
                          <tr>
                            <th class="ui-state-default"> </th>
                            <th class="ui-state-default">Movie title name</th>
                          </tr>
                        </thead>
                        <tbody>
<?php $cnt = 1;?>
<?php foreach ($arr_sel_movie as $id => $movie):?>
                          <tr>
                            <td class="ui-state-default"><?php echo $cnt++;?></td>
                            <td class="ui-state-default" data-id="<?php echo $id;?>"><span class="value"><?php echo $movie;?></span><span class="close">×</span></td>
                          </tr>
<?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </dd>
                  <span id="movie_count" style="margin-left: 10px;"><?php echo count($arr_sel_movie);?> / 38</span>
                </dl>
              </div>

              <br /><div class="btn_area_02">
                <?php echo Form::button(NULL, "Return", array("id" => "commonplaylist_up_back", 'class'=>'btn1 btn_l')) ?>
                <?php echo Form::button(NULL, "update", array("id" => "commonplaylist_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
              </div>
            <?php echo Form::close() ?>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- #/main -->
