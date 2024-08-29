<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 function format_amount($amount = 0, $symbol=true, $symbol_placement='before'){
	if($symbol){
		$CI =& get_instance();
		$currency = $CI->SiteModel->getcolumn('sitesetup','Currency');
	}
	$formatted_amt = number_format($amount, 2);

	if($symbol_placement=='after'){
		$formatted_amt = (isset($currency)) ? $formatted_amt.$currency : $formatted_amt;
	}
	else{
		$formatted_amt = (isset($currency)) ? $currency.$formatted_amt : $formatted_amt;
	}
	return $formatted_amt;
}

function get_siteconfig($key = '')
{
	$CI =& get_instance();
	$setting = $CI->SiteModel->get_siteconfig($key);
	return $setting;
}











 

function invoice_status($status = 'UNPAID'){
	if($status == 'UNPAID')
		$class = 'invoice_status_unpaid';
	 elseif ($status == 'PAID') 
	 	$class = 'invoice_status_paid';
	 elseif ($status == 'CANCELLED') 
	 	$class = 'invoice_status_cancelled';
	 else
	 	$class = 'invoice_status_unpaid';

	$html = '<div class=" '. $class .' pull-right"> '. $status .' </div>';
	return $html;
}
function status_label($status = 'UNPAID'){
	if($status == 'UNPAID')
		$class = 'warning';
	 elseif ($status == 'PAID') 
	 	$class = 'success';
	 elseif ($status == 'CANCELLED') 
	 	$class = 'danger';
	 else
	 	$class = 'warning';

	$html = '<span class="label label-'. $class .' ">'.$status.'</span>';
	return $html;
}

function send_email($subject  = '', $to = '',  $body = '', $attachment = ''){
	$CI =& get_instance();

	$company = get_siteconfig('name');
	$email 	 = get_siteconfig('email');

	if(empty($email) || $email  == ''){
		return false;
	}
	elseif(empty($company) || $company == ''){
		return false;
	}
	else{
		$from_email = $email ;
		$from_name = $company;

		$CI->load->library("email");
		$CI->email->set_mailtype('text');
		$CI->email->set_newline("\r\n");
		$CI->email->from($from_email, $from_name);
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body);
		
		if($attachment != '')
		$CI->email->attach($attachment);

		if($CI->email->send()){
			return true;
		}

	}
}

function date_format_select($selected = ''){
	$formats = array('d/m/Y' => date('d/m/Y'),
					 'm/d/Y' => date('m/d/Y'),
					 'Y/m/d' => date('Y/m/d'),
					 'F j, Y' => date('F j, Y'),
					 'm.d.y' => date('m.d.Y'),
					 'd-m-Y' => date('d-m-Y'),
					 'D M j Y' => date('D M j Y'),
			
	);
	$select = form_dropdown('date_format', $formats, $selected,  'class="form-control selectpicker" data-live-search="true" id="date_format"');
	return $select;
}

function format_date($date = ''){
	$date_config = get_siteconfig('date_format'); 
	$date_format = ($date_config != '' ) ? $date_config : 'd-m-Y' ;
	$formated_date = date($date_format, strtotime($date));
	return $formated_date;
}
 










 
 
function str_replace_nth($search, $replace, $subject, $nth) {
    $found = preg_match_all('/' . preg_quote($search) . '/', $subject, $matches, PREG_OFFSET_CAPTURE);
    if (false !== $found && $found > $nth) {
        return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
    }
    return $subject;
}

//echo str_replace_nth('?', 'username', $subject, 1);



 
 
function utf8_slug($text) {
    $text = trim(preg_replace('/[^\p{L}\p{M}\p{N}-]/u', '-', $text));
    return $text;
}


 



 











 function current_full_url()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

	function banglaformat($date){
		$engArray = array(
		1,2,3,4,5,6,7,8,9,0,
		'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
		'am', 'pm','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'
		);
		$bangArray = array(
		'১','২','৩','৪','৫','৬','৭','৮','৯','০',
		'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',
		'সকাল', 'দুপুর',  'শনিবার' , 'রবিবার', 'সোমবার','মঙ্গলবার','বুধবার', 'বৃহস্পতিবার','শুক্রবার');

		$converted = str_replace($engArray, $bangArray, $date);
		return $converted;
		}

function getBanglaDate($date){
 $engArray = array(
 1,2,3,4,5,6,7,8,9,0,
 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
 'am', 'pm','Sun','Mon','Tue','Wed','Thu','Fri','Sat'
 );
 $bangArray = array(
 '১','২','৩','৪','৫','৬','৭','৮','৯','০',
 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',
 'সকাল', 'দুপুর','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার','শনিবার'
 );

 $converted = str_replace($engArray, $bangArray, $date);
 return $converted;
}







?>