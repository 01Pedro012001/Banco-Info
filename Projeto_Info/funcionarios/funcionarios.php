<style>
    body {
        background-color: #ffffff; 
        color: #000000; 
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    header {
        background-color: #f2f2f2; 
        padding: 10px;
        border-bottom: 1px solid #000000; 
    }

    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #3498db; 
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #000000; 
        color: #ffffff; 
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #333333; 
    }

    footer {
        background-color: #f2f2f2; 
        padding: 10px;
        border-top: 1px solid #000000; 
        margin-top: auto;
    }
</style>



<form method="post" action= "funcionarios.php">
    Nome: <input type="text" name="Nome" required><br>
    Setor: <input type="text" name="Setor" required><br>
    Usuario: <input tyoe="text" name="Usuario" required><br>
    Senha: <input type="text" name="Senha" required><br>
    <input type="submit" value="Adicionar">

</form>


<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['Nome'];
        $setor = $_POST['Setor'];
        $usuario = $_POST['Usuario'];
        $senha = $_POST['Senha'];
        
        $sql = 
        "INSERT INTO 
            funcionarios (Nome, Setor, Usuario, Senha) 
        VALUES 
            ('$nome', '$setor', '$usuario', '$senha')";
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro: " . $conexao->error;
        }
    }

    $conexao->close();
?>
