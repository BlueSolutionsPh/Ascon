
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Terminal setting [Content playback frequency display by terminal]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "dllog_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>


    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Number of content playback indication by terminal</h3>
        <div class="content">
          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "playcnt_search_form")) ?>
            <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr>
                  <td>
                  start date<br />
                  <?php echo Form::input("sta_date", HTML::replace_empty_array_value($post, "sta_date"), array("id" => "sta_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                  ※YYYY-MM-DD
                  </td>
                </tr>
                <tr>
                  <td>
                  End date<br />
                  <?php echo Form::input("end_date", HTML::replace_empty_array_value($post, "end_date"), array("id" => "end_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                  ※YYYY-MM-DD
                  </td>
                </tr>
                <tr>
                <td>
                                           ※ When not specified, last 7 days,<br />
　                                       When specifying only the start date, it is 7 days after the start date,<br />
　                                       Display information for 7 days before end date when only end date is specified
                </td>
                </tr>
                <tr>
                  <td><?php echo Form::button(NULL, "Search", array("id" => "dllog_search", "type" => "submit", 'class'=>'btn3')) ?></td>
                </tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <div class="hr_wrapper_01">
            <h3>Number of content playback indication by terminal</h3>
            <p class="text01">
              <?php echo Form::label("shop_name", "Store name :") ?>
              <?php echo Form::label("shop_name", $shop_name) ?>
            </p>
            <p class="text01">
              <?php echo Form::label("dev_name", "Device name:") ?>
              <?php echo Form::label("dev_name", $dev_name) ?>
            </p>
            <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
              <p class="text01">
                <?php echo Form::label("ants_version", "ant's type & nbsp; & nbsp ;:") ?>
                <?php echo Form::label("ants_version", $arr_all_ants_version[$ants_version]) ?>
              </p>
            <?php endif ?>
            <p class="text01">
              <?php echo Form::label("st_dt", "Duration:") ?>
              <?php echo Form::label("st_dt", $st_dt) ?> ～ <?php echo Form::label("end_dt", $end_dt) ?>
            </p>
          </div>

          <?php echo $pagination ?>

          <?php if(!empty($arr_dev_playcnt)):?>
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col" width="20%">Playback content name</th>
                <th scope="col" width="10%">Content type</th>
                <th scope="col" width="20%">View count</th>
              </tr>

              <?php foreach ($arr_dev_playcnt as $dev_playcnt): ?>
              <tr>
                <td style="text-align:center;">
                  <?php echo(Kohana_HTML::entities($dev_playcnt["cts_name"])); ?>
                </td>
                <td style="text-align:center;">
                  <?php if($dev_playcnt["extension"] === "png"): ?>Still image
                  <?php elseif($dev_playcnt["extension"] === "mp4"): ?>Movie
                  <?php elseif($dev_playcnt["extension"] === "wmv"): ?>Movie
                  <?php elseif($dev_playcnt["extension"] === "mov"): ?>Movie
                  <?php elseif($dev_playcnt["extension"] === "swf"): ?>Flash
                  <?php elseif($dev_playcnt["extension"] === "aac"): ?>voice
                  <?php else:?>illegal
                  <?php endif ?>
                </td>
                <td style="text-align:center;">
                  <?php echo(Kohana_HTML::entities($dev_playcnt["cnt"]) . " Times"); ?>
                </td>
              </tr>
              <?php endforeach ?>
            </table>
          <?php endif ?>
          <?php echo $pagination ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
