<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tipo_pagamneto = $_POST['tipo_pagamneto'];
    $valor = $_POST['Valor'];
    $data_pagamento = $_POST['data_pagamento'];

    $sql = "UPDATE pagamentos SET tipo_pagamento='$tipo_pagamentos', Valor='$valor', data_pagamento='$data_pagamneto', WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, tipo_pagamento, Valor, data_pagamento FROM pagamentos WHERE id=$id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $pagamentos = $result->fetch_assoc();
    } else {
        echo "Pagamento não encontrado!";
        exit;
    }
}

$conexao->close();
?>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $pagamentos['id']; ?>">
    Tipo Pagamento: <input type="text" name="Nome" value="<?php echo $pagamentos['tipo_pagamento']; ?>"><br>
    Valor: <input type="text" name="Email" value="<?php echo $pagamentos['Valor']; ?>"><br>
    Data Pagamento: <input type="text" name="Endereco" value="<?php echo $pagamentos['data_pagamento']; ?>"><br>
    <input type="submit" value="Salvar">
</form>
