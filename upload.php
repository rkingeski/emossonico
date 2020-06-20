<?php
session_start();
if(!isset($_SESSION['token'])){
    header("HTTP/1.0 403 CSRF FAIL");
    die();
} else{
    if($_SESSION['token'] != $_POST['_token']){
        header("HTTP/1.0 403 CSRF FAIL");
        die();
    } else {
        unset($_POST['_token']);
    }
}

ini_set('html_errors', false);

try {
    include('includes/connection.php');
} catch (PDOException $e) {
    header("HTTP/1.0 500 UPLOAD FAIL");
    die($e->getMessage());
}

//temporary name that PHP gave to the uploaded file
$input = $_FILES['audio_data']['tmp_name'];

//letting the client control the filename is a rather bad idea
$output = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $_FILES['audio_data']['name'] . ".wav"; 


//move the file from temp name to local folder using $output name
if(move_uploaded_file($input, $output)){ //arquivo movido com sucesso
    
    $insert = "INSERT INTO audios (autor, idade, sexo, emocao, descricao, filename, ip) 
               VALUES (NULLIF(:autor,''), :idade, :sexo, :emocao, NULLIF(:descricao, ''),  :filename, :ip)";
    
    $values = array_merge($_POST, ['ip' => $_SERVER['REMOTE_ADDR'] ]);

    try {
        $dbins = $db->prepare($insert);
        if($dbins->execute($values)){
            header("HTTP/1.0 200 OK");
        } else{
            header("HTTP/1.0 500 UPLOAD FAIL");
            die($dbins->errorCode());
        }
    } catch (PDOException $e) {
        header("HTTP/1.0 500 UPLOAD FAIL");
        die($e->getMessage());
    }

} else { //falha no upload
    header("HTTP/1.0 500 UPLOAD FAIL");
    switch ($_FILES["audio_data"]["error"]) {
        case 1:
            echo "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini";
            break;
        case 2:
            echo "O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML";
            break;
        case 3:
            echo "O upload do arquivo foi feito parcialmente";
            break;
        case 4:
            echo "Nenhum arquivo foi enviado";
            break;
        case 6:
            echo "Pasta temporária ausênte";
            break;
        case 7:
            echo "Falha em escrever o arquivo em disco";
            break;
        case 8:
            echo "Uma extensão do PHP interrompeu o upload do arquivo";
            break;
    };
}

?>