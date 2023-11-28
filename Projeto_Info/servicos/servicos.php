<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Serviço</title>
    <style>
        body {
            background-color: #f0f0f0;
            color: #000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: calc(100% - 16px); 
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #0366d6;
            color: #fff;
            cursor: pointer;
        }
        header {
        background-color: #f2f2f2; 
        padding: 0px;
    }

    h1 {
        color: #000000; 
    }

    footer {
        background-color: #f2f2f2; 
        color: #000000; 
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 30%;
    }
    </style>
    <header>
        <h1>Serviços</h1>
    </header>

    <footer>
        <p>Banco Info - Contato: info@bancoinfo.com - Telefone: (123) 456-7890</p>
    </footer>





<?php include '../conexao.php';?>



<form method="post" action="servicos.php">
    Tipo Serviço: <input type="text" name="Tipo_Servico"><br>
    Descrição:<textarea name="Descricao" cols="30" rows="1"></textarea><br>
    Valor: <input tyoe="text" name="Valor"><br>
    Data de Inicio: <input type="text" name="Data_Inicio"><br>
    Data de Conclusão: <input type="text" name="Data_Conclusao"><br>

    <label for="ID_clientes">Cliente:</label>
    <select name="ID_clientes" id="ID_clientes">
        <option value="">Selecionar Cliente</option>
        <?php
            $sql_cliente =
                "SELECT ID, Nome
                            FROM clientes";
            $result_cliente = $conexao->query($sql_cliente);

            while ($row = $result_cliente->fetch_assoc()) {
                $cliente_id = $row['ID'];
                $cliente_nome = $row['Nome'];
                echo "<option value='$cliente_id'> $cliente_nome</option>";
            }

        ?>
    </select><br>

    <label for="ID_Funcionarios">Funcionario:</label>
    <select name="ID_Funcionarios" id="ID_Funcionarios">
        <option value="">Selecionar Funcionario</option>
        <?php
        $sql_funcionario =
            "SELECT ID, Nome
                        FROM funcionarios";
        $result_funcionario = $conexao->query($sql_funcionario);

        while ($row = $result_funcionario->fetch_assoc()) {
            $funcionario_id = $row['ID'];
            $funcionario_nome = $row['Nome'];
            echo "<option value='$funcionario_id'> $funcionario_nome</option>";
        }
        ?>

    </select>
    <br>


    <input type="submit" value="Adicionar">

</form>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_servico = $_POST['Tipo_Servico'];
    $descricao = $_POST['Descricao'];
    $valor = $_POST['Valor'];
    $data_inicio = $_POST['Data_Inicio'];
    $data_conclusao = $_POST['Data_Conclusao'];
    $cliente_id = $_POST['ID_clientes'];
    $funcionario_id = $_POST['ID_Funcionarios'];

    $sql =
        "INSERT INTO 
            servicos (Tipo_Servico, Descricao, Valor, Data_Inicio, Data_Conclusao, ID_clientes, ID_Funcionarios)
        VALUES 
            ('$tipo_servico', '$descricao', '$valor', '$data_inicio', '$data_conclusao', '$cliente_id', '$funcionario_id')";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
    $conexao->close();
}

