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

$sql = "SELECT  p.ID, 
                p.tipo_pagamento, 
                p.Valor, 
                p.data_pagamento, 
                s.Tipo_Servico
        FROM pagamentos as p inner join servicos as s on p.ID_Servicos = s.ID";

$result = $conexao->query($sql);
?>

<h1>Pagamentos</h1>
<a href="pagamentos.php">Adicionar Novo Pagamento</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo Pagamento</th>
            <th>Valor</th>
            <th>Data Pagamento</th>
            <th>Tipo Serviço</th>
            <th>Funções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["tipo_pagamento"] . "</td>";
                echo "<td>" . $row["Valor"] . "</td>";
                echo "<td>" . $row["data_pagamento"] . "</td>";
                echo "<td>" . $row["Tipo_Servico"] . "</td>";
                echo "<td><a href='editar.php?id=" . $row["ID"] . "'>Editar</a> | <a href='deletar.php?id=" . $row["ID"] . "'>Deletar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Sem Pagamentos</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conexao->close();
?>
