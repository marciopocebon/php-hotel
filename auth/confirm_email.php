
   <?php
   
   


include '../constantes.php'; 

    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $query = $pdo->prepare("UPDATE tb_usuarios
                            SET usu_conf = 1
                            WHERE usu_hash = :hash;");

    $query->bindValue(":hash", $_GET['hash']);

    if($query->execute()) {

    } else {
        die();
    }
    
  //redireciona para pagina de login apos finalizar cadastro e enviar pedido de confirmação de email
    header("Location: ". URL . '/auth/login.php');

    //header('javascript:window.close()');
?>
<!--

<script>
window.close();
</script>-->
