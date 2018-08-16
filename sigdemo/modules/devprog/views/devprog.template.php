
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Program guide list</div>
        </div>
      </div>
    </div>

    <div id="mainlist">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Program guide list</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "devprog_search_form")) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr><td>Playlist name</td><td><?php echo Form::select("playlist_id", $arr_playlist, HTML::replace_empty_array_value($post, "playlist_id"), array("id" => "devprog_playlist_id")) ?></td></tr>
                <tr><td>sex</td><td><?php echo Form::select("sex_id", $arr_sex,  HTML::replace_empty_array_value($post, "sex_id"),array("id" => "devprog_sex_id")) ?></td></tr>
                <tr><td>Delivery time zone</td><td><?php echo Form::select("timezone_id", $arr_time_zone,  HTML::replace_empty_array_value($post, "timezone_id"),array("id" => "devprog_timezone_id")) ?></td></tr>
                <tr><td>Distribution date and time</td>
                    <td><?php echo Form::input("devprog_date", $post["devprog_date"], array("id" => "devprog_devprog_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                    <td colspan="2"><?php echo Form::button(NULL, "検索", array("id" => "devprog_search", "type" => "submit", 'class'=>'btn3')) ?></td></tr>


              </table>
            <?php echo Form::close() ?>
          </div>

          <?php echo $pagination ?>

          <div style="height:600px; overflow-y:scroll;">
          <table class="tbl_01 tbl_yoko on">
            <tr>
              <th scope="col" class="th_width_prog_short"></th>
              <th scope="col" class="th_width_prog_short">sex</th>
              <th scope="col" class="th_width_prog_middle">Delivery time zone</th>
              <th scope="col" class="th_width_prog_middle">Contract client</th>
              <?php if(Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_SEL)): ?>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[0][1] . "<br />(" . $arr_date[0][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[1][1] . "<br />(" . $arr_date[1][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[2][1] . "<br />(" . $arr_date[2][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[3][1] . "<br />(" . $arr_date[3][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[4][1] . "<br />(" . $arr_date[4][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[5][1] . "<br />(" . $arr_date[5][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[6][1] . "<br />(" . $arr_date[6][2] . ")")?></th>
                <th scope="col" class="th_width_prog_days"><?php echo($arr_date[7][1] . "<br />(" . $arr_date[7][2] . ")")?></th>
              <?php endif ?>

            </tr>

            <?php $i=1; foreach ($arr_all_client as $client): ?>
              <?php foreach ($arr_all_playlist as $playlist): ?>
              <tr>
                <td class="td_text_center"><?php echo $i?></td>
                <td class="td_text_center"><?php if($playlist->sex_id === 1): ?>woman<?php else: ?>Man<?php endif ?></td>
                <td><?php echo(Kohana_HTML::entities(HTML::replace_empty_str($playlist, "timezone_name"))); ?></td>
                <td><?php echo($client->client_name); ?></td>

                <?php if(Auth::auth_check(MODULE_NAME_PROGVIEW, ACTION_SEL)): ?>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>

                    <?php if(!empty($arr_1st_line_prog)):?>

                      <?php foreach ($arr_1st_line_prog as $prog): ?>
                        <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>
                          <?php if($prog->common_playlist_name != ""):?>

                              <font size="-2">
                              <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_00_" . $prog->common_playlist_name), null, false))?><br />
                              <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_01_" . $prog->playlist_name), null, false))?><br />
                              </font>
                              <?php $tmp_data = 1; ?>
                            <?php endif ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>

                    <?php endif ?>

                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>

                      <?php if(!empty($arr_1st_line2_prog)):?>

                        <?php foreach ($arr_1st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>

                              <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_00_" . $playlist->playlist_id), null, false))?><br />
                              <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_01_" . $prog->playlist_name), null, false))?><br />

                              <?php $tmp_data = 1; ?>
                            <?php endif ?>
                            <?php endif ?>
                          <?php endif ?>
                        <?php endforeach; ?>

                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $playlist->playlist_id . "/" . $arr_date[0][0], "‐", array("id" => "devprog_devprogview_0_" . $playlist->playlist_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_2nd_line_prog)):?>
                      <?php foreach ($arr_2nd_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>

                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_10_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_11_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>
                      <?php endforeach; ?>
                    <?php endif ?>

                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_2nd_line2_prog)):?>
                      <?php foreach ($arr_2nd_line2_prog as $prog): ?>
                        <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                            <?php if($playlist->timezone_id == $prog->timezone_id):?>

                                <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_10_" . $playlist->playlist_id), null, false))?><br />
                                <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_11_" . $prog->playlist_name), null, false))?><br />
                                <?php $tmp_data = 1; ?>
                              <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>
                      <?php endforeach; ?>
                    <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[1][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_3rd_line_prog)):?>
                      <?php foreach ($arr_3rd_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_20_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_21_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_3rd_line2_prog)):?>
                        <?php foreach ($arr_3rd_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_20_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_21_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                        <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[2][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_4st_line_prog)):?>
                      <?php foreach ($arr_4st_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_30_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_31_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_4st_line2_prog)):?>
                        <?php foreach ($arr_4st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>

                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_30_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_31_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[3][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_5st_line_prog)):?>
                      <?php foreach ($arr_5st_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_40_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_41_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_5st_line2_prog)):?>
                        <?php foreach ($arr_5st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_40_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_41_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[4][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_6st_line_prog)):?>
                      <?php foreach ($arr_6st_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_50_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_51_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_6st_line2_prog)):?>
                        <?php foreach ($arr_6st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>

                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_50_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_51_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[5][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_7st_line_prog)):?>
                      <?php foreach ($arr_7st_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_60_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_61_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_7st_line2_prog)):?>
                        <?php foreach ($arr_7st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_60_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_61_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[6][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                  <td style="vertical-align: top ;">
                    <?php $tmp_data = 0; ?>
                    <?php if(!empty($arr_8st_line_prog)):?>
                      <?php foreach ($arr_8st_line_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <font size="-2">
                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_70_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_71_" . $prog->playlist_name), null, false))?><br />
                            </font>
                            <?php $tmp_data = 1; ?>
                          <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                      <?php endforeach; ?>
                    <?php endif ?>
                    <?php if($tmp_data == 0):?>
                      <?php $tmp_data = 0; ?>
                      <?php if(!empty($arr_8st_line2_prog)):?>
                      <?php foreach ($arr_8st_line2_prog as $prog): ?>
                          <?php if($client->client_name == $prog->client_name):?>
                          <?php if($playlist->sex_id == $prog->sex_id):?>
                          <?php if($playlist->timezone_id == $prog->timezone_id):?>


                            <?php echo(HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, $prog->common_playlist_name, array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_70_" . $playlist->playlist_id), null, false))?><br />
                            <?php echo(HTML::anchor("/" . MODULE_NAME_PLAYLIST,       $prog->playlist_name,     array("data-sex_id" => $prog->sex_id, "data-timezone_id" => $prog->timezone_id, "data-client_id" => $prog->client_id,  "id" => "devprog_devprogview_71_" . $prog->playlist_name), null, false))?><br />
                            <?php $tmp_data = 1; ?>
                            <?php endif ?>
                          <?php endif ?>
                        <?php endif ?>

                        <?php endforeach; ?>
                      <?php endif ?>
                      <?php if($tmp_data == 0):?>
<!--                        <?php echo(HTML::anchor("/" . MODULE_NAME_PROGVIEW . "/index/" . $dev->dev_id . "/" . $arr_date[7][0], "‐", array("id" => "devprog_devprogview_0_" . $dev->dev_id), null, false))?><br />
-->                      <?php endif ?>
                    <?php endif ?>
                  </td>

                <?php endif; ?>


              </tr>
              <?php $i++; endforeach; ?>
            <?php endforeach; ?>

          </table>

          <?php echo $pagination ?>
        </div>
      </div>
    </div>
    <!-- #/main -->
