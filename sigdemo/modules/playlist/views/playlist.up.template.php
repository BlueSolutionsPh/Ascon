
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Client-specific playlist update</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Client-specific playlist update</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("disp", "up", array("id" => "disp")) ?>
          <?php echo Form::hidden("act", "up", array("id" => "act")) ?>
          <?php echo Form::hidden("playlist_id", $post["playlist_id"]) ?>
          <?php echo Form::hidden("prog_name", time()) ?>
          <?php echo Form::select("arr_movie[]", null, null, array("id" => "playlist_up_arr_movie", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie01[]", null, null, array("id" => "playlist_up_arr_movie01", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie02[]", null, null, array("id" => "playlist_up_arr_movie02", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie03[]", null, null, array("id" => "playlist_up_arr_movie03", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie11[]", null, null, array("id" => "playlist_up_arr_movie11", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie12[]", null, null, array("id" => "playlist_up_arr_movie12", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>
          <?php echo Form::select("arr_movie13[]", null, null, array("id" => "playlist_up_arr_movie13", "multiple" => "multiple", "style" => "visibility:hidden;height:0")) ?>

          <div class="hr_wrapper_01">
             <table cellspacing="1" cellpadding="3" border="0">
               <dt>Playlist name</dt>
               <dd>
                 <?php echo Html::chars($post["playlist_name"]) ?>
               </dd>
               <dt>Contract client name</dt>
               <dd>
                 <?php echo $arr_all_client[$post["client_id"]] ?>
               </dd>
               <dt>Delivery month</dt>
               <dd>
                 <?php echo $arr_delivery_month[$post["deliverymonth_id"]] ?>
               </dd>
               <dt>Delivery period</dt>
               <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?>
                   ～
                  <?php echo Html::chars($post["end_dt"]) ?>
               </dd>
               <dt>Duplicate playlist name</dt>
               <dd>
                 <?php echo Form::select("cp_playlist_id", $arr_all_playlist,  HTML::replace_empty_array_value($post, "cp_playlist_id"),array("id" => "playlist_up_cp_playlist_id")) ?>
                 <?php echo Form::button("setting", "Replication", array("id" => "commonplaylist_up_setting", "type" => "submit", 'class'=>'btn3')) ?>
               </dd>
             </table>
          </div>

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "playlist_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">

                <tr><td>Movie title name</td><td><?php echo Form::input("movie_name", HTML::replace_empty_array_value($post, "movie_name"), array("id" => "playlist_up_movie_name", "maxlength" => "60", "class" => "input350")) ?></td></tr>
                <tr><td>Movie tag</td><td><?php echo Form::select("movie_tag_1", $arr_all_tag, HTML::replace_empty_array_value($post, "movie_tag_1"), array("id" => "playlist_up_movie_tag_1")) ?></td>
                    <td colspan="2"><?php echo Form::button(NULL, "Search", array("id" => "playlist_up_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
              </table>

              <br /><div class="progleft" style="margin-left:5px;">
                <dl class="dl_input_02">
                  <dt>Movie title  <span id="fieldChooser" style="margin-left: 10px;"></span></dt>
                  <dd>
                    <div class="draglist">
                      <table _fixedhead="row:1">
                        <thead>
                          <tr>
                            <th class="ui-state-default"> </th>
                            <th class="ui-state-default">Movie title name</th>
                            <th class="ui-state-default">Validity period</th>
                          </tr>
                        </thead>
                        <tbody>
<?php $cnt = 1;?>
<?php foreach ($arr_all_movie as $id => $movie):?>
                          <tr class="drag">
                            <td class="ui-state-default node"><?php echo $cnt++;?></td>
                            <td class="ui-state-default data" data-id="<?php echo $id;?>"><span class="value"><?php echo $movie['movie_name'];?></span></li>
                            <td class="ui-state-default node"><?php echo date('Y-m-d', strtotime($movie['sta_dt'])) . ' ～ ' . date('Y-m-d', strtotime($movie['end_dt']));?></li>
                          </tr>
<?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </dd>
                </dl>
              </div>

              <div class="progright" style="margin-right:5px;">
                <dl class="dl_input_02">
                  <dt>プレイリスト  <span id="fieldChooser" style="margin-right: 10px;"></span></dt>
                  <dd>
                    <div class="droplist playlist">
                      <table _fixedhead="row:1;col:4">
                        <thead>
                          <tr>
                            <th class="ui-state-default"> </th>
                            <th class="ui-state-default">sex</th>
                            <th class="ui-state-default">Delivery time zone</th>
                            <th class="ui-state-default">Movie title name</th>
                          </tr>
                        </thead>
                        <tbody>
<?php $gender = array(0 => 'male', 1 => 'Female');?>
<?php $time = array(1 => 'Morning', 2 => 'Noon', 3 => 'Night');?>
<?php for ($i = 0; $i < 12; $i++):?>
<?php $m = (int)(($i + 6) / 6 - 1); $n = (int)(($i % 6 + 2) / 2); ?>
                          <tr>
                            <td class="ui-state-default"><?php echo $i + 1;?></td>
<?php if ($i % 6 == 0):?>
                            <td class="ui-state-default" rowspan="6"><?php echo $gender[$m];?></td>
<?php endif; ?>
<?php if ($i % 2 == 0):?>
                            <td class="ui-state-default" rowspan="2"><?php echo $time[$n];?></td>
<?php endif; ?>
<?php if (!empty($playlist_exists[$m][$n + 1])): ?>
<?php if (count(${'arr_sel_movie' . $m . $n})): ?>
<?php $movie = array_splice(${'arr_sel_movie' . $m . $n}, 0, 1);?>
<?php $key = key($movie);?>
                            <td class="ui-state-default drop-target" data-name="<?php echo $m . $n;?>" data-id="<?php echo $key;?>"><span class="value"><?php echo htmlspecialchars($movie[$key]['movie_name']);?></span><span class="close">×</span></td>
<?php else: ?>
                            <td class="ui-state-default drop-target blank" data-name="<?php echo $m . $n;?>" data-id=""><span class="value"></span></td>
<?php endif; ?>
<?php endif; ?>
                          </tr>
<?php endfor; ?>
                        </tbody>
                      </table>
                    </div>
                  </dd>
                </dl>
              </div>

              <div style="height: 370px"></div>
              <br /><div class="btn_area_02">
                <?php echo Form::button(NULL, "Return", array("id" => "playlist_up_back", 'class'=>'btn1 btn_l')) ?>
                <?php echo Form::button(NULL, "update", array("id" => "playlist_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
              </div>
            <?php echo Form::close() ?>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
    <script>
       $('.maltilist_add').click(function(){
           var id = $(this).attr('id');
           func_add_list( id.split("_")[1] );
       });
       $('.maltilist_del').click(function(){
           var id = $(this).attr('id');
           func_del_list( id.split("_")[1] );
       });
    </script>
    <!-- #/main -->
