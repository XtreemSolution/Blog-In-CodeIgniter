<?php 
function showLimitedText($string,$len = 10) 
{
	$string = strip_tags($string);
	if (strlen($string) > $len)
		$string = mb_substr($string, 0, $len-3) . "...";
	return $string;
}


if (!function_exists('pr')) {

    function pr($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

if(!function_exists('escape_text')){
  function escape_text($s = ''){
      return str_replace('&#039;', "'", htmlspecialchars_decode(html_entity_decode($s)));
  } 
}

function getSiteOption($key = '', $value = false){
  	if($key == ''){
    	return false;
  	}
  	$CI = & get_instance();
  	$CI->load->model('admin/website_model', 'website');
  	$value = $CI->website->getValueBySlug($key, $value);
  	return $value;
}

if(!function_exists('is_logged_in')){
  function is_logged_in(){
    global $CI;
    $CI = & get_instance(); 
    if($CI->session->userdata('admin_id')){
       return true;
    }
    else
    {
       return false;
    } 
    return false;
  }
}

function getMailConstants(){
  $constants = [
    'Logo'                => '{{Logo}}',
    'Email_Address'       => '{{Email_Address}}',
    'Subject'             => '{{Subject}}',
    'Website_UR'          => '{{Website_URL}}',
    'Unsubscription_Link' => '{{Unsubscription_Link}}',
  ];
  return $constants;
}

function getImageURL($content)
{
    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $img);       
    $url = $img[1];
    if($url)
    {
        return $url;
    }
    else
    {
        return false;
    }
}
