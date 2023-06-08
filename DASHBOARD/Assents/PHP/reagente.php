<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "seu_usuario", "sua_senha", "seu_banco_de_dados");

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Definir o cabeçalho para permitir requisições de diferentes origens
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, Content-Type");

// Verificar o método da requisição
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        getReagentes($conn);
        break;
    case "POST":
        createReagente($conn);
        break;
    case "PUT":
        updateReagente($conn);
        break;
    case "DELETE":
        deleteReagente($conn, $_REQUEST["id"]);
        break;
    default:
        http_response_code(405); // Método não permitido
        echo "Método não permitido";
        break;
}

// Função para buscar todos os reagentes
function getReagentes($conn) {
    $sql = "SELECT * FROM reagentes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $reagentes = "";
        while ($row = $result->fetch_assoc()) {
            $reagentes .= "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['composicao']}</td>
                    <td>{$row['quantidade_g']}</td>
                    <td>{$row['quantidade_mg']}</td>
                    <td>{$row['localizacao']}</td>
                    <td>
                        <button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#modalAdicionarReagente' data-reagente-id='{$row['id']}'>Editar</button>
                        <button type='button' class='btn btn-danger delete-btn' data-reagente-id='{$row['id']}'>Excluir</button>
                    </td>
                </tr>
            ";
        }
        echo $reagentes;
    } else {
        echo "<tr><td colspan='7'>Nenhum reagente encontrado</td></tr>";
    }
}

// Função para criar um novo reagente
function createReagente($conn) {
    $nome = $_POST["nome"];
    $composicao = $_POST["composicao"];
    $quantidade_g = $_POST["quantidade_g"];
    $quantidade_mg = $_POST["quantidade_mg"];
    $localizacao = $_POST["localizacao"];

    $sql = "INSERT INTO reagentes (nome, composicao, quantidade_g, quantidade_mg, localizacao) VALUES ('$nome', '$composicao', $quantidade_g, $quantidade_mg, '$localizacao')";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Erro interno do servidor
        echo "Erro ao inserir o reagente: " . $conn->error;
    }
}

// Função para atualizar os dados de um reagente
function updateReagente($conn) {
    $id = $_REQUEST["id"];
    $nome = $_POST["nome"];
    $composicao = $_POST["composicao"];
    $quantidade_g = $_POST["quantidade_g"];
    $quantidade_mg = $_POST["quantidade_mg"];
    $localizacao = $_POST["localizacao"];

    $sql = "UPDATE reagentes SET nome='$nome', composicao='$composicao', quantidade_g=$quantidade_g, quantidade_mg=$quantidade_mg, localizacao='$localizacao' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Erro interno do servidor
        echo "Erro ao atualizar o reagente: " . $conn->error;
    }
}

// Função para deletar um reagente pelo ID
function deleteReagente($conn, $id) {
    $sql = "DELETE FROM reagentes WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Erro interno do servidor
        echo "Erro ao deletar o reagente: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
