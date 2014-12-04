<?php  include '../_header.php';  ?>
<?php  require_once '../auth/perm_user.php'; ?>

<?php  
	require_once '../lib/RNCryptor/autoload.php';

    $sess = Sessao::instanciar();
    $arrOut = json_decode($sess->get('data'), true);
    $arrSize = count($arrOut);

    //Conectar no banco
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    //Prepara o query, usando :values
    $data = $pdo->prepare("INSERT INTO tb_reservas
                           (res_in, res_out, res_val, fk_qua_num, fk_cli_cod)
                           VALUES
                           (:in, :out, :val, :fk_qua, :fk_cli);");

    //Prepara as variáveis para bindar
    $in = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 13:00:00", $arrOut[$arrSize-2]);
    $out = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 12:00:00", $arrOut[$arrSize-1]);
    $val = 1;
    $fk_qua = 1;
    $fk_cli = $usuario->getCliente();

    //Troca os :symbol pelos valores que irão executar
    //Ao mesmo tempo protege esses valores de injection
    $data->bindValue(":in",     $in);
    $data->bindValue(":out",    $out);
    $data->bindParam(":val",    $val);
    $data->bindParam(":fk_qua", $fk_qua);
    $data->bindValue(":fk_cli", $fk_cli);

    for($i=0; $i<$arrSize-2; $i++) {
        $val = (float) $arrOut[$i][1];
        $fk_qua = (float) $arrOut[$i][0];
        
        if ($data->execute()) {

        } else {
            echo "erro";
            die();
        }
    }


?>

<div class="inner cover">
   
   
   
   
   
   

    <h1>Tela de pagamento</h1>
    <br>
    <p>Reserva concluída com sucesso!</p>

    <br><br><br>


<?php

    $password = "myPassword";
    $plaintextOut = json_encode($arrOut);

    $encryptor = new \RNCryptor\Encryptor();

    $base64EncryptedOut = $encryptor->encrypt($plaintextOut, $password);

    echo "Plaintext:\n" . $plaintextOut;
    echo "<br><br>";
    echo "Base64 Encrypted:\n" . $base64EncryptedOut;
    echo "<br><br>";
    echo "<br><br>";

    echo "<a target='_blank' href='view_reserve.php?data=" . rawurlencode($base64EncryptedOut) . "'>Imprimir reserva</a>";

    echo "<br><br>";
    $password = "myPassword";

    $base64EncryptedIn = $base64EncryptedOut;

    $decryptor = new \RNCryptor\Decryptor();
    $plaintextIn = $decryptor->decrypt($base64EncryptedIn, $password);

    echo "Base64 Encrypted:\n" . $base64EncryptedIn;
    echo "<br><br>";
    echo "Plaintext:\n" . $plaintextIn;
    echo "<br><br>------------------------------------------<br><br>";

    $arrIn = json_decode($plaintextIn, true);

    echo json_encode($arrIn);

?>










</div>

<?php  include '../_footer.php';  ?>