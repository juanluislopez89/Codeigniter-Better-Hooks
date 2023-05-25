<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->library('betterhooks');

$CI->betterhooks->add_action('before_home_profile', 'before_home_profile_callback', 10);
$CI->betterhooks->add_action('before_home_profile', 'before_home_profile_callback2', 10);


function before_home_profile_callback($params){
	echo '<strong class="text-'.$params['color'].'"><i class="fa fa-check"></i> Hooked before home profile!</strong><br>';
}

function before_home_profile_callback2(){
	echo '<strong class="text-danger"><i class="fa fa-check"></i> Hooked before home profile 2 with no params!</strong><br>';
}
