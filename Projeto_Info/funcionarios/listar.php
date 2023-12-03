<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2; 
}

h1 {
    color: #333; 
}

a {
    color: #007bff; 
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd; 
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2; 
}

tr:hover {
    background-color: #f5f5f5; 
}
</style>
<?php
include '../conexao.php';

$sql = "SELECT id, Nome, Setor, Usuario, Senha FROM funcionarios";
$result = $conexao->query($sql);
?>

<h1>Funcionarios</h1>
<a href="funcionarios.php">Adicionar Novo Funcionario</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Setor</E-mail></th>
            <th>Usuario</th>
            <th>Senha</th>
            <th>Funções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Nome"] . "</td>";
                echo "<td>" . $row["Setor"] . "</td>";
                echo "<td>" . $row["Usuario"] . "</td>";
                echo "<td>" . $row["Senha"] . "</td>";
                echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Sem Funcionarios</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conexao->close();
?>
