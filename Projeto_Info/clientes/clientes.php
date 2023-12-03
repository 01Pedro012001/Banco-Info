<style>
    body {
        background-color: #ffffff; /* Fundo branco */
        color: #000000; /* Texto preto */
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #f2f2f2; /* Cinza claro para o cabeçalho */
        padding: 20px;
    }

    h1 {
        color: #000000; /* Texto preto para o cabeçalho */
    }

    footer {
        background-color: #f2f2f2; /* Cinza claro para o rodapé */
        color: #000000; /* Texto preto para o rodapé */
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    a {
        color: #3498db; /* Azul para links */
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    form {
        max-width: 400px;
        margin: 50px auto; /* Ajustado para um espaço maior abaixo do cabeçalho */
        padding: 20px;
        background-color: #3498db; /* Azul */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"] {
        width: calc(100% - 16px); /* Ajuste para compensar o padding e a borda */
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #000000; /* Preto */
        color: #ffffff; /* Branco */
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #333333; /* Preto mais escuro */
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff; /* Branco */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #000000; /* Preto */
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #3498db; /* Azul */
        color: #ffffff; /* Branco */
    }

    tr:hover {
        background-color: #f2f2f2; /* Cinza mais claro ao passar o mouse */
    }
</style>

<header>
    <h1>Clientes</h1>
</header>

<footer>
    <p>Banco Info - Contato: info@bancoinfo.com - Telefone: (123) 456-7890</p>
</footer>

<form method="post" action= "clientes.php">
    Nome: <input type="text" name="Nome" required><br>
    E-mail: <input type="text" name="Email"><br>
    Endereço: <input tyoe="text" name="Endereco"><br>
    Telefone: <input type="text" name="Telefone"><br>
    <input type="submit" value="Adicionar">

</form>


<?php
    include '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['Nome'];
        $email = $_POST['Email'];
        $endereco = $_POST['Endereco'];
        $telefone = $_POST['Telefone'];
        
        $sql = 
        "INSERT INTO 
            clientes (Nome, Email, Endereco, Telefone) 
        VALUES 
            ('$nome', '$email', '$endereco', '$telefone')";
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro: " . $conexao->error;
        }
    }

    $conexao->close();
?>


