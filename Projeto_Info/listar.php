<?php

include '../../conexao.php';
    $sql = "SELECT 
                t.id, 
                t.nome AS titulo, 
                t.descricao, 
                t.criado_em, 
                c.nome AS categoria
            FROM tarefas as t
            LEFT JOIN categorias as c ON t.categoria_id = c.id";
    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="../../css/tarefas.css">
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Tarefas</h1>
    <a href="adicionar.php">Adicionar Nova Tarefa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["titulo"] . "</td>";
                    echo "<td>" . $row["descricao"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td>" . $row["criado_em"] . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | 
                    <a href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Sem tarefas</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php $conexao->close(); ?>
