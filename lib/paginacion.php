<?php


function pagination_six($total_pages,$page,$prev,$post,$pages,$resultados,$url){
//echo "$total_pages,$page,$prev,$post,$pages,$resultados,$url";
    global $webpage;
	
	$accion=$_GET['accion'];
	 
	if($resultados==""){
	$resultados=50;
	}
   $pagination = "<style type=\"text/css\">

.pagination{
padding: 2px;
}

.pagination ul{
margin: 0;
padding: 0;
text-align: left; /*Set to \"right\" to right align pagination interface*/
font-size: 16px;
}

.pagination li{
list-style-type: none;
display: inline;
padding-bottom: 1px;
font: 10px  \"Trebuchet MS\", Verdana, Helvetica, Arial, sans-serif ; 


}

.pagination a, .pagination a:visited{
padding: 0 5px;
border: 1px solid #9aafe5;
text-decoration: none; 
color: #2e6ab1;
}

.pagination a:hover, .pagination a:active{
border: 1px solid #2b66a5;
color: #000;
background-color: #FFFF80;
}

.pagination a.currentpage{
background-color: #2e6ab1;
color: #FFF !important;
border-color: #2b66a5;
font-weight: bold;
cursor: default;
}

.pagination a.disablelink, .pagination a.disablelink:hover{
background-color: white;
cursor: default;
color: #929292;
border-color: #929292;
font-weight: normal !important;
}

.pagination a.prevnext{
font-weight: bold;

}

</style>
<div class=\"pagination\" >
                    <ul >";
                    
    if($total_pages!=1){
    
	
        //the total links visible
          
        $max_links=10;
        
        
        //$max links_marker is the top of the loop
        //$h is the start
        
        $max_links_marker = $max_links+1;            
        $h=1;            
        
        
        //$link_block is the block of links on the page
        //When this is an integer we need a new block of links
                  
        $link_block=(($page-1)/$max_links);
        
        //if the page is greater than the top of th loop and link block
        //is an integer
        
        if(($page>=$max_links_marker)&&(is_int($link_block))){
        
                //reset the top of the loop to a new link block
        
            $max_links_marker=$page+$max_links;
            
                //and set the bottom of the loop         
            
            $h=$max_links_marker-$max_links;
            $prev=$h-1;                                                                    
        }
        
            //if not an integer we are still within a link block
        
        elseif(($page>=$max_links_marker)&&(!is_int($link_block))){
            
                //round up the link block
            
            $round_up=ceil($link_block);
                    
            $new_top_link = $round_up*$max_links;
            
                //and set the top of the loop to the top link
            
            $max_links_marker=$new_top_link+1;
            
                //and the bottom of the loop to the top - max links
            
            $h=$max_links_marker-$max_links;
            $prev=$h-1;                            
        }
        
          //if greater than total pages then set the top of the loop to
          // total_pages
        
        if($max_links_marker>$total_pages){
            $max_links_marker=$total_pages+1;
        }
        
            //first and prev buttons
        
        if($page>'1'){
		$page_ant=$page -2;
				$post_ant= ($page_ant *$resultados) -1;
				$prev_ant= $post_ant - $resultados +1;
				
		//echo "$prev&pos=$post   $prev_sig  $post_sig <br>";
		$ant_pag="page=".($page-2)."&nav=prev&pre=$prev_ant&pos=$post_ant&pages=$pages&view=view".$url;
		
            $pagination.="<li class=\"current\"><a href=\"?accion=$accion".$webpage."\">Inicio</a></li>
            <li class=\"current\"><a href=\"".$webpage."?accion=$accion&".$ant_pag."$url>Ant</a></li>";
        }
        
           
        
        $prev_start = $h-$max_links; 
        $prev_end = $h-1;
        if($prev_start <=1){
            $prev_start=1;
        }
        $prev_block = "Pag $prev_start de $prev_end";
        
        if($page>$max_links){
			
			$post_block_prev = $post -($resultados*2);
			$prev_block_prev = $post -($resultados*3) +1;
			
			$url_pag="page=".($prev)."&nav=prev&pre=$prev_block_prev&pos=$post_block_prev&pages=$pages&view=view".$url;
        
            $pagination.='<li class="current"><a href="'.$webpage."?accion=$accion&".$url_pag.'"  >'.$prev_block.'</a></li>';
      
	    }
        
            //loop through the results
            
        for ($i=$h;$i<$max_links_marker;$i++){
            if($i==$page){
				
				$prev_sig= ($i-1) *$resultados;
				$post_sig= $prev_sig + $resultados - 1;
				//$post_sig= ($prev +$resultados) ;
				/*
				
				echo "
				<br>
				$prev_sig= ($i-1) *$resultados;<br>
				$post_sig= $prev_sig +$resultados -1 ;<br>
				pre=$prev_sig&pos=$post_sig<br>";
				*/
				$sig_pag="page=".($page)."&nav=next&pre=$prev_sig&pos=$post_sig&pages=$pages&view=view".$url;
        	
                $pagination.= '<li><a class="currentpage">'.$i.'</a></li>';
				
            }
            else{
				//$prev= $prev+$resultados;
				//$post= $post +$resultados;
				
				$prev= ($i-2) *$resultados;
				$post= ($prev +$resultados) -1;
				
				$url_pag="page=".($i-1)."&nav=next&pre=$prev&pos=$post&pages=$pages&view=view".$url;
        
                $pagination.= '<li><a href="'.$url.$webpage."?accion=$accion&".$url_pag.'">'.$i.'</a></li>';
				
            }
        }
            //provide a link to the next block o links
        
        $next_start = $max_links_marker; 
        $next_end = $max_links_marker+$max_links;
        if($next_end >=$total_pages){
            $next_end=$total_pages;
        }
        $next_block = "Pag $next_start de $next_end";
        if($total_pages>$max_links_marker-1){
				
				$prev= ($i-2) *$resultados;
				$post= ($prev +$resultados) -1;
				
				$url_pag="page=".($i-1)."&nav=next&pre=$prev&pos=$post&pages=$pages&view=view".$url;
        
            $pagination.='<li class="current"><a href="'.$webpage."?accion=$accion&".$url.$url_pag.'">'.$next_block.' </a></li>';
        }
        
          //link to next and last pages
        
        
        if(($page >="1")&&($page!=$total_pages)){
        	
        	
		
			$ult_pag="page=".($total_pages)."&nav=next&pre=$prev&pos=$post&pages=$pages&view=view";
        
            $pagination.='<li class="current"><a href="'.$webpage."?accion=$accion&".$url.$sig_pag.'">Sig</a></li>
                  <li class="current"><a href="'.$webpage."?accion=$accion&".$url.$ult_pag.'">Fin</a></li>';
            
      
        }
    }
    
    //if one page of results
    
    else{
    	
	
    	
    $pagination.='<li><a href="" class="current">1</a></li>';
    }
    $pagination.='</ul>
        </div>';
    
    return($pagination);
}
















//---------------------------------------------------------------------------------------
////////////////////////////////////////////
//  PAGINATION FUNCTION  //
//  by: Karl Steltenpohl          //
////////////////////////////////////////////
function pagination($table, $order, $searchstring, $pre, $pos, $nav, $page, $pages,$resultados)
{
//echo "$table, $order, $searchstring, $pre, $pos, $nav, $page, $pages,$resultados";	
	
if($resultados==""){
	$resultados=50;
	}

///////////////////////
//  Get Current Url  //
///////////////////////
$webpage = basename($_SERVER['PHP_SELF']);
global $webpage;
 
////////////////////////
//  Sorter and Pagination Query Begin  //
/////////////////////////////////////////
$pre = $_REQUEST['pre'];
$pos = $_REQUEST['pos'];
$nav = $_REQUEST['nav'];
$page = $_REQUEST['page'];
$pages = $_REQUEST['pages'];

 

///////////////////////////////////////////
//  Set Initial Pre Pos and Page Limits  //
///////////////////////////////////////////

if($pre == "" and $pos == "" and $page == "" )
{
$pre = 0;
$pos = $resultados-1;
$page = 1;

}
 

///////////////////////////////
//  User Navigates Previous  //
///////////////////////////////
if($nav == "prev")
{
$pre = ($pre - $resultados);
$pos = ($pos - $resultados);
$page = ($page - 1);
}
 

///////////////////////////
//  User Navigates Next  //
///////////////////////////
if($nav == "next")
{
$pre = ($pre + $resultados);
$pos = ($pos + $resultados);
$page = ($page + 1);
}
 

/////////////////////////////
//  If page number to low  //
/////////////////////////////
if($page < 1)
{
$pre = 0;
$pos = $resultados-1;
$page = 1;
}
 
//////////////////////////////
//  If page number to high  //
//////////////////////////////
if($page > $pages)
{
$pre = 0;
$pos = $resultados-1;
$page = 1;
}
 

//////////////////////////////////////////
//  Select for total number or results  //
//////////////////////////////////////////
$r = "SELECT * FROM $table $searchstring";
//echo $r;
//$r = "SELECT DISTINCT * FROM $table $searchstring";
$re = cms_query($r) or die (error($r,mysql_error(),$php));
$nums = mysql_num_rows($re);
 

////////////////////////////////////////////
//  Select for current displayed results  //
////////////////////////////////////////////
$request = "SELECT  * FROM $table $searchstring ORDER BY $order DESC LIMIT $pre, $resultados";


//$request = "SELECT DISTINCT * FROM $table $searchstring ORDER BY $order DESC LIMIT $pre, $resultados";
$result = cms_query($request) or die("error 25352 $request");
$num = mysql_num_rows($result);
 

///////////////////////////////////////
//  Determine total number of pages  //
///////////////////////////////////////
$pages = ceil($nums/$resultados);
 

/////////////////////////////////
//  Create Navigation Display  //
///////////////////////////////// 
$page_next= $page+1;
$navigation = "
$nums entries on $pages Page(s)<br>
<a href=\"$webpage?page=$page&nav=prev&pre=$pre&pos=$pos&pages=$pages&view=view\">Previous</a> |
Page $page |$page_next
<a href=\"$webpage?page=$page&nav=next&pre=$pre&pos=$pos&pages=$pages&view=view\">Next</a><br>
Results $pre - $pos
";
 
/////////////////////////////////
//  Create Paginagtion Array   //
/////////////////////////////////
// result is the result of the limited query


$pagination = array($navigation, $result, $num,$pages ,$page,$pre,$pos);
 

/////////////////////////////////
//  Return Paginagtion Array   //
/////////////////////////////////
return $pagination;
}//end function
 
 
 
//--------------------------------------------------------------------------------------------
//Here is an example of how to impliment it
//------------------------------------------------------------------------------------------
 if($resultados!="" and $searchstring!="" and $table!="" and $order!=""){
 
 /*
 ejemplo de llenado de variables 
 * 
 * 
 * desplegar 50 resultados por consulta
 $resultados = 50;
 
 //this is the search string to the sql db
 $searchstring = "WHERE 1 
		   $cond_tipo
		   $cond_marca
		   $cond_modelo
		   AND anio > $anio_ini AND anio < $anio_final
		   AND valor >= $valor_ini AND valor <= $valor_final
		   AND estado <> 'of'";
 
 //this is the table being searched
 $table = "auto";
 
 //this is the table field to order the results by
 $order = "valor";

 
 */
 
 // call the function
 $pagination = pagination($table, $order, $searchstring, $pre, $pos, $nav, $page, $pages,$resultados,$url);
 
 //this pulls out the display
 $navigation = $pagination[0];
 
 //this pulls out the results
 $result = $pagination[1];
 
 //this pulls out the num of results
 $num = $pagination[2];
 
 $paginas = $pagination[3];
 
 $pagina = $pagination[4];
 $pre = $pagination[5];
 $pos=$pagination[6];
 
 //echo the display onto the site
// echo"$navigation";
 $limite = "LIMIT $pre, $resultados";
 //now all you need to do is loop the result based on the num
 //each page will display 10 results.

//echo "$paginas, $pagina,$pre,$pos,$paginas,$resultados,$url llldsfdsf";
$paginas= pagination_six($paginas, $pagina,$pre,$pos,$paginas,$resultados,$url);



}else{

 echo  "<script>alert('Debes configurar bien las variabes \"resultados searchstring table  order\" al parecer una de estas esta vacia,se deben llenar antes del include.'); document.location.href='index.php'; </script>\n";


}
?>