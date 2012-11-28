<?



function referer_init(){
$referer = get_referer();
if (!$referer) return false;
$delimiter = get_delimiter($referer);
		if( $delimiter ){
			$term = get_terms($delimiter);		
 
			save_searchterms( $term );
 
		}
 
 
}
function get_referer() {
    if (!isset($_SERVER['HTTP_REFERER']) || ($_SERVER['HTTP_REFERER'] == '')) return false;
    $referer_info = parse_url($_SERVER['HTTP_REFERER']);
    $referer = $referer_info['host'];
    if(substr($referer, 0, 4) == 'www.')
        $referer = substr($referer, 4);
    return $referer;
}
 
function save_searchterms( $meta_value) {
	global $conn;   	
	if ( strlen($meta_value) > 3 ){
		$query= "INSERT INTO tags_search ( tag,counter ) VALUES (  '$meta_value', 1 )ON DUPLICATE KEY UPDATE counter = counter + 1";
		$success = mysql_query($query ) ;	
 
 
	}
	return $success;
}
 
 
function get_terms($d) {
    $terms       = null;
    $query_array = array();
    $query_terms = null;
    $query = explode($d.'=', $_SERVER['HTTP_REFERER']);
    $query = explode('&', $query[1]);
    $query = urldecode($query[0]);
    $query = str_replace("'", '', $query);
    $query = str_replace('"', '', $query);
    $query_array = preg_split('/[\s,\+\.]+/',$query);
    $query_terms = implode(' ', $query_array);
    $terms = htmlspecialchars(urldecode(trim($query_terms)));
    return $terms;
}
 
 
function get_delimiter($ref) {
    $search_engines = array('google.com' => 'q',
			'go.google.com' => 'q',
			'images.google.com' => 'q',
			'video.google.com' => 'q',
			'news.google.com' => 'q',
			'blogsearch.google.com' => 'q',
			'maps.google.com' => 'q',
			'local.google.com' => 'q',
			'search.yahoo.com' => 'p',
			'search.msn.com' => 'q',
			'bing.com' => 'q',
			'msxml.excite.com' => 'qkw',
			'search.lycos.com' => 'query',
			'alltheweb.com' => 'q',
			'search.aol.com' => 'query',
			'search.iwon.com' => 'searchfor',
			'ask.com' => 'q',
			'ask.co.uk' => 'ask',
			'search.cometsystems.com' => 'qry',
			'hotbot.com' => 'query',
			'overture.com' => 'Keywords',
			'metacrawler.com' => 'qkw',
			'search.netscape.com' => 'query',
			'looksmart.com' => 'key',
			'dpxml.webcrawler.com' => 'qkw',
			'search.earthlink.net' => 'q',
			'search.viewpoint.com' => 'k',
			'mamma.com' => 'query');
    $delim = false;
    if (isset($search_engines[$ref])) {
        $delim = $search_engines[$ref];
    } else {
        if (strpos('ref:'.$ref,'google'))
            $delim = "q";
		elseif (strpos('ref:'.$ref,'search.atomz.'))
            $delim = "sp-q";
		elseif (strpos('ref:'.$ref,'search.msn.'))
            $delim = "q";
		elseif (strpos('ref:'.$ref,'search.yahoo.'))
            $delim = "p";
        elseif (preg_match('/home\.bellsouth\.net\/s\/s\.dll/i', $ref))
            $delim = "bellsouth";
    }
    return $delim;
}

referer_init();

?>