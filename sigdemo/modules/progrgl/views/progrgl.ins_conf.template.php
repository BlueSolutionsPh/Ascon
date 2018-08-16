
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text"> Program guide setting [Program guide (repeated designation) registration]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "progrgl_ins_conf_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <div class="box_01">
        <h3 class="title"> Program guide (repeated designation) registration</h3>
        <div class="content">

            <?php echo Form::open(null, array("id" => "form")) ?>
            <?php echo Form::hidden("token", $token) ?>
            <?php echo Form::hidden("disp", "ins") ?>
            <?php echo Form::hidden("act", "ins", array("id" => "act")) ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>Terminal<span style="margin-left: 10px;"><?php if($post["arr_dev"]){ echo count($post["arr_dev"]) . ' set'; } ?></span></dt>
                <dd>
                  <?php if($post["arr_dev"]): ?>
                    <?php foreach($post["arr_dev"] as $dev_id): ?>
                      <?php echo Html::chars($arr_all_dev[$dev_id]) ?><br />
                    <?php endforeach; ?>
                  <?php else: ?>
                    -
                  <?php endif; ?>
                </dd>
              </dl>
            </div>

            <div class="hr_wrapper_01">
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <th id="<?php echo("th_dow[" . $i . "]")?>" scope="col">
                    By day of the week<?php echo($i + 1)?><br />
                    <?php $weeks = array(); ?>
                    <?php foreach ( array('mon'=>'Month','tues'=>'fire','wednes'=>'water','thurs'=>'wood','fri'=>'Money','satur'=>'soil','sun'=>'Day') as $week => $week_jp ): ?>
                      <?php if ($post[$week] === (string)$i): ?>
                        <?php $weeks[] = $week_jp ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    <?php echo ( $weeks ) ? implode(',', $weeks) : 'なし'; ?>
                  </th>
                <?php endfor ?>
              </tr>
              <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                <td>
                  base<br>
                  All day&#12288;
                  <?php echo Html::chars($arr_all_playlist[$post["base"][$i]]) ?>
                </td>
                <?php endfor ?>
              </tr>

              <?php for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++):?>
                <tr>
                <?php for($i = 0; $i < MAX_PROGRGL_DOW; $i++):?>
                  <td>
                  <?php echo Html::chars($post["sta_time"][$i][$j]) ?> 〜 <?php echo Html::chars($post["end_time"][$i][$j]) ?>
                  <?php echo Html::chars($arr_all_playlist[$post["playlist"][$i][$j]]) ?><br />
                  </td>
                <?php endfor ?>
                </tr>
              <?php endfor ?>

            </table>
            </div>

            <div class="text_01">Confirm the above contents and press "confirm" button</div>
            <div class="btn_area_02">
              <?php echo Form::button(NULL, "Return", array("id" => "progrgl_ins_conf_back", "type" => "submit", 'class'=>'btn1 btn_l', 'onclick'=>'$("#act").val("back")')) ?>
              <?php echo Form::button(NULL, "Confirmation", array("id" => "progrgl_ins_conf_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>

        </div>
      </div>
    </div>
    <!-- #/main -->
