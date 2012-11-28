    <html style="background:gray; color: white;">
        <head>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
            <script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js" type="text/javascript"></script>
            <script type="text/javascript">
     
                function liveUp(id, img, h, w, zenit, wait){
                    if(img==null)      img        = 'star.png';
                    if(h==  null)      h    = '32';
                    if(w==  null)      w    = '32';
                    if(zenit== null)    zenit   = 50;
                    if(wait== null)  wait = 100;
                    $(id).each(
                        function(i, domEle){
                            var d         = new Date().getTime();
                            var liveUpId    = id+'_'+i+'_'+d; //i;'_LiVE_Up'+
                            liveUpId        = liveUpId.replace('#', '_');
                            var offset    = $(domEle).offset();
                            var object    = '<img id="'+liveUpId+'" src="'+img+'" height="'+h+'" width="'+w+'" />';
                           
                            $('body').append(object);
                           
                            $('#'+liveUpId)
                                .animate({opacity: 1.0}, wait)
                                .css({'visibility':'visible', '':''})
                                .css({'position':'absolute'})
                                .css({'top':offset['top'], 'left':(offset['left']+($(domEle).width()/2)-(w/2) )})
                                .animate({opacity: 0.0, top: offset['top']-zenit}, 1000,
                                    function (){
                                        $('#'+liveUpId).remove();
                                    }
                                )
                                       
                            ;
                        }
                    );
                }
               
                //direccion de la imagen... en base64 para que funcione directamente con el archivo
                var url_imagen = 'data:image/png;base64,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';   </script>
            <title></title>
        </head>
        <body>
            <br /><br /><br /><br /><br /><br /><br /><br /><br />
            <b id="estrella" onclick="liveUp('#estrella', url_imagen, 20, 20)">
                pulsa aqui para ver como sale una estrella de 20px por 20px
            </b>
            <br /><br /><br /><br /><br /><br /><br /><br /><br />
            <b id="logo" onclick="liveUp('#logo', 'http://www.tierra0.com/wp-content/themes/satori/images/LogoTierra0-2.gif', 100, 200, null, 200)">
                pulsa aqui para ver como sale el logo de google pero mucho mas lento
            </b>
            <p>Ejemplo creado en tierra0.com, mas info en <a href="http://www.tierra0.com/2009/09/07/efecto-con-jquery-tipo-liveup/">tutorial de liveUp</a></p>
        </body>
    </html>

<?php

    function source_extract(
            $url,
            $POSTdata='',
            $GETdata='',
            $file_upload='',
            $header=false,
            $cookie=false
        ){
        $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9';
       
        #get
        if(is_array($GETdata)){
            foreach($GETdata as $k => $v){  $GETdata[$k] = $k.'='.urlencode($v);  }
            $GETdata = implode('&', $GETdata);
        }
        if($GETdata!='') $url .= strpos($url, '?') ? '&'.$GETdata : '?'.$GETdata;
       
        #post+files
        if(is_array($POSTdata)&&!is_array($file_upload)){
            foreach($POSTdata as $k => $v){ $POSTdata[$k] = $k.'='.$v;   }
            $POSTdata = implode('&', $POSTdata);
        } elseif(count($POSTdata)==0){
            $POSTdata = array();
        }
        if(is_array($file_upload)){ 
            foreach($file_upload as $k=>$v){
                $v          = (substr($v,0,1)!='.'&&substr($v,0,1)!='/') ? './'.$v : ''.$v;
                $path_v    = realpath(dirname($v));
                $file_v    = basename($v);
                $file_upload[$k]    = '@'.$path_v.(substr($path_v,-1)!='/' ? '/' : '').$file_v;
            }
            $file_upload = array_merge($POSTdata, $file_upload);
        }
       
        $ch = curl_init($url);
        if(is_array($file_upload)|| $POSTdata!=''){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, (is_array($file_upload) ? $file_upload : $POSTdata));
        }
        if($cookie){
            curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
            curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
        }
        if($header){
            curl_setopt ($ch, CURLOPT_HEADER, 1);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, (substr($url,0,5)=='https'));
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        $_url_content = $url_content = curl_exec ($ch);
        curl_close($ch);
            $url_content = array(
                'url'      =>$url,
                'post'    =>$file_upload ? $file_upload : $POSTdata,
                'content'   =>$_url_content
            );
        if($header){
            $_url_content = explode("\r\n\r\n", $_url_content,3);
           
            $url_content['header']  = (count($_url_content)>2) ? $_url_content[0]."\r\n".$_url_content[1] : $_url_content[0];
           
            $url_content['header']  = explode("\r\n", $url_content['header']);
            foreach($url_content['header'] as $k=>$v){  $o[$k] = explode(': ', $v,2); $o[$o[$k][0]] = $o[$k][1]; unset($o[$k]);   }
            $url_content['header'] = $o;
           
            $url_content['content'] = (count($_url_content)>2) ? $_url_content[2] : $_url_content[1];
        }
        return $url_content;
    }



$url = 'http://www.bancoestado.cl';
$post = array('ejemplo_post'=>'Ejemplo de datos enviados por post', 'otro_ejemplo'=>32486245378934);
$get = array('ejemplo_get'=>'Ejemplo de datos enviados por get', 'otro_ejemplo_por_get'=>37827489237);
$file_upload = array('Nombre_de_archivo'=> './imagen.jpg');
print_r(source_extract($url, $post2, $get2, $file_upload2, true, 'tmp/cookie.txt'));
 

?>