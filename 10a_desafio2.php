<!-- Digite sua solução para o desafio (AQUI) -->
 <?php
$host = 'localhost';
$dbname = 'exercicio';
$username = 'root'; 
$password = 'Senai@118';

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe e limpa os dados do formulário
    $nome = trim($_POST['nome']);
    $preco = str_replace(',', '.', trim($_POST['preco'])); // Permite uso de vírgula em decimais

    // Validação
    if (empty($nome)) {
        $mensagem = "<p style='color: red;'>Erro: O nome do produto não pode estar vazio.</p>";
    } elseif (!is_numeric($preco) || $preco <= 0) {
        $mensagem = "<p style='color: red;'>Erro: O preço deve ser um número positivo maior que zero.</p>";
    } else {
        // Se os dados forem válidos, tenta inserir no banco de dados
        try {
            // Conexão PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara e executa a inserção
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->execute();

            $mensagem = "<p style='color: green;'>Produto cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro de banco de dados: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 250px; padding: 8px; }
        button { padding: 10px 15px; background-color: #0056b3; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #004494; }
    </style>
</head>
<body>

    <h2>Cadastro de Produtos</h2>

    <!-- Exibe as mensagens de sucesso ou erro -->
    <?= $mensagem ?>

    <!-- Formulário HTML -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome">
        </div>
        
        <div class="form-group">
            <label for="preco">Preço (R$):</label>
            <input type="text" name="preco" id="preco">
        </div>
        
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>