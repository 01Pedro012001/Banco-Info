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
    select {
        width: 100%;
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
    
</style>

  


<?php include '../conexao.php' ?>
<form method="post" action="pagamentos.php">
</form>
<?php
include '../conexao.php';

$conexao->close();
?>
</body>

</html>









<?php include '../conexao.php' ?>
<form method="post" action="pagamentos.php">
    Tipo de Pagamento: <input type="text" name="tipo_pagamento"><br>
    Valor: <input type="text" name="Valor"><br>
    Data de Pagamento: <input type="text" name="data_pagamento"><br>
    <label for="ID_Servicos">Serviços:</label>
    <select name="ID_Servicos" id="ID_Servicos">
        <option value="">Selecionar Serviço</option>
        <?php
        $sql_servicos =
            "SELECT ID, Tipo_Servico
                        FROM servicos";
        $result_servicos = $conexao->query($sql_servicos);

        while ($row = $result_servicos->fetch_assoc()) {
            $servico_id = $row['ID'];
            $servico_nome = $row['Tipo_Servico'];
            echo "<option value='$servico_id'> $servico_nome</option>";
        }

        ?>

    </select><br>

    <input type="submit" value="Adicionar Pagamento">

</form>


<?php
include '../conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_pagamento = $_POST['tipo_pagamento'];
    $valor = $_POST['Valor'];
    $data_pagamento = $_POST['data_pagamento'];
    $servicos_id = $_POST['ID_Servicos'];


    $sql =
        "INSERT INTO 
            pagamentos (tipo_pagamento, Valor, data_pagamento, ID_Servicos) 
        VALUES  
            ('$tipo_pagamento', '$valor', '$data_pagamento', '$servicos_id')";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
}

$conexao->close();
?>