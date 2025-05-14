<?php
// receber_credito.php - Aluno2
// Recebe JSON: conta_destino, valor
$raw_post = file_get_contents('php://input');
file_put_contents(__DIR__ . '/debug_post.txt', $raw_post); // Salva o corpo do POST para debug
$data = json_decode($raw_post, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['status' => 'erro', 'msg' => 'JSON não recebido ou inválido', 'debug_post' => $raw_post]);
    exit;
}

$conta_destino = $data['conta_destino'];
$valor = $data['valor'];

$conn = new mysqli("localhost", "root", "", "banco_aluno2");
if ($conn->connect_error) die(json_encode(["status" => "erro", "msg" => "Conexao falhou"]));

$stmt = $conn->prepare("UPDATE contas SET saldo = saldo + ? WHERE numero_conta = ?");
$stmt->bind_param("ds", $valor, $conta_destino);
$stmt->execute();
$stmt->close();
$conn->close();
echo json_encode(["status" => "ok", "msg" => "Valor creditado na conta destino."]);
?>
