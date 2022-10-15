<?php

if( !function_exists('check_adm_login') ){

	function check_adm_login(){

		$_CI = &get_instance();

		$username = $_CI->session->userdata( md5('username') ); 
		$password = $_CI->session->userdata( md5('password') );

		$result = $_CI->db->query("select * from users where username = '$username' and password = '$password' LIMIT 1");

		return ($result->num_rows() > 0);		
	}

}

if( !function_exists('role') ){
	function role( $role ){

		$_CI = &get_instance();

		$username = $_CI->session->userdata( md5('username') ); 
		$password = $_CI->session->userdata( md5('password') );

		$result = $_CI->db->query("select role from users where username = '$username' and password = '$password' LIMIT 1")->row();
		
		return ( strtolower($role) == strtolower($result->role)); 
	}
}