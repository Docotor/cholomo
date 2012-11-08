<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Mensaje{

    function save($mensaje){
        $query = 'INSERT INTO mensajes(';
        $fields = '';
        $values = '';
        $count = 1;
        foreach($mensaje as $k => $v){
            $fields .= "$k";
            $fields .= ($count < count($mensaje)) ?  ', ': ' ';
            $values .= "'$v'";
            $values .= ($count < count($mensaje)) ?  ', ': ' ';
            $count++;
        }
        $query .= $fields;
        $query .= ',status) VALUES(';
        $query .= $values;
        $query .= ',1)';
        $insert = mysql_query($query);
        return $insert;
    }
    function checkExist($id){
        $query = "SELECT count(*) as count FROM mensajes WHERE fb_user_id = '$id'";
        $search = mysql_query($query);
        while($result = mysql_fetch_assoc($search)){
                $count[] = $result;
            }
        return $count[0]['count'];
    }
    function getAll(){
        $query = 'SELECT * FROM mensajes';
        $search = mysql_query($query);
        while($result = mysql_fetch_assoc($search)){
            $mensajes[] = $result;
        }
        return $mensajes;
    }
    function getActived(){
        $query = 'SELECT * FROM mensajes WHERE status = 1';
        $search = mysql_query($query);
        while($result = mysql_fetch_assoc($search)){
            $mensajes[] = $result;
        }
        return $mensajes;
    }
    function updateStatus($key, $prev){ 
        $new = ($prev) ? '0' : '1';
        $query = "UPDATE mensajes SET status = '$new' WHERE id = '$key'";
        $update = mysql_query($query);
        return $update;        
    }
    function getByField($field , $value ){
        $query = "SELECT * FROM mensajes WHERE status = 1 AND $field = '$value' LIMIT 0,1";
        $search = mysql_query($query);
        while($result = mysql_fetch_assoc($search)){
            $mensaje[] = $result;
        }
        return (isset($mensaje[0])) ? $mensaje[0] : false ;
    }
    function getRandom($actual){
        $query = "SELECT * FROM mensajes WHERE status = 1 ";
        ($actual) ? $query .= "AND post_fb_id != '$actual' " : $query .= '';
        $query .= "ORDER BY RAND() LIMIT 0,1";
        $search = mysql_query($query);
        while($result = mysql_fetch_assoc($search)){
            $mensaje[] = $result;
        }
        return (isset($mensaje[0])) ? $mensaje[0] : false ;
    }
}
?>
