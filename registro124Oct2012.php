<?php
include_once "Classes/connect_db.php";
include_once "Classes/FbUser.php";
include_once "Classes/Mensaje.php";
$connect = new Connect;
$connectDb = $connect->connect_db();
$FbUser = new FbUser();
$Mensaje = new Mensaje();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ilumina tu navidad con Ferrero Rocher</title>
<link href="css/Origami-1.2.css" rel="stylesheet" type="text/css" />
<link href="css/skin-default.css" rel="stylesheet" type="text/css" />
<link href="css/menu-clear.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2423507-15");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript" src="scripts/resizeImages.js"></script>
<script type="text/javascript" src="scripts/jsgeneral.js"></script>
<script type="text/javascript" src="scripts/jquery.scrollTo-min1.js"></script>
<script type="text/javascript">
</script>
</head>
<body class="bgI-1" id="cuerpo" style="overflow-y:hidden;">
    <!-- API FACEBOOK-->
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
$(document).ready(function(){
    FB.getLoginStatus(function(response) {
            var status = response.status;
            if(status == 'not_authorized'){
               /* $(".mensaje").html('<div class="txt">Debes aceptar la aplicación de Facebook para participar</div>');
                $(".mensaje").append('<input type="button" value="Conectar" id="conectar"/>');*/
                $("#mensajeFb").html('<p class="typ-1">Para poder escribir tu deseo es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="#"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')
                conecta();
            }else if(status == 'connected'){
                 accessToken = response.authResponse.accessToken;
                 FB.api('/me',function(response){
                    id_fb = response.id
                    /*$(".mensaje").html('<form id="formMensaje" method="post" action="guarda_mensaje.php">');
                    $("#formMensaje").html('<div class="txt">Ingresa tu mensaje navideño</div>');
                    $("#formMensaje").append('<textarea id="textareaMensaje" name="mensaje[mensaje]"></textarea>');
                    $("#formMensaje").append('<div id="errorMensaje"></div>');
                    $("#formMensaje").append('<input type="submit" value="Enviar" />');
                    $(".mensaje").append('</form>');*/
                    var url = '<?php echo $connect->config['siteurl']; ?>';
                    deseoForm = '<p class="typ-1">Descubre los destellos de Magía de esta temporada, compartiendo tu deseo y ayúdanos a iluminar la Navidad.</p>';
                    deseoForm += '<p class="typ-3 clear typeMin">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>';
                    deseoForm += '<div class="col-16 "><form id="formMensaje" method="post" action="guarda_mensaje.php">';
                    deseoForm += '<textarea id="textareaMensaje" name="mensaje[mensaje]" class="desire"></textarea>';
                    deseoForm += '<div id="errorMensaje"></div>';
                    deseoForm += '<button class="button medium marg-10px" type="submit">COMPARTIR</button>';
                    deseoForm += '<a   onClick="window.open(this.href, this.target, \'width=600,height=400\'); return false;" href="http://www.facebook.com/sharer.php?s=100&p[url]=' + url + 'registro1.php&p[images][0]=http://rocher.ferrero.com.mx/iluminatunavidad/imgs/Ferrero-Ilumina-la-navidad.png&p[title]=Ilumina tu navidad&p[summary]=">';
                    deseoForm += '<img class="marg-T10px marg-R10px" src="imgs/fbShare.jpg" alt="Compartir en Facebook" />';
                    deseoForm += '</a>';
                    deseoForm += '<a onClick="window.open(\'https://twitter.com/intent/tweet?text=Viendo \' + this.href, this.target, \'width=600,height=400\'); return false" href="' + url +'registro1.php" class="btwitter" title="Compartelo en Twitter">';
                    deseoForm += '<img src="imgs/twShare.jpg" alt="Compartir en Twitter" />';
                    deseoForm += '</a>';
                    deseoForm += '</form>';
                    deseoForm += '</div>';
                    $("#mensajeFb").html(deseoForm)

                    enviaMensaje();
                    validaMensaje();
                })
            }else{
                /*$(".mensaje").html('<div class="txt">Debes iniciar sesión en Facebook para participar</div>');
                $(".mensaje").append('<input type="button" value="Iniciar sesión" id="conectar" />');*/

                $("#mensajeFb").html('<p class="typ-1">Para poder escribir tu deseo es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p><div class="col-11 marg-B20px"> <a id="conectar" href="registro2.html"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div><p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>')
                conecta();
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
function enviaMensaje(){
    $("#formMensaje").submit(function(){
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
            $.post('guarda_mensaje.php',{mensaje: {id_fb:id_fb,mensaje:mensaje,post_fb_id : post_fb_id}},function(data){
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

<!-- API FACEBOOK-->
<div class="spx-1">
<div class="menu-H">
  <h1 class="first Dsblock" style="position:relative; left:-30px;"><a href="http://rocher.ferrero.com.mx/iluminatunavidad/?p=primero" id="linkFrst"><img src="imgs/Ferrero-Ilumina-la-navidad.png" width="257" height="166" alt="ferrero rocher ilumina tu navidad" /></a></h1>
  <ul id="navigation">
    <li><a href="http://rocher.ferrero.com.mx/iluminatunavidad/?p=segundo">LISTÓN DE LOS DESEOS</a></li>
    <li><a href="http://rocher.ferrero.com.mx/iluminatunavidad/?p=tercero">EL CASCANUECES</a></li>
    <li><a href="http://rocher.ferrero.com.mx/iluminatunavidad/?p=cuarto">VIDEOS</a></li>
  </ul>
</div>
<div class="spx-8A imageCont l3d-level7" style="position:fixed; left: -30px; top:60px; z-index:550;"> <img src="imgs/Arbol-navidad-ferrero-rocher.png" alt="arbol de navidad ferrero" width="498" height="665" class="first" /> </div>

<!--termina menu-->
<div class="mainContainer" id="alu-wrap">  
 <!--Registro-->
  <div class="content" style="left:0px;">
    <div class="layer1 l3d-container" style="visibility: visible; position: absolute; width: 100%; height: 620px;">
      <div class="spx-1 imageCont ball l3d-level4" style="position:absolute; z-index:150; left:23px; top:80px;"><img src="imgs/brillos1.png" width="1474" height="455" class="last marg-T100px"/></div>
      <div class="col-18 brRad-10px  l3d-level3" style="position:absolute; z-index:300; left:300px; top:80px;">
         <h5 class="alineCenter">ILUMINA TU NAVIDAD COMPARTIENDO TUS MEJORES DESEOS</h5>
      </div>
      
      <div class="col-17 bgI-2 brRad-10px  l3d-level3" style="position:absolute; z-index:300; left:450px; top:150px; height:350px;"></div>
	<div class="col-17" style="position:absolute; z-index:999; left:450px; top:150px; height:350px;">
      <div class="instruct marg-T15px"></div>
      <div class="col-16 marg-L25px marg-T10px" id="mensajeFb" >
          <!--<p class="typ-1">Para poder escribir tu deseo es necesario que te conectes a través de Facebook, lo puedes hacer dando click en el botón.</p>
      <div class="col-11 marg-B20px"> <a href="registro2.html"><img src="imgs/facebook-button.png" width="202" height="26" alt="conectate con facebook" class="last padd-10px"/></a></div>
          <p class="typ-1 clear">Te recordamos que tu deseo no debe de exceder los 140 caractéres.</p>-->
      </div>
       <form id="formNuevoMensaje" method="post" action="index.php?p=segundo">
        <input type="hidden" name="nuevoMensaje" />
      </form>
      </div>
      <div class="spx-10 l3d-level6" style="position:absolute; z-index:800; left:810px; top:340px;"><img src="imgs/chocolates-para-navidad-ferrero.png" width="400" height="204" class="last marg-T100px"/></div>
      <div class="spx-10 l3d-level6" style="position:absolute; z-index:750; left:590px; top:340px;"><img src="imgs/comparte-tus-deseos.png" width="552" height="197" class="last marg-T100px"/></div>
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
<script type="text/javascript" src="scripts/jquery-easing-1.3.js"></script> 
<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script> 
<script type="text/javascript" src="scripts/layers3d.kreaturamedia.jquery-min.js"></script>
</body>
</html>
