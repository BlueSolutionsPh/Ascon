

    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Content settings [Delete all movies]</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delete all movies</h3>
        <div class="content">

        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "lump_del") ?>
        <?php echo Form::hidden("act", "lump_del") ?>
        <?php for($i=0;$i<count($movie_id);$i++){ ?>
        <?php echo Form::hidden("chk_movie[$i]", $movie_id[$i]) ?>
        <?php } ?>

          <div class="text_02">Delete the following movies?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th rowspan="<?php echo(count($movie_name)); ?>" valign="top" align="left" width="20%">Movie name</th>
                <?php for($i=0;$i<count($movie_name);$i++){ ?>
                <td><?php echo(Kohana_HTML::entities($movie_name[$i])); ?></td>
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

          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_MOVIE, "Return", array("id" => "movie_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "movie_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
