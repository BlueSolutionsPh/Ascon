
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Playlist setting [Register all playlists]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "playlistall_ins_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Template selection</h3>
        <div class="content">

        <?php echo Form::open(null, array("id" => "form")) ?>
        <?php echo Form::hidden("disp", "ins", array("id" => "disp")) ?>
        <?php echo Form::hidden("act", "conf", array("id" => "act")) ?>

          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th scope="row" width="20%">Playlist name</th>
                <td><?php echo Form::label("playlist_name", $playlist_name) ?></td>
              </tr>
              <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
                <tr>
                  <th scope="row">ants classification</th>
                  <td><?php echo Form::label("ants_version", $arr_all_ants_version[$ants_version]) ?></td>
                </tr>
              <?php endif ?>
              <tr>
                <th scope="row">template</th>
                <td><?php echo Form::label("draw_tmpl_name", $draw_tmpl_name) ?></td>
              </tr>
              <tr>
                <th scope="row" width="20%">Setting object</th>
                <td>
                <?php if(isset($post["target_client"]) && $post["target_client"] === "1"): ?>
                <?php echo Form::radio("target_client", 0, false, array("id" => "playlistall_ins_target_client_0", "onclick" => "func_change_target_client(this.value)")) ?><?php echo Form::label("target_client_0", "All clients") ?>
                <?php echo Form::radio("target_client", 1, true, array("id" => "playlistall_ins_target_client_1", "onclick" => "func_change_target_client(this.value)")) ?><?php echo Form::label("target_client_1", "Selected client") ?>
                <?php else: ?>
                <?php echo Form::radio("target_client", 0, true, array("id" => "playlistall_ins_target_client_0", "onclick" => "func_change_target_client(this.value)")) ?><?php echo Form::label("target_client_0", "All clients") ?>
                <?php echo Form::radio("target_client", 1, false, array("id" => "playlistall_ins_target_client_1", "onclick" => "func_change_target_client(this.value)")) ?><?php echo Form::label("target_client_1", "Selected client") ?>
                <?php endif ?>
                </td>
              </tr>
              <tr>
                <th scope="row" width="20%"><?php echo Form::label("arr_client", "client") ?></th>
                <td>
                <?php echo Form::select("arr_client[]", $arr_all_client, HTML::replace_empty_array_value($post, "arr_client", array()), array("id" => "playlistall_ins_arr_client", "multiple" => "multiple", "required" => "true", "disabled" => "true")) ?>※ Multiple selection
                </td>
              </tr>

              <?php foreach($arr_draw_area as $draw_area): ?>
              <?php if($draw_area["cts_type"] === "image" || $draw_area["cts_type"] === "movie"): ?>
              <tr>
              <th scope="row">Still picture switching interval (sec)</th>
              <td>
                <?php echo Form::input("image_intvl", HTML::replace_empty_array_value($post, "image_intvl"), array("id" => "playlistall_ins_image_intvl", "required" => "true", "maxlength" => "5", "size" => "10", "id" => "image_intvl")) ?>
                ※Within 5 digits
              </td>
              </tr>
              <?php break ?>
              <?php endif ?>
              <?php endforeach ?>

            </table>
          </div>
          <div class="lirt clearfix">
            <div class="text">
              <table border="0" cellspacing="0" cellpadding="0" class="tbl_01">
                <tr>
                  <th colspan="4" scope="col">Display area</th>
                </tr>
                <?php $loop = 0; $sortableList=array();?>
                <?php foreach($arr_draw_area as $draw_area): ?>
                <?php $sortableList[$loop] = "sortable_".$loop; ?>
                  <?php if(isset($post["cts"][$draw_area["draw_area_id"]])): ?>
                      <tr>
                          <td style="width:200px; text-align:center;">
                        Drawing area name:
                            <?php echo($draw_area["draw_area_name"])?><br />
                        Content classification:
                            <?php if($draw_area["cts_type"] === "movie"): ?>Video
                            <?php elseif($draw_area["cts_type"] === "sound"): ?>voice
                            <?php elseif($draw_area["cts_type"] === "image"): ?>Still image
                            <?php elseif($draw_area["cts_type"] === "text"): ?>telop
                            <?php endif ?><br />
                            <?php echo Form::button("ins", "追加", array("id" => "playlistall_ins_cts_ins_" . $draw_area["draw_area_id"] . "_" . 0, "onclick" => "func_add(" . $draw_area["draw_area_id"] . ")", 'class'=>'btn3')) ?>
                          </td>
                          <td>
                          <table class="tbl_sortable"><tbody id="<?php echo $sortableList[$loop]; ?>">
                    <?php foreach ($post["cts"][$draw_area["draw_area_id"]] as $i => $cts): ?>
                    <tr>
                        <td style="width:20px; text-align:center;"><?php echo($i + 1); ?></td>
                        <td>
                          <?php if($draw_area["cts_type"] === "movie"): ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_movie, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php elseif($draw_area["cts_type"] === "sound"): ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_sound, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php elseif($draw_area["cts_type"] === "image"): ?>
                            <?php if(isset($arr_all_image[$draw_area["draw_area_id"]])): ?>
                              <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_image[$draw_area["draw_area_id"]], $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                            <?php else: ?>
                              <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", array("" => ""), $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                            <?php endif ?>
                          <?php elseif($draw_area["cts_type"] === "text"): ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_text, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php endif ?>
                        </td>
                        <td style="width:65px">
                          <?php if ( count($post["cts"][$draw_area["draw_area_id"]]) > 1 ): ?>
                              <?php echo Form::button("del", "Delete", array("id" => "playlistall_ins_cts_del_" . $draw_area["draw_area_id"] . "_" . $i, "onclick" => "func_del(" . $draw_area["draw_area_id"] . ", " . $i . ")", 'class'=>'btn3', 'style' => 'width:100%;')) ?>
                          <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                        </tbody></table>
                        </td>
                      </tr>
                  <?php else: ?>
                    <?php $i = 0; ?>
                    <tr>
                      <td rowspan="1" style="width:200px; text-align:center;">
                      Drawing area name:
                        <?php echo($draw_area["draw_area_name"])?><br />
                      Content classification:
                        <?php if($draw_area["cts_type"] === "movie"): ?>Video
                        <?php elseif($draw_area["cts_type"] === "sound"): ?>voice
                        <?php elseif($draw_area["cts_type"] === "image"): ?>Still image
                        <?php elseif($draw_area["cts_type"] === "text"): ?>telop
                        <?php endif ?>
                        <?php echo Form::button("ins", "add to", array("id" => "playlistall_ins_cts_ins_" . $draw_area["draw_area_id"], "onclick" => "func_add(" . $draw_area["draw_area_id"] . ")", 'class'=>'btn3')) ?>
                      </td>
                      <td><table class="tbl_sortable"><tr>
                      <td style="width:20px; text-align:center;">1</td>
                      <td>
                        <?php if($draw_area["cts_type"] === "movie"): ?>
                          <?php if(count($arr_draw_area) === 1): ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_movie, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php else: ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_movie_exclude_swf, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php endif ?>
                        <?php elseif($draw_area["cts_type"] === "sound"): ?>
                          <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_sound, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                        <?php elseif($draw_area["cts_type"] === "image"): ?>
                          <?php if(isset($arr_all_image[$draw_area["draw_area_id"]])): ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_image[$draw_area["draw_area_id"]], $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php else: ?>
                            <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", array("" => ""), $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                          <?php endif ?>
                        <?php elseif($draw_area["cts_type"] === "text"): ?>
                          <?php echo Form::select("cts[" . $draw_area["draw_area_id"] . "][" . $i . "]", $arr_all_text, $post["cts"][$draw_area["draw_area_id"]][$i], array("id" => "playlistall_ins_cts_" . $draw_area["draw_area_id"] . "_" . $i)) ?>
                        <?php endif ?>
                      </td>
                      <td style="width:65px;"></td>
                      </tr></table></td>
                    </tr>
                  <?php endif ?>
                  <?php $loop++; ?>
                <?php endforeach; ?>

              </table>
            </div>
            <div class="image"><?php if(isset($arr_map_img[$post["draw_tmpl_id"]]['path'])): ?><img src="<?php echo $arr_map_img[$post["draw_tmpl_id"]]['path'] ?>" /><?php endif ?></div>
          </div>

          <div class="text_01">Confirm the above contents and press "Register" button</div>
          <div class="btn_area_02">
            <?php echo Form::button(NULL, "Return", array("id" => "playlistall_ins_back", "onclick" => "func_back()", 'class'=>'btn1 btn_l')) ?>
            <?php echo Form::button(NULL, "Registration", array("id" => "playlistall_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
        <?php echo Form::close() ?>
        <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
