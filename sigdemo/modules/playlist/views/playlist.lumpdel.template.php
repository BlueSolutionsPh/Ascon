

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Delete all playlists</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delete all playlists</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "lump_del") ?>
        <?php echo Form::hidden("act", "lump_del") ?>
        <?php for($i=0;$i<count($playlist_id);$i++){ ?>
        <?php echo Form::hidden("hoge[$i]", $playlist_id[$i]) ?>
        <?php } ?>

          <div class="text_02">Delete the following playlist?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th rowspan="<?php echo(count($playlist_name)); ?>" valign="top" align="left" width="20%">Playlist name</th>
                <?php for($i=0;$i<count($playlist_name);$i++){ ?>
                <td><?php echo(Kohana_HTML::entities($playlist_name[$i])); ?></td>
              </tr>
              <?php } ?>
            </table>
          </div>
          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_PLAYLIST, "Return", array("id" => "playlist_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "playlist_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
