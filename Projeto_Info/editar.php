<?php
include '../../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE tarefas SET nome='$nome', descricao='$descricao' WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, nome, descricao FROM tarefas WHERE id=$id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $tarefa = $result->fetch_assoc();
    } else {
        echo "Tarefa não encontrada!";
        exit;
    }
}

$conexao->close();
?>
<head>
    <link rel="stylesheet" href="../../css/tarefas.css">
</head>
<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
    Título: <input type="text" name="nome" value="<?php echo $tarefa['nome']; ?>"><br>
    Descrição: <textarea name="descricao"><?php echo $tarefa['descricao']; ?></textarea><br>
    <select name="categoria_id" id="categoria_id">
        <option value="<?php echo $tarefa['id']; ?>"><?php echo $tarefa['nome']; ?></option>
        <?php
            $sql_categorias = 
                "SELECT id, nome 
                    FROM categorias";
            $result_categorias = $conexao->query($sql_categorias);

            while ($row = $result_categorias->fetch_assoc()) {
                $categoria_id = $row['id'];
                $categoria_nome = $row['nome'];
                echo "<option value='$categoria_id'>$categoria_nome</option>";
            }
        ?>
    </select><br>
    <input type="submit" value="Salvar">
</form>
