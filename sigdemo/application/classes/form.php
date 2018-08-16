<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {
	public static function radio_progrgl_ins($post, $idx, $dow){
		if(isset($post[$dow]) && $post[$dow] !== ""){
			if((string)$post[$dow] === (string)$idx){
				return Form::radio($dow, $idx, false, array("id" => "progrgl_ins_" . $dow . "_" . $idx, "checked" => "true", "onclick" => "func_change_dow();"));
			} else {
				return Form::radio($dow, $idx, false, array("id" => "progrgl_ins_" . $dow . "_" . $idx, "onclick" => "func_change_dow();"));
			}
		} else {
			if($idx === 0){
				return Form::radio($dow, $idx, false, array("id" => "progrgl_ins_" . $dow . "_" . $idx, "checked" => "true", "onclick" => "func_change_dow();"));
			} else {
				return Form::radio($dow, $idx, false, array("id" => "progrgl_ins_" . $dow . "_" . $idx, "onclick" => "func_change_dow();"));
			}
		}
	}
	public static function radio_progrgl_up($post, $idx, $dow){
		if(isset($post[$dow]) && $post[$dow] !== ""){
			if((string)$post[$dow] === (string)$idx){
				return Form::radio($dow, $idx, false, array("id" => "progrgl_up_" . $dow . "_" . $idx, "checked" => "true", "onclick" => "func_change_dow();"));
			} else {
				return Form::radio($dow, $idx, false, array("id" => "progrgl_up_" . $dow . "_" . $idx, "onclick" => "func_change_dow();"));
			}
		} else {
			if($idx === 0){
				return Form::radio($dow, $idx, false, array("id" => "progrgl_up_" . $dow . "_" . $idx, "checked" => "true", "onclick" => "func_change_dow();"));
			} else {
				return Form::radio($dow, $idx, false, array("id" => "progrgl_up_" . $dow . "_" . $idx, "onclick" => "func_change_dow();"));
			}
		}
	}
}
