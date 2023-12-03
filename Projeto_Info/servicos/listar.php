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
$sql = "SELECT  s.ID, 
                s.Tipo_Servico, 
                s.Descricao, 
                s.Valor, 
                s.Data_Inicio, 
                s.Data_Conclusao, 
                c.Nome as cliente, 
                f.Nome as funcionario
                FROM servicos as s 
                left join clientes as c on s.ID_clientes = c.ID
                left join funcionarios as f on s.ID_Funcionarios = f.ID";




$result = $conexao->query($sql);
?>

<h1>Serviços</h1>
<a href="servicos.php">Adicionar Novo Serviço</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo serviço</th>
            <th>Descriçao</th>
            <th>Valor</th>
            <th>Data Inicio</th>
            <th>Data Conclusão</th>
            <th>Cliente</th>
            <th>Funcionario</th>
            <th>Funções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Tipo_Servico"] . "</td>";
                echo "<td>" . $row["Descricao"] . "</td>";
                echo "<td>" . $row["Valor"] . "</td>";
                echo "<td>" . $row["Data_Inicio"] . "</td>";
                echo "<td>" . $row["Data_Conclusao"] . "</td>";
                echo "<td>" . $row["cliente"] . "</td>";
                echo "<td>" . $row["funcionario"] . "</td>";
                echo "<td><a href='editar.php?id=" . $row["ID"] . "'>Editar</a> | <a href='deletar.php?id=" . $row["ID"] . "'>Deletar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Sem Serviços</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conexao->close();
?>