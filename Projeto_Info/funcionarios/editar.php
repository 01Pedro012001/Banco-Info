<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['Nome'];
    $setor = $_POST['Senha'];
    $usuario = $_POST['Usuario'];
    $senha = $_POST['Senha'];

    $sql = "UPDATE funcionarios SET Nome='$nome', Setor='$setor', Usuario='$usuario', Senha='$senha' WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, Nome, Setor, Usuario, Senha FROM funcionarios WHERE id=$id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $funcionarios = $result->fetch_assoc();
    } else {
        echo "Tarefa não encontrada!";
        exit;
    }
}

$conexao->close();
?>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $funcionarios['id']; ?>">
    Nome: <input type="text" name="Nome" value="<?php echo $funcionarios['Nome']; ?>"><br>
    Setor: <input type="text" name="Email" value="<?php echo $funcionarios['Setor']; ?>"><br>
    Usuario: <input type="text" name="Endereco" value="<?php echo $funcionarios['Usuario']; ?>"><br>
    Senha: <input type="text" name="Telefone" value="<?php echo $funcionarios['Senha']; ?>"><br>
    <input type="submit" value="Salvar">
</form>
