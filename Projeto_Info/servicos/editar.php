<?php include '../conexao.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $tipo_servico = $_POST['Tipo_Servico'];
    $Descricao = $_POST['Descricao'];
    $Valor = $_POST['Valor'];
    $data_inicio = $_POST['Data_Inicio'];
    $data_conclusao = $_POST['Data_Conclusao'];
    $ID_clientes = $_POST['ID_clientes'];
    $ID_Funcionarios = $_POST['ID_Funcionarios'];

    $sql = "UPDATE servicos SET Tipo_Servico= '$tipo_servico', Descricao='$Descricao', Valor='$Valor', Data_Inicio= '$data_inicio', Data_Conclusao='$data_conclusao', ID_clientes='$ID_clientes', ID_Funcionarios='$ID_Funcionarios' WHERE ID=$ID";

    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $ID = $_GET['id'];
    $sql = "SELECT ID, Tipo_Servico, Descricao, Valor, Data_Inicio, Data_Conclusao, ID_clientes, ID_Funcionarios FROM servicos WHERE ID=$ID";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $servicos = $result->fetch_assoc();
    } else {
        echo "Serviço não encontrado!";
        exit;
    }
}

$conexao->close();
?>

<form method="post" action="editar.php">
    <input type="hidden" name="ID" value="<?php echo $servicos['ID']; ?>">
    Tipo Serviço: <input type="text" name="Tipo_Servico" value="<?php echo $servicos['Tipo_Servico']; ?>"><br>
    Descrição: <input type="text" name="Descricao" value="<?php echo $servicos['Descricao']; ?>"><br>
    Valor: <input type="text" name="Valor" value="<?php echo $servicos['Valor']; ?>"><br>
    Data de Inicio: <input type="text" name="Data_Inicio" value="<?php echo $servicos['Data_Inicio']; ?>"><br>
    Data de Conclusão: <input type="text" name="Data_Conclusao" value="<?php echo $servicos['Data_Conclusao']; ?>"><br>
    <label for="ID_clientes">Cliente:</label>
    <select name="ID_clientes" id="ID_clientes">
        <option value="">Selecionar Cliente</option>
        <?php
            $sql_clientes = 
                "SELECT ID, Nome 
                    FROM clientes";
            $result_servicos = $conexao->query($sql_clientes);

            while ($row = $result_categorias->fetch_assoc()) {
                $cliente_id = $row['ID'];
                $cliente_nome = $row['Nome'];
                echo "<option value='$cliente_id'>$cliente_nome</option>";
            }
        ?>
    </select><br>
    <input type="submit" value="Salvar">