

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content settings 【Delete all tickers】</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "text_del_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delete all tickers</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "lump_del") ?>
        <?php echo Form::hidden("act", "lump_del") ?>
        <?php for($i=0;$i<count($text_id);$i++){ ?>
        <?php echo Form::hidden("chk_text[$i]", $text_id[$i]); ?>
        <?php } ?>

          <div class="text_02">Delete the following telop?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th rowspan="<?php echo(count($text_name)); ?>" valign="top" align="left" width="20%">Telop name</th>
                <?php for($i=0;$i<count($text_name);$i++){ ?>
                <td><?php echo(Kohana_HTML::entities($text_name[$i])); ?></td>
              </tr>
              <?php } ?>
            </table>
          </div>

          <?php if ($arr_playlist): ?>
            <div class="hr_wrapper_01">
            <h3>It will also be deleted from the following playlist</h3>
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col" width="10%"></th>
                <th scope="col">Target playlist name</th>
              </tr>
              <?php $i=1; ?>
              <?php foreach ($arr_playlist as $playlist): ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo(Kohana_HTML::entities($playlist)) ?></td>
                </tr>
              <?php endforeach ?>
            </table>
            </div><!-- /box02 -->
          <?php endif ?>

          <div class="text_01">Target playlist name</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_TEXT, "Return", array("id" => "text_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "text_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main -->