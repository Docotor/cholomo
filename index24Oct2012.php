<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "Classes/connect_db.php";
include_once "Classes/Mensaje.php";
$connect = new Connect;
$connectDb = $connect->connect_db();
$Mensaje = new Mensaje();
if(isset($_POST['nuevoMensaje']) && $_POST['nuevoMensaje']){
    $idNuevoMensaje = $_POST['nuevoMensaje'];
    $nuevoMensaje = $Mensaje->getByField('post_fb_id',$_POST['nuevoMensaje']);
}else{
    //Obtiene un mensaje random
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
<link href="css/Origami-1.2.css" rel="stylesheet" type="text/css" />
<link href="css/skin-default.css" rel="stylesheet" type="text/css" />
<link href="css/menu-clear.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="scripts/resizeImages.js"></script>
<script type="text/javascript" src="scripts/jquery.scrollTo-min1.js"></script>
<script type="text/javascript">
function htmlRand(){
var Rand = 1 + Math.floor(Math.random() * 4);
var thehtml = "deseo" + Rand + ".html"
return thehtml
}

  function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return hash[1];
  }
  
  function navega(thepage) {
    switch (thepage) { 
        case 'primero':
		$('#cuerpo').scrollTo( 0, {left:0,axis:'x',duration:3000});
		break;
		case 'segundo':
		$('#cuerpo').scrollTo( eachone[0],{left:eachone[0],axis:'x',duration:3000});
		break;
		case 'tercero':
		$('#cuerpo').scrollTo( eachone[1],{left:eachone[1],axis:'x',duration:3000});
		break;
		case 'cuarto':
		$('#cuerpo').scrollTo( eachone[2],{left:eachone[2],axis:'x',duration:3000});
		break;
	}
	return false;
  }


$(document).ready(function(){
	page = getUrlVars();
	if(page != null){
		navega(page);
		}
	
	$("#linkFrst").click(function() {
		$('#cuerpo').scrollTo( 0, {left:0,axis:'x',duration:3000});
	});
	$("#linkthir").click(function() {
		$('#cuerpo').scrollTo( eachone[0],{left:eachone[0],axis:'x',duration:3000});
	});
	$("#linkfourth").click(function() {
		$('#cuerpo').scrollTo( eachone[1],{left:eachone[1],axis:'x',duration:3000});
	});
	$("#linkfifth").click(function() {
		$('#cuerpo').scrollTo( eachone[2],{left:eachone[2],axis:'x',duration:3000});
	});
        /*$("#wishchange").click(function() {
		 $('#wish').fadeOut('slow', function() {
			$('#wish').load(htmlRand(), function() {
				$('#wish').fadeIn(500, function() {});
			});
 	 });	
	});*/
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

        })
        /*Deseo random*/
});

</script>
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

  <h1 class="first Dsblock" style="position:relative; left:-30px;"><a href="#primero" id="linkFrst"><img src="imgs/Ferrero-Ilumina-la-navidad.png" width="257" height="166" alt="ferrero rocher ilumina tu navidad" /></a></h1>
  <ul id="navigation">
    <li><a href="#segundo" id="linkthir">LISTÓN DE LOS DESEOS</a></li>
    <li><a href="#tercero" id="linkfourth">EL CASCANUECES</a></li>
    <li><a href="#cuarto" id="linkfifth">VIDEOS</a></li>
  </ul>
</div>
<div class="spx-8A imageCont l3d-level7" style="position:fixed; left: -20px; top:50px; z-index:550;"> <img src="imgs/Arbol-navidad-ferrero-rocher.png" alt="arbol de navidad ferrero" width="498" height="665" class="first" /> </div>
 <div style="position:absolute; z-index:40; left:100px; top:58%; float:left; width:5700px;"> <img src="imgs/listonsote.png" width="5800" height="57" class="last marg-T100px"/> </div>
<!--termina menu-->
<div class="mainContainer" id="alu-wrap"> 
   
  <!--Primero-->
  <div class="content"  style="left:0px;">
    <div class="layer1 l3d-container" style="visibility: visible; position: relative; width: 100%; max-height: 730px; min-height:640px;"><a name="primero" id="primero"></a>
      <div class="spx-1 imageCont l3d-level1" style="position:absolute; z-index:150; left:-230px; top:-100px;"> <img src="imgs/brillos1.png" width="1474" height="455" class="last marg-T100px"/> </div>
      <div class="spx-8 l3d-level5" style="position:absolute; left:40%; top:190px; z-index:700;">
        <div class="spx-1">
          <h1 class="alineCenter"><img src="imgs/ferrero-rocher.png" width="400" height="93" alt="ferrero rocher" /></h1>
          <div class="hr-line2 marg-B10px marg-L10px"></div>
          <h2 class="alineCenter"><span class="typeBiger">I</span>LUMINA TU<span class="typeBiger"> N</span>AVIDAD</h2>
        </div>
        <div class="col-10 marg-L30pr"> <a href="registro1.php" class="button big marg-T20px last">COMPARTE TU DESEO</a> </div>
      </div>
      <div class="spx-6 imageCont  l3d-level5" style="position:absolute; z-index:500; left:195px; top:32%;"> <img src="imgs/brillos-en-navidad-de-ferrero.png" class="last marg-T100px"/> </div>
      <div class="spx-5 imageCont  l3d-level3" style="position:absolute; z-index:500; left:350px; top:270px;"> <img src="imgs/participa-registrandote.png" alt="participa y gana premios con la navidad ferrero rocher" width="700" height="278" class="last marg-T100px"/> </div>
      <div class="spx-8A imageCont  l3d-level7" style="position:absolute; z-index:900; left:85px; top:340px;"> <img src="imgs/chocolates-para-navidad-ferrero.png" width="515" height="261" class="last marg-T100px"/> </div>
    </div>
  </div>
  <!--segundo-->
  <div class="content"  style="left:2257px;">
    <div class="layer1" style="visibility: visible; position: relative; width: 100%; height: 620px;"> <a name="segundo" id="segundo"></a>
      <div class="spx-12 ball l3d-level7" style="position:absolute; z-index:900; left:1000px; top:55%;"> <img src="imgs/chocolate-ferrero-rocher.png" width="200" height="202" class="last marg-T100px"/> </div>
      <div class="spx-1 imageCont ball l3d-level4" style="position:absolute; z-index:150; left:23px; top:30px;"> <img src="imgs/brillos1.png" width="1474" height="455" /> </div>
      <div class="spx-6 l3d-level5" style="position:absolute; left:25%; top:30%; z-index:700;">
        <div class="spx-1">
          <h1 class="alineCenter h1-2"><span class="typeBiger2">I</span>LUMINA TU<span class="typeBiger2"> N</span>AVIDAD</h1>
          <div class="hr-line3 marg-L50px"></div>
          <h2 class="alineCenter h2-2">COMPARTIENDO MOMENTOS INOLVIDABLES</h2>
          <div class="col-8 marg-L35pr marg-T15px"> <a href="registro1.php" class="button big marg-T10px last">COMPARTE TU DESEO</a> </div>
        </div>
      </div>
      <div class="deseo" style="position:absolute; z-index:800; left:25px; top:72%;">
        <div class="col-10 marg-L30pr marg-T20px">
          <div id="<?php echo $nuevoMensaje['post_fb_id']; ?>" class="first mensajeActual">
            <h4 class="CourgetteFont"><?php echo $nuevoMensaje['mensaje']; ?></h4>
            <div> </div>
          </div>
        </div>
        <a href="#null" class="arrow" id="wishchange"></a> </div>
    </div>
  </div>
  <!--cuarto-->
  <div class="content" style="left:3500px;">
    <div class="layer1" style="visibility: visible; position: relative; width: 100%; height: 620px;"> <a name="tercero" id="tercero"></a>
      <div class="spx-2 imageCont l3d-level2" style="position:absolute; z-index:150; left:23px; top:10px;"><img src="imgs/brillos-navideno-ferrero.png" width="700" height="242" class="last marg-T100px"/></div>
      <div class="spx-1 imageCont l3d-level5" style="position:absolute; z-index:150; left:0px; top:-100px;"> <img src="imgs/brillos1.png" width="1474" height="455" class="last marg-T100px"/></div>
      <div class="spx-8A imageCont ball l3d-level5" style="position:absolute; z-index:600; left:50px; top:58%;"><img src="imgs/chocolates-para-navidad-ferrero.png" width="440" height="223" class="last marg-T100px"/></div>
      <div class="spx-9 imageCont l3d-level6" style="position:absolute; z-index:500; left:140px; top:8.5%;"> <img src="imgs/cascanueces.png" alt="gana boletos gratis para el cascanueces" width="160" height="463" class="last marg-T100px"/></div>
      <div class="spx-6 imageCont l3d-level3" style="position:absolute; z-index:400; left:300px; top:45%;"> <img src="imgs/conoce-como-participar.png" alt="participa y gana premios con la navidad ferrero rocher" width="742" height="295" class="last marg-T100px"/></div>
    </div>
  </div>
  <!--quinto-->
  <div class="content"  style="left:4557px;"><a name="cuarto" id="cuarto"></a>
    <div class="layer1 l3d-container" style="visibility: visible; position: relative; width: 100%; height: 625px; z-index:800;">
      <div class="spx-1 imageCont" style="position:absolute; z-index:100; left:23px; top:80px;">
        <img src="imgs/brillos1.png" width="1474" height="455" class="last"/>
      </div>
      <div class="col-18 bgI-2 brRad-10px padd-B40px" style="position:absolute; z-index:100; left:390px; top:135px; height:350px;">
      </div>
      <div style="position:absolute; z-index:9999; left:550px; top:170px; height:315px; float:left; overflow:hidden; width:420px;">
        <iframe width="460" height="265" src="http://www.youtube.com/embed/mu1WBMV4T1Y" frameborder="0" allowfullscreen></iframe>
        <fb:like href="http://www.youtube.com/watch?feature=player_embedded&v=mu1WBMV4T1Y" class="marg-10px" send="false" layout="button_count" width="450" show_faces="true" font="arial"></fb:like>
         <div class="col-2 marg-10px"> <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a> 
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </div>
      </div>
      <div class="spx-7 imageCont ball l3d-level7" style="position:absolute; z-index:680; left:195px; top:60%;"><img src="imgs/Galeria-videos.png" width="546" height="198" class="last marg-T100px"/></div>
      <div class="spx-8A imageCont ball l3d-level7" style="position:absolute; z-index:690; left:545px; top:55.5%;"><img src="imgs/chocolates-para-navidad-ferrero.png" width="400" height="204" class="last marg-T100px"/></div>
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
