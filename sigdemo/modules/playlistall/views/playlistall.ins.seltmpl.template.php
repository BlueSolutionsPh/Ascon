
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Playlist setting [Register all playlists]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "playlistall_ins_seltmpl_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Template selection</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "ins_seltmpl") ?>
          <?php echo Form::hidden("act", "seltmpl") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_01">
                <dt>Playlist name</dt>
                <dd>
                  <?php echo Form::input("playlist_name", HTML::replace_empty_array_value($post, "playlist_name"), array("id" => "playlistall_ins_seltmpl_playlist_name", "required" => "true", "maxlength" => "20", "size" => "50")) ?>
                  ※ Within 20 characters
                </dd>
                <?php if(SERVICE_ANTS_ONE_ENABLE === true): ?>
                  <dt>ant's classification</dt>
                  <dd>
                  <?php echo Form::select("ants_version", $arr_all_ants_version, HTML::replace_empty_array_value($post, "ants_version"), array("id" => "dev_ins_ants_version", "required" => "true", "onchange" => "antsChange('true')")) ?>
                  </dd>
                <?php else: ?>
                  <dt style="display: none;">ant's classification</dt>
                  <dd style="display: none;">
                  <?php echo Form::select("ants_version", $arr_all_ants_version, ANTS_TWO_KIND, array("id" => "dev_ins_ants_version", "required" => "true")) ?>
                  </dd>
                <?php endif ?>
                <dt>template</dt>
                <dd class="last">
                  <?php echo Form::select("draw_tmpl_id", $arr_all_draw_tmpl, HTML::replace_empty_array_value($post, "draw_tmpl_id"), array("id" => "playlistall_ins_seltmpl_draw_tmpl_id", "required" => "true")) ?>
                </dd>
              </dl>
            </div>
            <div style="display: block;" id="ants2">
              <div class="hr_wrapper_01 clearfix">
                <div class="clearfix">
                  <?php if(isset($arr_all_draw_tmpl['6'])){ ?>
                    <dl class="thum_temp" id="landscape_all_image">
                    <dt><img src="images/temp_02.png" width="200" height="140" alt="横全画面 (静止画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['6']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['5'])){ ?>
                    <dl class="thum_temp" id="landscape_all_movie">
                    <dt><img src="images/temp_06.png" width="200" height="140" alt="横全画面 (動画)"/></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['5']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['4'])){ ?>
                    <dl class="thum_temp" id="vertical_all_image">
                    <dt><img src="images/temp_05.png" width="140" height="200" alt="縦全画面 (静止画)" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['4']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['9'])){ ?>
                    <dl class="thum_temp" id="vertical_all_movie">
                    <dt><img src="images/temp_09.gif" width="140" height="200" alt="縦全画面 (動画)" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['9']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['8'])){ ?>
                    <dl class="thum_temp" id="divide_movie_image">
                    <dt><img src="images/temp_08.png" width="140" height="200" alt="縦分割 (動画＋静止画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['8']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                </div>
                <div>
                  <?php if(isset($arr_all_draw_tmpl['2'])){ ?>
                    <dl class="thum_temp" id="divide_image_image_telop">
                    <dt><img src="images/temp_03.png" width="140" height="200" alt="縦分割 (静止画＋静止画＋テロップ）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['2']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['1'])){ ?>
                    <dl class="thum_temp" id="divide_movie_image_telop">
                    <dt><img src="images/temp_01.png" width="140" height="200" alt="縦分割 (動画＋静止画＋テロップ）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['1']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['3'])){ ?>
                    <dl class="thum_temp" id="vertical_image_telop">
                    <dt><img src="images/temp_04.png" width="140" height="200" alt="縦分割なし (静止画＋テロップ）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['3']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['10'])){ ?>
                    <dl class="thum_temp" id="divide_telop_image_movie">
                    <dt><img src="images/temp_10.gif" width="140" height="200" alt="縦分割（テロップ＋静止画＋動画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['10']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['11'])){ ?>
                    <dl class="thum_temp" id="vertical_telop_image">
                    <dt><img src="images/temp_11.gif" width="140" height="200" alt="縦分割なし（テロップ＋静止画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['11']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['12'])){ ?>
                    <dl class="thum_temp" id="divide_telop_image_image">
                    <dt><img src="images/temp_12.gif" width="140" height="200" alt="縦分割（テロップ＋静止画＋静止画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['12']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                  <?php if(isset($arr_all_draw_tmpl['13'])){ ?>
                    <dl class="thum_temp" id="divide_image_movie">
                    <dt><img src="images/temp_13.gif" width="140" height="200" alt="縦分割（静止画＋動画）" /></dt>
                    <dd>＜<?php echo $arr_all_draw_tmpl['13']; ?>＞</dd>
                    </dl>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_PLAYLIST, "Return", array("id" => "playlistall_ins_seltmpl_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "playlistall_ins_seltmpl_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>

<script>
$(function(){
	antsChange('false');
});
</script>
    <!-- #/main -->
