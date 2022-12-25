<?php 
include ("base_datos.php");
class usuarios{

    public function __construct(){
        setlocale(LC_ALL, 'es_PE', 'es');
        date_default_timezone_set('America/Lima');
    }

    public function loginUser($usua, $pass)
    {
        $c=new conectar();
        $db=$c->conexionPDO();

        $sql="SELECT per.codigo, 
        CONCAT(per.primer_apellido,' ',per.segundo_apellido,' ',per.primer_nombre) as n_prof 
        from persona as per 
        
            JOIN profesor as pro
            on pro.codigo_prof=per.codigo
            where per.codigo=:codigo and per.password=:password";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("codigo", $usua,PDO::PARAM_STR) ;
        $stmt->bindParam("password", $pass,PDO::PARAM_STR) ;
        $stmt->execute();

        $count=$stmt->rowCount();
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($res);

        //$result=mysqli_query($conexion,$sql);
        //if(mysqli_num_rows($result) > 0){
        if($count>0){
            $_SESSION['nombre'] = $res['n_prof'];
            return 1;
        }else{
            return 0;
        }
    }

    public function obtenFotoPerfil($codigo){
        $c=new conectar();
        $conexion=$c->conexion();
        $default = array("./assets/img/perfiles/default.png");
        $sql="SELECT foto 
                from persona 
                where codigo='$codigo'
                limit 1";
        $result=mysqli_query($conexion,$sql);
        //return mysqli_fetch_row($result)[0];
        return mysqli_fetch_row($result);
    }

    public function uploadFotoPerfil($codigo, $filename){
        $c=new conectar();
        $db=$c->conexionPDO();
        $sql = "UPDATE persona set foto=:foto WHERE codigo=:codigo";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam('foto', $filename);
            $stmt->bindParam('codigo', $codigo);
            $stmt->execute();

        }catch (PDOException $e){
            return "Error: " . $e->getMessage();
        }
    }

    public function obtenCursosUsuario($idusuario){
        $c=new conectar();
        $db=$c->conexionPDO();
        try {
            $sql = "SELECT c.nombre, pc.codigo_curso
                from profesor_curso pc
                INNER JOIN profesor p
                INNER JOIN curso c
                ON pc.codigo_prof=p.codigo_prof
                AND pc.codigo_curso=c.codigo_curso
                where pc.codigo_prof='$idusuario'";
            return $db->query($sql)->fetchAll(PDO::FETCH_NUM);

        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getInfo($codigo_profesor, $codigo_curso){
        $mysql = new conectar();
        $db = $mysql->conexionPDO();
        try {
        
            
            $datos = "SELECT * from profesor_curso p_c 
            WHERE p_c.codigo_prof='$codigo_profesor' AND p_c.codigo_curso='$codigo_curso'";
            return $db->query($datos)->fetchAll(PDO::FETCH_NUM);

        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getNotas($codigo_profesor, $codigo_curso){
        $mysql = new conectar();
        $db = $mysql->conexionPDO();
        
        try {
            
            $result = "CALL mostrar_notas(:codigo_profesor, :codigo_curso)";
            $stmt = $db->prepare($result);
            $stmt->bindParam("codigo_profesor",$codigo_profesor, PDO::PARAM_STR);
            $stmt->bindParam("codigo_curso",$codigo_curso, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function updateNotas($cod_matricula,$cod_curso,$grupo, $estado,$c1,$c2,$c3,$e1,$e2,$e3){
        $mysql = new conectar();
        $db = $mysql->conexionPDO();
        try {
        
            $result = "CALL update_notas(:cod_matricula,:cod_curso,:grupo, :estado,:c1,:c2,:c3,:e1,:e2,:e3)";
            $stmt = $db->prepare($result);
            $stmt->bindParam("cod_matricula",$cod_matricula, PDO::PARAM_STR);
            $stmt->bindParam("cod_curso",$cod_curso, PDO::PARAM_STR);
            $stmt->bindParam("grupo",$grupo, PDO::PARAM_STR);
            $stmt->bindParam("estado",$estado, PDO::PARAM_STR);
            $stmt->bindParam("c1",$c1, PDO::PARAM_STR);
            $stmt->bindParam("c2",$c2, PDO::PARAM_STR);
            $stmt->bindParam("c3",$c3, PDO::PARAM_STR);
            $stmt->bindParam("e1",$e1, PDO::PARAM_STR);
            $stmt->bindParam("e2",$e2, PDO::PARAM_STR);
            $stmt->bindParam("e3",$e3, PDO::PARAM_STR);
            
            $stmt->execute();

        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}
 ?>