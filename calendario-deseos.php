<?php 
session_start();
include_once "Classes/connect_db.php";
include_once "Classes/Semana.php";
$connect = new Connect;
$connectDb = $connect->connect_db();
$Semana = new Semana;
$semanaActual = $Semana->getCurrent();
$diaValido = $Semana->validDay();
if(in_array($diaValido['step'],array('foto','video'))){
    if($diaValido['step'] == 'foto')
        $proximoPaso = $semanaActual['daysOk']['video'];
    else if($diaValido['step'] == 'video')
        $proximoPaso = $semanaActual['daysOk']['deseo'];
    foreach($semanaActual['days'] as $k => $d){
        if($d['day'] == $proximoPaso)
            $proximoDia = $d;
    }
}else
    $proximoDia = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ilumina tu navidad con Ferrero Rocher</title>
<link href="css/Origami-1.2.css" rel="stylesheet" type="text/css" />
<link href="css/skin-default.css" rel="stylesheet" type="text/css" />
<link href="css/menu-clear.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2423507-15");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
<script type="text/javascript">
function loaderdiv(e) {
$('#loaddiv').show();
}
function loaderVid(e) {
$('#loaddiv').show();
}
function loaderdesire(e) {
$('#loaddiv').show();
}
</script>
</head>
<body class="bgI-1" id="cuerpo" style="overflow-y:hidden;">
    <!--App Facebook-->
        <div id="fb-root"></div>
        <script type="text/javascript" src="http://connect.facebook.net/es_LA/all.js"></script>
         <script type="text/javascript">
           FB.init({
             appId  : '<?php echo $connect->config['appId']; ?>',
             status : true, // check login status
             cookie : true, // enable cookies to allow the server to access the session
             xfbml  : true  // parse XFBML
           });
         </script>
    <script type="text/javascript">
    var tag = document.createElement('script');
        tag.src = "//www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '190',
                width: '380',
                videoId: 'mu1WBMV4T1Y',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        function onPlayerReady(event) {
            event.target.stopVideo();
        }
        //esta funcion activa el boton de listo
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.ENDED ) {      
            $('#readyBTN').removeClass('desactiveBTN');    
            $("#readyBTN").click(function(){
            FB.api('/me/feed', 'post', { message: "Yo ya ilumine mi día viendo este video http://www.youtube.com/watch?v=mu1WBMV4T1Y en http://iluminatusmomentos.com" }, function(response) {
                var post_fb_id = '';
                if (!response || response.error) {
                } else {
                    post_fb_id = response.id;
                }
                //post_fb_id = 'prueba1234567'
                $.post('guarda_fase2.php',{video: {id_fb:id_fb,video:'1',post_fb_id : post_fb_id,paso:'video',semana:'<?php echo $semanaActual['numero'];?>'}},function(data){
                            //alert("Gracias");
                            location.reload(true);   
                    })
            });
          
        })     
        }
        }
    $(document).ready(function(){         
        <?php if(isset($_SESSION['postFoto']) && $_SESSION['postFoto']){ ?>
            FB.getLoginStatus(function(response) {                
                var status = response.status;
                if(status == 'connected'){
                    FB.api('/me/feed', 'post', { message: "Yo ya ilumine mi día subiendo una foto. Sube la tuya en http://iluminatusmomentos.com" }, function(response) {
                        var post_fb_id = '';
                        if (!response || response.error) {
                        } else {
                            post_fb_id = response.id;
                            $.post('updatePhoto.php',{id:'<?php echo $_SESSION['postFoto']?>',post_fb_id:post_fb_id},function(data){
                            })
                        }
                    })     
                }
            })      
        <?php $_SESSION['postFoto'] = false; } ?>
        <?php if(isset($_SESSION['mensaje']) && $_SESSION['mensaje']){ ?>
                //alert('<?php echo $_SESSION['mensaje']?>');
        <?php $_SESSION['mensaje'] = false; } ?>
        FB.getLoginStatus(function(response) {
                var status = response.status;
                if(status == 'not_authorized'){
                    <?php if($diaValido){ ?>
                       <?php if($diaValido['step'] == 'foto'){ ?>
                            $("#loaddiv").html('<p class="typ-1">Para poder subir tu foto es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div>')                    
                       <?php }else if($diaValido['step'] == 'video'){?>   
                            $("#loaddiv").html('<p class="typ-1">Para poder ver el spot es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div>')                    
                            $("#loaddiv").show();                    
                       <?php }else if($diaValido['step'] == 'deseo'){?>
                            $("#loaddiv").html('<p class="typ-1">Para poder escribir tu deseo es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')                    
                            $("#loaddiv").show();
                       <?php } ?>
                       conecta();
                    <?php } ?>
                }else if(status == 'connected'){
                     accessToken = response.authResponse.accessToken;
                     FB.api('/me',function(response){
                        id_fb = response.id;
                        <?php if($diaValido){ ?>                       
                                    <?php if($diaValido['step'] == 'foto'){  ?>
                                         $.post('checkUnique.php',{id:id_fb,paso:'<?php echo $diaValido['step']; ?>',semana:'<?php echo $semanaActual['numero']; ?>'},function(data){
                                        if(data == '0'){
                                            $("#loaddiv").html('<link href="css/skin-default.css" rel="stylesheet" type="text/css" /><p class="typ-1">Sube una foto de un momento inolvidable con tu Familia, desde tu computadora.</p><div class="col-10 marg-L30px"><form id="photoForm" action="guarda_fase2.php" method="post" type="hidden" enctype="multipart/form-data"><input type="hidden" name="photo[id_fb]" value="'+id_fb+'"/><input type="hidden" name="photo[post_fb_id]" id="post_fb_id" /><input type="hidden" name="photo[semana]" value="<?php echo $semanaActual['numero']; ?>" /><input  type="file" name="photo[image]" style="background-color:#FFF; display:block; padding:3px; margin:5px; margin-left:20px; width:300px;" /><div class="col-6 marg-10px last"><button type="submit" class="button medium last">SUBIR IMAGEN</button></div></form></div>')
                                            $(".hacerActividad").html('<a href="#null" class="button medium marg-T20px last" onclick="loaderdiv();">¡HAZLO!</a>');
                                            enviaFoto();
                                        }else{                                
                                            $("#loaddiv").html('<p class="typ-1">¡Gracias por subir tu foto!</p><p class="typ-1">No olvides llevar a cabo la siguiente acción Ferrero Rocher el día <?php echo $proximoDia['number']; ?> de <?php echo $proximoDia['month']; ?> y continua Iluminando Navidad.</p>');
                                                $(".hacerActividad").html('<img src="imgs/Listo.png" class="medium marg-T20px last" />');
                                        }                                         
                                        })
                                    <?php }else if($diaValido['step'] == 'video'){ ?>  
                                        //$("#loaddiv").html('<p class="typ-1">Ve nuestro spot: “Food of the Goods” y da clic en el botón “¡Hecho!” una vez que se active.</p><div class="col-10 marg-L30px"><iframe width="380" height="180" src="http://www.youtube.com/embed/mu1WBMV4T1Y" frameborder="0" allowfullscreen></iframe></div><a href="#null" id="videoListo" class="button medium marg-T20px last" >LISTO</a>');
                                         $.post('checkUnique.php',{id:id_fb,paso:'<?php echo $diaValido['step']; ?>',semana:'<?php echo $semanaActual['numero']; ?>'},function(data){
                                            if(data != '0'){
                                                $(".hacerActividad").html('<img src="imgs/Listo.png" class="medium marg-T20px last" />');
                                                $("#loaddiv").html('<p class="typ-1">¡Gracias por ver nuestro video!</p><p class="typ-1">No olvides llevar a cabo la siguiente acción Ferrero Rocher el día <?php echo $proximoDia['number']; ?> de <?php echo $proximoDia['month']; ?> y continua Iluminando Navidad.</p>')
                                                $("#loaddiv").show();
                                            }else{
                                                $(".hacerActividad").html('<a href="#null" class="button medium marg-T20px last" onclick="loaderVid();">VER SPOT</a>')
                                                $("#loaddiv").show();
                                            }                                         
                                        })
                                    <?php }else if($diaValido['step'] == 'deseo'){ ?>
                                         $.post('checkUnique.php',{id:id_fb,paso:'<?php echo $diaValido['step']; ?>',semana:'<?php echo $semanaActual['numero']; ?>'},function(data){
                                        if(data == '0'){    
                                            $("#loaddiv").html('<p class="typ-1">Descubre los destellos de Magía de esta temporada, compartiendo tu deseo y ayúdanos a iluminar la Navidad.</p><p class="typ-3 clear typeMin">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p><div class="col-10 "><form id="wishForm" action="#"><textarea name="deseo" id="textareaMensaje" class="desire" ></textarea><div id="errorMensaje"></div><button class="button medium marg-10px" type="submit">COMPARTIR</button></form></div>')
                                            $(".hacerActividad").html('<a href="#null" class="button medium marg-T20px last" onclick=" loaderdesire();">¡HAZLO!</a>')
                                            enviaMensaje();
                                            }else{                                
                                                $("#loaddiv").html('<p class="typ-1">¡Gracias por compartir tu deseo familiar para esta Navidad!</p><p class="typ-1">Mantente al pendiente de la publicación de los ganadores en nuestras redes.</p>');
                                                $(".hacerActividad").html('<img src="imgs/Listo.png" class="medium marg-T20px last" />');
                                            }                                             
                                             })
                                    <?php } ?> 
                            
                        <?php } ?>
                    })
                }else{
                    <?php if($diaValido){ ?>
                       <?php if($diaValido['step'] == 'foto'){ ?>
                            $("#mensajeFb").html('<p class="typ-1">Para poder subir tu foto es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')                    
                       <?php }else if($diaValido['step'] == 'video'){?>
                            $("#mensajeFb").html('<p class="typ-1">Para poder ver el spot es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')                    
                       <?php }else if($diaValido['step'] == 'deseo'){?>
                            $("#mensajeFb").html('<p class="typ-1">Para poder escribir tu deseo es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')                    
                       <?php } ?>
                       conecta();
                    <?php } ?>
                }
           });
    });
    function conecta(){
        $("#conectar").click(function(){
                        FB.login(function (response) {
                            if (response.authResponse) {
                                var accessToken = response.authResponse.accessToken;
                                FB.api('/me',function(response){
                                    $.post("guarda.php",{id_fb:response.id,email_fb:response.email,nombre_fb:response.name,token_fb:accessToken},function(data){
                                        location.reload(true);
                                    })
                                })
                            } else {
                                alert("Tienes que autorizar a la aplicacion")
                            }
                         },
                         {
                            scope: 'read_stream,publish_stream,status_update,email,user_about_me,user_online_presence'
                         });
                         return false;
                    });
    }
    function enviaFoto(){
        $("#photoForm").submit(function(){         
            FB.api('/me/feed', 'post', { message: "Yo ya ilumine mi día subiendo una foto. Sube la tuya en http://iluminatusmomentos.com" }, function(response) {
                var post_fb_id = '';
                if (!response || response.error) {
                } else {
                    post_fb_id = response.id;
                }
                $("#post_fb_id").val(post_fb_id);
            })        
        })
    }
    /*function enviaVideo(event){
        $("#readyBTN").click(function(){
            console.log(event.data);
            FB.api('/me/feed', 'post', { message: "Yo ya ilumine mi día viendo este video http://www.youtube.com/watch?v=mu1WBMV4T1Y en http://iluminatusmomentos.com" }, function(response) {
                var post_fb_id = '';
                if (!response || response.error) {
                } else {
                    post_fb_id = response.id;
                }
                //post_fb_id = 'prueba1234567'
                $.post('guarda_fase2.php',{video: {id_fb:id_fb,video:'1',post_fb_id : post_fb_id,paso:'video',semana:'<?php echo $semanaActual['numero'];?>'}},function(data){
                            alert("Gracias");
                            location.reload(true);   
                    })
            });
           
        })
        
    }*/
    function enviaMensaje(){
        $("#wishForm").submit(function(){
            var mensaje = $("#textareaMensaje").val();
            var valida = true;
            if(mensaje.length == 0 || mensaje == 'Escribe aqui tu deseo'){
                $("#errorMensaje").html('Ingresa tu deseo');
                valida = false;
            }
            if(!valida)
                return false;
            if(mensaje.length > 140){
                $("#errorMensaje").html('Tu deseo debe ser menor o igual a 140 caracteres');
                valida = false;
            }
            if(!valida)
                return false;
            FB.api('/me/feed', 'post', { message: "Yo ya ilumine mi día con este deseo para Navidad: \""+mensaje+"\". Escribe el tuyo en http://iluminatusmomentos.com" }, function(response) {
                var post_fb_id = '';
                if (!response || response.error) {
                } else {
                    post_fb_id = response.id;
                }
                //post_fb_id = 'prueba1234567'
                $.post('guarda_fase2.php',{deseo: {id_fb:id_fb,deseo:mensaje,post_fb_id : post_fb_id,paso:'deseo',semana:'<?php echo $semanaActual['numero'];?>'}},function(data){
                        if(data != '1'){
                            alert(data);
                        }else{
                            $("input[name=nuevoMensaje]").val(post_fb_id);
                            alert("Gracias, tu deseo ha sido guardado");
                            $("#formNuevoMensaje").submit();
                        }
                    })
            });

            return false;
        })
    }
    </script>
    <!--App Facebook-->
    
<div class="spx-1">
<div class="menu-H">
  <h1 class="first Dsblock" style="position:relative; left:-30px;"><a href="index.php" id="linkFrst"><img src="imgs/Ferrero-Ilumina-la-navidad.png" width="257" height="166" alt="ferrero rocher ilumina tu navidad" /></a></h1>
  <ul id="navigation">
  <li><a href="calendario-deseos.php">CALENDARIO DE ACCIONES</a></li>
    <li><a href="liston.php">LISTÓN DE LOS DESEOS</a></li>
    <li><a href="cascanueces.php">EL CASCANUECES</a></li>
    <li><a href="videos.php">VIDEOS</a></li>
    <li><a href="arbol-navidad.php" >ÁRBOL FERRERO</a></li>
  </ul>
   <div class="col-3 last marg-T45px"><a href="https://www.facebook.com/FerreroRocherMX" target="_blank"><img src="imgs/icon-fb.png" width="28" height="28" alt="facebook" class="padd-10px" /></a>
  <a href="https://twitter.com/FerreroRocherMX" target="_blank"><img src="imgs/icon-tw.png" width="28" height="28" alt="twitter ferrero"  class="padd-10px"/></a></div>
</div>
<!--termina menu-->
<div class="spx-8A imageCont l3d-level7" style="position:fixed; left: -30px; top:60px; z-index:550;"> <img src="imgs/Arbol-navidad-ferrero-rocher.png" alt="arbol de navidad ferrero" width="498" height="665" class="first" /> </div>


<div class="mainContainer" id="alu-wrap">  
<div class="content" style="left:50px;">
    <div class="layer1" style="visibility: visible; position: relative; width: 100%; height: 620px;">
      <div class="spx-2 imageCont l3d-level2" style="position:absolute; z-index:150; left:23px; top:10px;"><img src="imgs/brillos-navideno-ferrero.png" width="700" height="242" class="last marg-T100px"/></div>
      <div class="col-13" style="position:absolute; z-index:900; left:220px; top:85px;">
         <h2 class="alineCenter"><span style="font-size:58px;">C</span>ALENDARIO DE <span style="font-size:58px">A</span>CCIONES</h2>
      </div>
          <div class="col-13 imageCont bgI-2 brRad-20px" style="position:absolute; z-index:800; left:100px; top:24%; height:150px;">
          <div class="col-4 marg-T10px" style="position:relative; left:-15px;">
          	<img src="imgs/Noviembre.png" width="132" height="48" alt="buenas acciones de noviembre" /></div>
            <div class="calendar">
            <ul>
                <?php foreach($semanaActual['days'] as $k => $d){ ?>
                <li>
                    <span class="day <?php if(!($k%2)){ ?> light<?php }?>"><?php echo $d['name']; ?></span>
                    <span class="number <?php if(in_array($d['day'],$semanaActual['daysOk'])){ ?> minipralina<?php }?>"><?php echo $d['number']; ?></span>
                </li>
                <?php } ?>            	
            </ul>
            </div>
      </div>

          <div class="col-13 imageCont bgI-2 brRad-20px" style="position:absolute; z-index:800; left:100px; top:52%; height:245px;">
                <?php if($diaValido){ ?>
                    <?php if($diaValido['step'] == 'foto'){ ?>
                    <div class="pestana marg-T15px"><?php echo $diaValido['number'].' '.$diaValido['month']; ?></div>
                    <div class="col-7 marg-T15px">
                            <p class="typ-1">Sube una foto de un momento inolvidable con tu Familia</p>
                    </div>
                    <div class="hacerActividad">
                    </div>
                    <?php }else if($diaValido['step'] == 'video'){ ?>
                    <div class="pestana marg-T15px"><?php echo $diaValido['number'].' '.$diaValido['month']; ?></div>
                    <div class="col-7 marg-T15px">
                            <p class="typ-1">Ve nuestro spot “Food of the Gods” y da click en “Listo”</p>
                    </div>                    
                    <div class="hacerActividad">
                    </div>
                    <?php }else if($diaValido['step'] == 'deseo'){ ?>
                    <div class="pestana marg-T15px"><?php echo $diaValido['number'].' '.$diaValido['month']; ?></div>
                    <div class="col-7 marg-T15px">
                            <p class="typ-1">Compártenos un deseo familiar para esta Navidad</p>
                    </div>                    
                    <div class="hacerActividad">
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-13 imageCont bgI-2 brRad-20px" style="position:absolute; z-index:800; left:630px; top:24%; height:420px;">
            <div class="col-10 marg-T15px" style="position:relative; left:-10px;">
          	<img src="imgs/instruccionesLong.png" width="530" height="47" alt="buenas acciones de noviembre" />
                 <form id="formNuevoMensaje" method="post" action="liston.php">
                    <input type="hidden" name="nuevoMensaje" />
                    <input type="hidden" name="table" value="deseos" />
                  </form>
                <?php if($diaValido){?>
                    <?php if($diaValido['step'] == 'video'){ ?>                        
                        <div class="col-11 marg-L40px" id="loaddiv" style="display:none;">
                        <p class="typ-1">Ve nuestro spot: “Food of the Goods” y da clic en el botón “Listo” una vez que se active.</p>
                        <div class="col-10 marg-L30px" id="player"></div>
                        <a href="#null" class="button big marg-T20px last desactiveBTN" id="readyBTN">LISTO</a>
                        </div>
                    <?php }else{ ?>                                             
                        <div class="col-11 marg-L40px" id="loaddiv"></div>
                    <?php } ?>
                <?php }else{ ?>
                        <div class="col-11 marg-L40px" id="loaddiv"></div>
                <?php } ?>
            <!--<p class="typ-1"> Participa cumpliendo las acciones que te sugerimos cada semana y gana cajas Ferrero Rocher  edición Pineda Covalín o boletos dobles para El Cascanueces.</p>
            <p class="typ-1">Para poder participar es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p>
             <div class="col-9 marg-B20px marg-T15px"> <a href="#null" onclick="loaderdiv();"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last"/></a></div>-->
             </div>
            </div>
            
      </div>
          
      <div class="spx-1 l3d-level5" style="position:absolute; z-index:150; left:0px; top:-100px; h"> <img src="imgs/brillos1.png" width="1474" height="455" class="last marg-T100px"/></div>
      <div class="ball l3d-level5" style=" width:340px; position:absolute; z-index:800; left:85%; top:74%; background-image:url(imgs/chocolates-para-navidad-ferrero.png); height:185px; background-repeat:no-repeat; background-size:100%">
      </div>
      <div class="spx-5 l3d-level3" style="position:absolute; z-index:400; left:280px; top:40%;"></div>
    </div>
  </div>
</div>
<div class="footer">
  <ul>
    <li><a href="#">FERRERO ROCHER® 2012</a></li>
    <li><a href="termino-condiciones.html">TÉRMINOS Y CONDICIONES</a></li>
    <li><a href="#">POLÍTICAS DE PRIVACIDAD</a></li>
  </ul>
</div>
</body>
</html>
