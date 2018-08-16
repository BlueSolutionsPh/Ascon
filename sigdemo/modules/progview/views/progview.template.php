
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Program guide setting 【Display program list by terminal】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menus", array("id" => "progview_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Display by TV program table</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open() ?>
            <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Delivery date</td><td><?php echo Form::input("prog_date", $post["prog_date"], array("id" => "progview_prog_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>※YYYY-MM-DD</td>

                <?php if (date("Y-m-d") < $post["prog_date"]): ?>
                 <td>
                 <?php echo HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $post["dev_id"] . "/" . date("Y-m-d",strtotime("-1 day" ,strtotime($post["prog_date"]))) , "<< The previous day", array("id" => "devprog_yesterday", "class" => "btn3"), null, false) ?></td>
                <?php else: ?>
                 <td><?php echo HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $post["dev_id"] . "/" . date("Y-m-d",strtotime("-1 day" ,strtotime($post["prog_date"]))) , "<< The previous day", array("id" => "devprog_yesterday", 'class'=>'btn3', 'disabled' => true), null, false) ?></td>

                <?php endif ?>
                <td><?php echo HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $post["dev_id"] . "/" . date("Y-m-d",strtotime("+1 day" ,strtotime($post["prog_date"]))) , "next day >>", array("id" => "devprog_tomorrow", "class" => "btn3"), null, false) ?></td>
                
                </tr>
                <tr><td><?php echo Form::button(NULL, "Search", array("id" => "progview_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>
                
              </table>
            <?php echo Form::close() ?>
          </div>

          <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PROGRGL, ACTION_UP) && isset($prog_rgl_grp_id)): ?>
            <?php if(Auth::auth_check(MODULE_NAME_PROGRGL, ACTION_UP)): ?>
            <div class="btn_area_01">
              <?php echo Form::open(MODULE_NAME_PROGRGL) ?>
              <?php echo Form::hidden("disp", "up") ?>
              <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
              <?php echo Form::hidden("ants_version", $post["ants_version"]) ?>
              <?php echo Form::button(NULL, "Repeat specification editing", array("id" => "progview_rgl_up", "type" => "submit", 'class'=>'btn1')) ?>
              <?php echo Form::close() ?>
            </div>
            <?php endif ?>
          <?php endif ?>

          <h3>Program guide by terminal</h3>
          <p class="text01">
          <?php echo Form::label("dev_name", "Device name:") ?>
          <?php echo Form::label("dev_name", $dev_name) ?>
          </p>
          <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
            <p class="text01">
            <?php echo Form::label("ants_version", "ant's classification：") ?>
            <?php echo Form::label("ants_version", $arr_all_ants_version[$post["ants_version"]]) ?>
            </p>
          <?php endif ?>
          <?php if(isset($post["prog_date"])):?>
          <p class="text01">
          <?php echo Form::label("prog_date", "Delivery Date:") ?>
          <?php echo Form::label("prog_date", $post["prog_date"]) ?>
          </p>
          <?php endif ?>
          <?php if(!empty($arr_prog)):?>
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col" style="width:115px">Start time</th>
                <th scope="col" style="width:115px">End time</th>
                <th scope="col" style="width:80px">Classification</th>
                <th scope="col" style="display:none">Program guide name</th>
                <th scope="col">playlist</th>
                <?php if(Session::get_target_client_id() !== false && (Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_INS) || Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_UP) || Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_DEL))): ?>
                  <th scope="col" style="width:65px"></th>
                <?php endif ?>
                <th scope="col">content</th>
              </tr>

              <?php $arr_prog_id = array() ?>
              <?php foreach ($arr_prog as $prog): ?>
                <tr class="prog_<?php echo($prog->prog_id) ?>">

                  <?php if(isset($prog_id) && (string)$prog->prog_id === $prog_id && in_array($prog->prog_id, $arr_prog_id) === false):?>
                    <?php if($prog->dt_flag): ?>
                      <td style="text-align:center;">
                        <?php echo Form::input("sta_dt", HTML::fix_dt_str(Kohana_HTML::entities(HTML::replace_empty_str($prog, "sta_dt"))), array("id" => "progview_sta_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime')) ?>
                      </td>
                      <td style="text-align:center;">
                        <?php echo Form::input("end_dt", HTML::fix_dt_str(Kohana_HTML::entities(HTML::replace_empty_str($prog, "end_dt"))), array("id" => "progview_end_dt", "required" => "true", "maxlength" => "16", 'class'=>'input125 datetime_end')) ?>
                      </td>
                    <?php else: ?>
                      <td style="text-align:center;">
                        <?php echo Form::select('sta_time_h', $time['time_h'], HTML::replace_empty_str($prog, 'sta_time_h'), array("id" => "progview_sta_time_h")) ?>：<?php echo Form::select('sta_time_m', $time['time_m'], HTML::replace_empty_str($prog, 'sta_time_m'), array("id" => "progview_sta_time_m")) ?>
                      </td>
                      <td style="text-align:center;">
                        <?php echo Form::select('end_time_h', $time['time_h'], HTML::replace_empty_str($prog, 'end_time_h'), array("id" => "progview_end_time_h")) ?>：<?php echo Form::select('end_time_m', $time['time_m'], HTML::replace_empty_str($prog, 'end_time_m'), array("id" => "progview_end_time_m")) ?>
                      </td>
                    <?php endif ?>
                  <?php else: ?>
                    <td style="text-align:center;"><?php echo substr(Kohana_HTML::entities(HTML::replace_empty_str($prog, "sta_time")), 0, 5) ?></td>
                    <td style="text-align:center;"><?php echo substr(Kohana_HTML::entities(HTML::replace_empty_str($prog, "end_time")), 0, 5) ?></td>
                  <?php endif ?>

                  <?php if($prog->prog_cat === PROG_RGL_STR): ?>
                    <td style="text-align:center;">Repeated designation</td>
                  <?php else: ?>
                    <td style="text-align:center;">Specify date</td>
                  <?php endif ?>

                  <td style="display:none">
                    <?php if(isset($prog_id) && (string)$prog->prog_id === $prog_id && in_array($prog->prog_id, $arr_prog_id) === false):?>
                      <?php echo Form::input("prog_name", $prog->prog_name, array("id" => "progview_prog_name", "required" => "true", "maxlength" => "20")) ?>
                    <?php else: ?>
                      <?php echo(Kohana_HTML::entities(HTML::replace_empty_str($prog, "prog_name"))); ?>
                    <?php endif ?>
                  </td>

                  <td>
                    <?php if(isset($prog_id) && (string)$prog->prog_id === $prog_id && in_array($prog->prog_id, $arr_prog_id) === false):?>
                      <?php if(isset($prog->ch_1)): ?>
                        <?php echo Form::select("ch_1", $arr_all_playlist, $prog->ch_1->playlist_id, array("id" => "progview_ch_1", "required" => "true")) ?>
                      <?php else: ?>
                        <?php echo Form::select("ch_1", $arr_all_playlist, "", array("id" => "progview_ch_1", "required" => "true")) ?>
                      <?php endif ?>
                    <?php else: ?>
                      <?php if(isset($prog->ch_1)): ?>
                        <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST . "/up/" . $prog->ch_1->playlist_id, Kohana_HTML::entities(HTML::replace_empty_str($prog->ch_1, "playlist_name")), array("id" => "progview_ch1_" . $prog->prog_id, 'onclick'=>'$("#playlist_form'.$prog->prog_id.'_'.$prog->ch_1->playlist_id.'").submit();return false;'), null, false))?>
                        <?php echo Form::open(MODULE_NAME_PLAYLIST, array('id'=>'playlist_form'.$prog->prog_id.'_'.$prog->ch_1->playlist_id)) ?>
                        <?php echo Form::hidden("disp", "up") ?>
                        <?php echo Form::hidden("playlist_id", $prog->ch_1->playlist_id) ?>
                        <?php echo Form::close() ?>
                      <?php else: ?>
                        <?php echo("-")?>
                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <?php if(Session::get_target_client_id() !== false && (Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_INS) || Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_UP) || Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_DEL))): ?>
                    <td>
                      <?php if(!isset($prog_id) && $prog->prog_cat === PROG_INST_STR && in_array($prog->prog_id, $arr_prog_id) === false): ?>
                        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_UP)): ?>
                          <div>
                            <?php echo Form::open() ?>
                            <?php echo Form::hidden("disp", "up") ?>
                            <?php echo Form::hidden("prog_id", $prog->prog_id) ?>
                            <?php echo Form::submit(NULL, "Edit", array("id" => "progview_up_" . $prog->prog_id, 'class' => 'btn3', 'style' => 'width:100%; margin-bottom:2px;')) ?>
                            <?php echo Form::close() ?>
                          </div>
                        <?php endif ?>
                        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_DEL)): ?>
                          <div>
                            <?php echo Form::open() ?>
                            <?php echo Form::hidden("disp", "del") ?>
                            <?php echo Form::hidden("prog_id", $prog->prog_id) ?>
                            <?php echo Form::submit(NULL, "Delete", array("id" => "progview_del_" . $prog->prog_id, 'class' => 'btn3', 'style' => 'width:100%;')) ?>
                            <?php echo Form::close() ?>
                          </div>
                        <?php endif ?>
                      <?php elseif(isset($prog_id) && (string)$prog->prog_id === $prog_id && in_array($prog->prog_id, $arr_prog_id) === false):?>
                        <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_UP)): ?>
                          <div>
                            <?php echo Form::open(null, array("id" => "form")) ?>
                            <?php echo Form::hidden("disp", "up") ?>
                            <?php echo Form::hidden("act", "up") ?>
                            <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                            <?php echo Form::hidden("prog_id", $prog->prog_id) ?>
                            <?php echo Form::hidden("prog_date", $post["prog_date"]) ?>
                            <?php echo Form::submit(null, "Save", array("id" => "progview_save_" . $prog->prog_id, "onclick" => "func_up()", 'class' => 'btn3', 'style' => 'width:100%; margin-bottom:2px;')) ?>
                            <?php echo Form::close() ?>
                          </div>
                        <?php endif ?>
                        <div>
                          <?php echo Form::open() ?>
                          <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                          <?php echo Form::hidden("prog_date", $post["prog_date"]) ?>
                          <?php echo Form::submit(NULL, "Cancel", array("id" => "progview_cancel_" . $prog->prog_id, 'class' => 'btn3', 'style' => 'width:100%;')) ?>
                          <?php echo Form::close() ?>
                        </div>
                      <?php else:?>
                        -
                      <?php endif ?>
                    </td>
                  <?php endif ?>

                  <td>
                    <?php if(isset($prog->ch_1)): ?>
                      <?php foreach ($prog->ch_1->arr_draw_area as $draw_area): ?>
                        <div class="cts" style="width:<?php echo(floor(100 / count($prog->ch_1->arr_draw_area)));?>%">
                          <?php echo(Kohana_HTML::entities($draw_area->draw_area_name)); ?><br />
                          <?php if($draw_area->cts_type === "movie"): ?>
                            <?php foreach ($draw_area->arr_cts as $cts): ?>
                              <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($cts->movie_url)): ?>
                                　<?php echo HTML::anchor($cts->movie_url, Kohana_HTML::entities($cts->movie_name), array("id" => "progview_movie_file_" . $cts->movie_id), null, false) ?><br />
                              <?php else: ?>
                                　<?php echo(Kohana_HTML::entities($cts->movie_name)); ?><br />
                              <?php endif ?>
                            <?php endforeach ?>
                          <?php elseif($draw_area->cts_type === "sound"): ?>
                            <?php foreach ($draw_area->arr_cts as $cts): ?>
                              <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($cts->movie_url)): ?>
                                　<?php echo HTML::anchor($cts->movie_url, Kohana_HTML::entities($cts->movie_name), array("id" => "progview_sound_file_" . $cts->movie_id), null, false) ?><br />
                              <?php else: ?>
                                　<?php echo(Kohana_HTML::entities($cts->movie_name)); ?><br />
                              <?php endif ?>
                            <?php endforeach ?>
                          <?php elseif($draw_area->cts_type === "image"): ?>
                            <?php foreach ($draw_area->arr_cts as $cts): ?>
                              <?php if(Auth::auth_check(MODULE_NAME_CTSDL, ACTION_SEL) && !empty($cts->image_url)): ?>
                                　<?php echo HTML::anchor($cts->image_url, Kohana_HTML::entities($cts->image_name), array("id" => "progview_image_file_" . $cts->image_id), null, false) ?><br />
                              <?php else: ?>
                                　<?php echo(Kohana_HTML::entities($cts->image_name)); ?><br />
                              <?php endif ?>
                            <?php endforeach ?>
                          <?php elseif($draw_area->cts_type === "text"): ?>
                            <?php foreach ($draw_area->arr_cts as $cts): ?>
                              <?php if(!empty($cts->text_name)): ?><?php echo(Kohana_HTML::entities($cts->text_name)); ?><?php else: ?>-<?php endif ?><br />
                            <?php endforeach ?>
                          <?php endif ?>
                        </div>
                      <?php endforeach ?>
                    <?php endif ?>
                  </td>

                  <?php if(in_array($prog->prog_id, $arr_prog_id) === false): ?>
                    <?php array_push($arr_prog_id, $prog->prog_id) ?>
                  <?php endif ?>

                </tr>
              <?php endforeach; ?>

              <?php if(Session::get_target_client_id() !== false && Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_INS)): ?>
                <?php if(!isset($prog_id)):?>
                  <tr>
                    <?php echo Form::open() ?>
                    <?php echo Form::hidden("disp", "ins") ?>
                    <?php echo Form::hidden("act", "ins") ?>
                    <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
                    <?php echo Form::hidden("prog_date", $post["prog_date"]) ?>
                    <td style="text-align:center;">
                      <?php echo Form::select('sta_time_h', $time['time_h'], HTML::replace_empty_array_value($post, 'sta_time_h'), array("id" => "progview_sta_time_h")) ?>：<?php echo Form::select('sta_time_m', $time['time_m'], HTML::replace_empty_array_value($post, 'sta_time_m'), array("id" => "progview_sta_time_m")) ?>
                    </td>
                    <td style="text-align:center;">
                      <?php echo Form::select('end_time_h', $time['time_h'], HTML::replace_empty_array_value($post, 'end_time_h'), array("id" => "progview_end_time_h")) ?>：<?php echo Form::select('end_time_m', $time['time_m'], HTML::replace_empty_array_value($post, 'end_time_m'), array("id" => "progview_end_time_m")) ?>
                    </td>
                    <td style="text-align:center;">Specify date</td>
                    <td style="display:none"><?php echo Form::input("prog_name", time(), array("id" => "progview_prog_name", "required" => "true", "maxlength" => "15")) ?></td>
                    <td><?php echo Form::select("ch_1", $arr_all_playlist, HTML::replace_empty_array_value($post, "ch_1"), array("id" => "progview_ch_1")) ?></td>
                    <td><?php echo Form::submit(NULL, "add to", array("id" => "progview_ins", 'class'=>'btn3', 'style' => 'width:100%;')) ?></td>
                    <td>-</td>
                    <?php echo Form::close() ?>
                  </tr>
                <?php endif ?>
              <?php endif ?>
            
            </table>
          <?php endif ?>

        </div>
      </div>
    </div>
    <!-- #/main --> 
