<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "Classes/connect_db.php";
include_once "Classes/Mensaje.php";
include_once "Classes/Fase2.php";
$connect = new Connect;
$connectDb = $connect->connect_db();
$Mensaje = new Mensaje();
$Fase2 = new Fase2;
if(isset($_POST['nuevoMensaje']) && $_POST['nuevoMensaje']){
    $idNuevoMensaje = $_POST['nuevoMensaje'];
    if($_POST['table'] == 'mensajes')
        $nuevoMensaje = $Mensaje->getByField('post_fb_id',$_POST['nuevoMensaje']);
     else if($_POST['table'] == 'deseos')
        $nuevoMensaje = $Fase2->getByField('post_fb_id',$_POST['nuevoMensaje']);
}else{
     $nuevoMensaje = $Mensaje->getRandom(false);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ilumina tu navidad con Ferrero Rocher</title>
<link rel="image_src" type="image/jpeg"  href="imgs/facebookimage.jpg" />
<meta name="medium" content="blog" />
		<meta name="title" content="Ferrero Rocher Ilumina tu navidad" />
		<meta name="description" content='Ferrero Rocher ilumina tu navidad participa dejando tu deseo y gana fabulosos premios'/>
		<meta name="keywords" content='Ferrero, Rocher, mexico, deseos, navidad, chocolates, nutella, pralina, ilumina, arbol, ximena navarrete, pineda, covalin'/>
		<meta name="copyright" content="Rocher Ferrero"/>
		<meta name="Distribution" content="Global"/>
		<meta name="Rating" content="General"/>
		<meta name="Robots" content="INDEX,FOLLOW"/>
		<meta name="Revisit-after" content="1 Day"/>
        <meta name="author" content="@quemandocabeza, @trumesand, @abitonix"/>
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
<script type="text/javascript" src="scripts/jquery.scrollTo-min1.js"></script>
<script type="text/javascript">


$(document).ready(function(){
	
        /*Deseo random*/
        $("#wishchange").click(function(){
            var actual = $(".mensajeActual").attr('id');
            $.post('mensajeRandom.php',{actual:actual},function(data){
                var nuevoMensaje = JSON.parse(data);
                var mensajeRandomId = nuevoMensaje.post_fb_id;
                var mensajeRandom = nuevoMensaje.mensaje;
                $(".mensajeActual").attr('id',mensajeRandomId);
                $(".mensajeActual h4.CourgetteFont").html(mensajeRandom);
            })
            return false;

        })
        /*Deseo random*/
});

</script>
<script type="text/javascript" src="scripts/jsgeneral.js"></script>
</head>
<body class="bgI-1" id="cuerpo" style="overflow-y:hidden;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=144868285538931";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
<div class="spx-8A imageCont l3d-level7" style="position:fixed; left: -20px; top:7%; z-index:550;"> <img src="imgs/Arbol-navidad-ferrero-rocher.png" alt="arbol de navidad ferrero" width="498" height="665" class="first" /> </div>
<!--termina menu-->
<div class="mainContainer" id="alu-wrap">   
  <!--segundo-->
  <div class="content"  style="left:0px;">
    <div class="layer1" style="visibility: visible; position: relative; width: 100%; height: 620px;"> <a name="segundo" id="segundo"></a>
      <div class="spx-12 ball l3d-level7" style="position:absolute; z-index:900; left:1000px; top:52%;"> <img src="imgs/chocolate-ferrero-rocher.png" width="200" height="202" class="last marg-T100px"/> </div>
      <div class="spx-1 imageCont ball l3d-level4" style="position:absolute; z-index:150; left:23px; top:30px;"> <img src="imgs/brillos1.png" width="1474" height="455" /> </div>
      <div class="spx-6 l3d-level5" style="position:absolute; left:25%; top:30%; z-index:700;">
        <div class="spx-1">
          <h1 class="alineCenter h1-2"><span class="typeBiger2">I</span>LUMINA TU<span class="typeBiger2"> N</span>AVIDAD</h1>
          <div class="hr-line3 marg-L50px"></div>
          <h2 class="alineCenter h2-2">COMPARTIENDO MOMENTOS INOLVIDABLES</h2>
          <div class="col-8 marg-L35pr marg-T15px"> <a href="registro1.php" class="button big marg-T10px last">COMPARTE TU DESEO</a> </div>
        </div>
      </div>
      <div class="deseo" style="position:absolute; z-index:800; left:0px; top:65%;">
        <div class="col-10 marg-L30pr marg-T30px">
          <div id="<?php echo $nuevoMensaje['post_fb_id']; ?>" class="first mensajeActual">
            <h4 class="CourgetteFont"><?php echo $nuevoMensaje['mensaje']; ?></h4>
            <div> </div>
          </div>
        </div>
        <a href="#null" class="arrow" id="wishchange"></a> </div>
    </div>
  </div>
  <!--cuarto-->
</div>
<div class="footer">
  <ul>
    <li><a href="#">FERRERO ROCHER® 2012</a></li>
    <li><a href="termino-condiciones.html">TÉRMINOS Y CONDICIONES</a></li>
    <li><a href="policticas-privacidad.html">POLÍTICAS DE PRIVACIDAD</a></li>
  </ul>
</div>

  <script type="text/javascript" src="scripts/gridpak.js"></script>

</body>
</html>
