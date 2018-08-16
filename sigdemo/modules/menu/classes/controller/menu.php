<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Menu extends Controller_Template {
	public $template = 'menu.template';

	public function action_index(){
		parent::action_index_before();

		//Login check
		$this->login_check();

		//Confirmation screen Retain all information (provisional countermeasure)
		$this->session->delete("authgrp.ins_post");
		$this->session->delete("authgrp.up_post");
		$this->session->delete("booth.ins_post");
		$this->session->delete("booth.up_post");
		$this->session->delete("client.ins_post");
		$this->session->delete("client.up_post");
		$this->session->delete("commonimage.ins_file");
		$this->session->delete("commonimage.ins_post");
		$this->session->delete("commonimage.up_post");
		$this->session->delete("commonmovie.ins_file");
		$this->session->delete("commonmovie.ins_post");
		$this->session->delete("commonmovie.up_post");
		$this->session->delete("commontext.ins_post");
		$this->session->delete("commontext.up_post");
		$this->session->delete("dev.ins_post");
		$this->session->delete("dev.up_post");
		$this->session->delete("devhtml.ins_post");
		$this->session->delete("html.ins_file");
		$this->session->delete("html.ins_post");
		$this->session->delete("html.up_post");
		$this->session->delete("image.ins_file");
		$this->session->delete("image.ins_post");
		$this->session->delete("image.up_post");
		$this->session->delete("movie.ins_file");
		$this->session->delete("movie.ins_post");
		$this->session->delete("movie.up_post");
		$this->session->delete("playlist.ins_seltmpl_post");
		$this->session->delete("playlist.ins_clitmpl_post");
		$this->session->delete("playlist.ins_post");
		$this->session->delete("playlist.up_post");
		$this->session->delete("playlistall.ins_post");
		$this->session->delete("prog.ins_post");
		$this->session->delete("progrgl.ins_post");
		$this->session->delete("progrgl.up_post");
		$this->session->delete("shop.ins_post");
		$this->session->delete("shop.up_post");
		$this->session->delete("tag.ins_post");
		$this->session->delete("text.ins_post");
		$this->session->delete("text.up_post");
		$this->session->delete("timezone.up_post");
		$this->session->delete("user.ins_post");
		$this->session->delete("user.up_post");
		$this->session->delete("soundall.ins_post");
		$this->session->delete("soundall.ins_file");

		$this->template->arr_action_result = $this->get_action_result();
		$this->template->irregular_msg = $this->session->get(SESS_IRREGULAR_DISP_MSG, "");
		$this->session->delete(SESS_IRREGULAR_DISP_MSG);
	}
}
