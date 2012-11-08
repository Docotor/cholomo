<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'config.php';

class Connect extends Config{
    public function connect_db(){
        mysql_connect($this->config['host'], $this->config['user'], $this->config['password']);
        mysql_select_db($this->config['database']);
    }
    /*public function get_user($id){
        $query = mysql_query("SELECT * FROM users WHERE id = $id");
        $user = false;
        while($result = mysql_fetch_assoc($query)){
            $user[] = $result;
        }
        return $user;
    }
    public function save_user_fb($user){
        $get_user = mysql_query("SELECT * FROM users WHERE id = ".$user['id']);
        if($get_user){
            $update = mysql_query ("UPDATE users set id_fb = '".$user['id_fb']."', email_fb = '".$user['email_fb']."', nombre_fb = '".$user['nombre_fb']."',publish_stream = ".$user['publish_stream']." WHERE id = ".$user['id']);
            return $update;
        }else
            return $get_user;

    }
    function check_in($user){
        $first_check_in = mysql_query("SELECT * FROM users WHERE id = ".$user['id']." AND check_in = 0");
        while($result = mysql_fetch_assoc($first_check_in)){
            $r = $result;
        }
        if($r){
            $update = mysql_query ("UPDATE users set check_in = 1 WHERE id = ".$user['id']);
            return $update;
        }else
            return 90;
    }
    public function get_users_check_in(){
        //$query = mysql_query("SELECT * FROM users WHERE id_fb != '' AND publish_stream = 1 AND check_in = 1 AND post_check_in = 0");
        $query = mysql_query("SELECT * FROM users WHERE id = 201105259999");
        $users = false;
        while($result = mysql_fetch_assoc($query)){
            $users[] = $result;
        }
        return $users;
    }
    public function post_user_check_in($user){
        $update = mysql_query ("UPDATE users set post_check_in = 1 WHERE id = ".$user['id']);
        return $update;
    }
    public function remove_publish_stream($user){
        $update = mysql_query ("UPDATE users set publish_stream = 0 WHERE id = ".$user['id']);
        return $update;
    }
    public function nuevo_registro($user){
        //return "INSERT INTO users ( id , nombre , email,extemporaneo) VALUES ('".$_GET['id']."', '".$_GET['nombre']."','".$_GET['email']."',1)";        
        $nuevo = mysql_query ("INSERT INTO users ( id , nombre , email,extemporaneo) VALUES ('".$_GET['id']."', '".$_GET['nombre']."','".$_GET['email']."',1)");
        if($nuevo){
            return 1;
        }else{
            return 0;
        }
    }
    public function comprobar_email($email) {
        $mail_correcto = 0;
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
            if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
                //miro si tiene caracter .
                if (substr_count($email, ".") >= 1) {
                    //obtengo la terminacion del dominio
                    $term_dom = substr(strrchr($email, '.'), 1);
                    //compruebo que la terminación del dominio sea correcta
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
                        //compruebo que lo de antes del dominio sea correcto
                        $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != "@" && $caracter_ult != ".") {
                            $mail_correcto = 1;
                        }
                    }
                }
            }
        }
        if ($mail_correcto)
            return 1;
        else
            return 0;
    }
    public function checar_id($id){
        $query = mysql_query("SELECT * FROM users WHERE id = $id");
        $user = false;
        while($result = mysql_fetch_assoc($query)){
            $user[] = $result;
        }
        return $user;
        
    }
    public function subir_fotos(){
        $query = mysql_query("SELECT * FROM users WHERE check_in_foto = 1 AND (post_check_in_foto = 0 OR post_check_in_foto = '' ) LIMIT 10");
        $users = false;
        while($result = mysql_fetch_assoc($query)){
            $users[] = $result;
        }
        return $users;
    }
    public function save_post_foto($id, $id_foto){
        $update = mysql_query ("UPDATE users set post_check_in_foto = $id_foto WHERE id = $id");
        return $update;
    }
    public function check_foto($id){
        $query = mysql_query("SELECT * FROM users WHERE id = $id");
        $codigo_correcto = false;
        while($result = mysql_fetch_assoc($query)){
            $codigo_correcto[] = $result;
        }
        if($codigo_correcto){
            $query = mysql_query("SELECT * FROM users WHERE id = $id AND check_in_foto = 1");
            $check_previo = false;
            while($result = mysql_fetch_assoc($query)){
                $check_previo[] = $result;
            }
            //return $check_previo;
            if($check_previo){
                return "90";
            }else{
                $update = mysql_query ("UPDATE users set check_in_foto = 1 WHERE id = $id");
                return $update;
            }
                
            
        }else
            return $codigo_correcto;
    }*/
    
}

?>
