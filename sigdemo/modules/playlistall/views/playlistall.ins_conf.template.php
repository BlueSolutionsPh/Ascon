
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Playlist setting [Register all playlists]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "playlistall_ins_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <div class="box_01">
        <h3 class="title">Template selection</h3>
        <div class="content">

          <?php echo Form::open(null, array("id" => "form")) ?>
          <?php echo Form::hidden("token", $token) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>

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
                <th scope="row" width="20%"><?php echo Form::label("target_client", "設定対象") ?></th>
                <td>
                <?php if(isset($post["target_client"]) && $post["target_client"] === "1"): ?>Selected client
                <?php else: ?>All clients
                <?php endif ?>
                </td>
              </tr>

              <?php if(isset($post["target_client"]) && $post["target_client"] === "1"): ?>
              <tr>
                <th scope="row" width="20%"><?php echo Form::label("arr_client", "client") ?></th>
                <td>
                <?php if(!empty($arr_client_name)): foreach($arr_client_name as $client_name):?>
                  <div><?php echo $client_name ?></div>
                <?php endforeach; endif; ?>
                </td>
              </tr>
              <?php endif ?>

              <?php foreach($arr_draw_area as $draw_area): ?>
              <?php if($draw_area["cts_type"] === "image" || $draw_area["cts_type"] === "movie"): ?>
              <tr>
              <th scope="row">Still picture switching interval (sec)</th>
              <td>
                <?php echo Html::chars($post["image_intvl"]) ?>
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
                  <th colspan="3" scope="col">Display area</th>
                </tr>

                <?php foreach($arr_draw_area as $draw_area): ?>
                  <?php if(isset($post["cts"][$draw_area["draw_area_id"]])): ?>
                  <?php $i = 0; ?>
                  <?php foreach ($post["cts"][$draw_area["draw_area_id"]] as $cts): ?>
                    <tr>
                    <?php if($i == 0): ?>
                    <td rowspan="<?php echo count($post["cts"][$draw_area["draw_area_id"]]) ?>" style="width:200px; text-align:center;">
                      Drawing area name:
                      <?php echo($draw_area["draw_area_name"])?><br />
                      Content classification:
                      <?php if($draw_area["cts_type"] === "movie"): ?>Video
                      <?php elseif($draw_area["cts_type"] === "sound"): ?>voice
                      <?php elseif($draw_area["cts_type"] === "image"): ?>Still image
                      <?php elseif($draw_area["cts_type"] === "text"): ?>telop
                      <?php endif ?><br />
                    </td>
                    <?php endif; ?>

                    <td style="width:20px; text-align:center;"><?php echo($i + 1); ?></td>
                    <td>
                    <?php if($draw_area["cts_type"] === "movie"): ?>
                      <?php echo Html::chars($arr_all_movie[$post["cts"][$draw_area["draw_area_id"]][$i]]) ?>
                    <?php elseif($draw_area["cts_type"] === "sound"): ?>
                      <?php echo Html::chars($arr_all_sound[$post["cts"][$draw_area["draw_area_id"]][$i]]) ?>
                    <?php elseif($draw_area["cts_type"] === "image"): ?>
                    <?php if(isset($arr_all_image[$draw_area["draw_area_id"]])): ?>
                      <?php echo Html::chars($arr_all_image[$draw_area["draw_area_id"]][$post["cts"][$draw_area["draw_area_id"]][$i]]) ?>
                    <?php endif ?>
                    <?php elseif($draw_area["cts_type"] === "text"): ?>
                      <?php echo Html::chars($arr_all_text[$post["cts"][$draw_area["draw_area_id"]][$i]]) ?>
                    <?php endif ?>
                    </td>
                    <?php $i++; ?>
                    </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                <?php endforeach; ?>

              </table>
            </div>
            <div class="image"><?php if(isset($arr_map_img[$post["draw_tmpl_id"]]['path'])): ?><img src="<?php echo $arr_map_img[$post["draw_tmpl_id"]]['path'] ?>" /><?php endif ?></div>
          </div>

          <div class="text_01">Confirm the above contents and press "confirm" button</div>
          <div class="btn_area_02">
            <?php echo Form::button(NULL, "Return", array("id" => "playlistall_ins_conf_back", "onclick" => "func_back2()", 'class'=>'btn1 btn_l')) ?>
            <?php echo Form::button(NULL, "Confirmation", array("id" => "playlistall_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
        <?php echo Form::close() ?>
        <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
