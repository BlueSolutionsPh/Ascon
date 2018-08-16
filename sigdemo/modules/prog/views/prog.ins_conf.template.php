
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Program guide setting [Program guide (date and time designation) registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "prog_ins_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <div class="box_01">
        <h3 class="title">Program guide (date designation) registration</h3>
        <div class="content">

            <?php echo Form::open(null, array("id" => "form")) ?>
            <?php echo Form::hidden("token", $token) ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Distribution start date and time</dt>
                <dd>
                  <?php echo Html::chars($post["sta_dt"]) ?>
                </dd>
                <dt>Delivery end date and time</dt>
                <dd>
                  <?php echo Html::chars($post["end_dt"]) ?>
                </dd>
                <dt>playlist</dt>
                <dd>
                  <?php echo $arr_all_playlist[$post["ch_1"]] ?>
                </dd>
                <dt>Terminal <span style="margin-left: 10px;"><?php if($post["arr_dev"]){ echo count($post["arr_dev"]) . ' 台'; } ?></span></dt>
                <dd>
                  <?php if($post["arr_dev"]): ?>
                    <?php foreach($post["arr_dev"] as $dev_id): ?>
                      <?php echo Html::chars($arr_all_dev[$dev_id]) ?><br />
                    <?php endforeach; ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>
                </dd>
                <?php if(isset($post["over_write"]) && $post["over_write"] === "true"): ?>
                  <dt>Program to be overwritten</dt>
                  <dd>
                    <table class="tbl_01 tbl_yoko on">
                      <tr>
                        <th scope="col" style="width:40px"></th>
                        <th scope="col">Device name</th>
                        <th scope="col" style="width:30px;">operation</th>
                        <th scope="col" style="width:110px;">Start date and time</th>
                        <th scope="col" style="width:110px;">End date and time</th>
                       <th scope="col">Playlist name</th>
                      </tr>
                      <?php foreach($arr_effe_rec as $i => $effe_rec): ?>
                        <?php foreach($effe_rec["arr_prog"] as $prog): ?>
                        <tr>
                          <td style="text-align:center;"><?php echo ++$i; ?></td>
                          <td><?php echo Kohana_HTML::entities(HTML::replace_empty_array_value($effe_rec, array("dev_name"))) ?></td>
                          <?php if(empty($prog["sta_dt_after"]) && empty($prog["end_dt_after"])): ?>
                            <td style="text-align:center;">Delete</td>
                            <td style="text-align:center;"><?php echo $prog["sta_dt"] ?></td>
                            <td style="text-align:center;"><?php echo $prog["end_dt"] ?></td>
                          <?php else: ?>
                            <td style="text-align:center;">update</td>
                            <td style="text-align:center;"><?php echo $prog["sta_dt"] ?><br>↓<br><?php echo $prog["sta_dt_after"] ?></td>
                            <td style="text-align:center;"><?php echo $prog["end_dt"] ?><br>↓<br><?php echo $prog["end_dt_after"] ?></td>
                          <?php endif ?>
                          <td><?php echo Kohana_HTML::entities(HTML::replace_empty_array_value($prog, array("playlist_name"))) ?></td>
                        <?php endforeach; ?>
                      <?php endforeach; ?>
                    </table>
                  </dd>
                <?php endif ?>
              </dl>
            </div>

            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "prog_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>'$("#act").val("back")')) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "prog_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
