<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['Nome'];
    $email = $_POST['Email'];
    $endereco = $_POST['Endereco'];
    $telefone = $_POST['Telefone'];

    $sql = "UPDATE clientes SET Nome='$nome', Email='$Email', Endereco='$endereco', Telefone='$telefone' WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        header("Location: listar.php");
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, Nome, Email, Endereco, Telefone FROM clientes WHERE id=$id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $clientes = $result->fetch_assoc();
    } else {
        echo "Cliente não encontrada!";
        exit;
    }
}

$conexao->close();
?>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $clientes['id']; ?>">
    Nome: <input type="text" name="Nome" value="<?php echo $clientes['Nome']; ?>"><br>
    E-mail: <input type="text" name="Email" value="<?php echo $clientes['Email']; ?>"><br>
    Endereço: <input type="text" name="Endereco" value="<?php echo $clientes['Endereco']; ?>"><br>
    Telefone: <input type="text" name="Telefone" value="<?php echo $clientes['Telefone']; ?>"><br>
    <input type="submit" value="Salvar">
</form>
