<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; 
            margin: 0;
            padding: 0;
        }

        form {
            width: 20%;
            margin: 200px auto;
            background-color: #fff; 
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input[type="text"],
        select,
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 8px;
            width: calc(100% - 16px);
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 10px;
        }
    </style>
<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tipo_pagamento = $_POST['tipo_pagamento'];
    $valor = $_POST['Valor'];
    $data_pagamento = $_POST['data_pagamento'];

    
    $sql = "UPDATE pagamentos SET tipo_pagamento='$tipo_pagamento', Valor='$valor', data_pagamento='$data_pagamento' WHERE ID=$id";
    
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT ID, tipo_pagamento, Valor, data_pagamento FROM pagamentos WHERE ID=$id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $pagamentos = $result->fetch_assoc();
    } else {
        echo "Pagamento não encontrado!";
        exit;
    }
}
?>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $pagamentos['ID']; ?>">
    Tipo Pagamento: <input type="text" name="tipo_pagamento" value="<?php echo $pagamentos['tipo_pagamento']; ?>"><br>
    Valor: <input type="text" name="Valor" value="<?php echo $pagamentos['Valor']; ?>"><br>
    Data Pagamento: <input type="text" name="data_pagamento" value="<?php echo $pagamentos['data_pagamento']; ?>"><br>
    <select name="ID_Servicos" id="ID_Servicos">
        <option value="">Selecionar Serviço</option>
        <?php
        $sql_servicos = "SELECT ID, Tipo_Servico FROM servicos";
        $result_servicos = $conexao->query($sql_servicos);

        while ($row = $result_servicos->fetch_assoc()) {
            $servico_id = $row['ID'];
            $servico_nome = $row['Tipo_Servico'];
            echo "<option value='$servico_id'> $servico_nome</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Salvar">
</form>
<?php $conexao->close(); ?>
