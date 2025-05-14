<?php
// processa_transferencia.php - Banco Central
// Recebe JSON: conta_origem, banco_origem, conta_destino, banco_destino, valor
$raw_post = file_get_contents('php://input');
file_put_contents(__DIR__ . '/debug_post.txt', $raw_post); // Salva o corpo do POST para debug
$data = json_decode($raw_post, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['status' => 'erro', 'msg' => 'JSON não recebido ou inválido', 'debug_post' => $raw_post]);
    exit;
}

$conta_origem = $data['conta_origem'];
$banco_origem = $data['banco_origem'];
$conta_destino = $data['conta_destino'];
$banco_destino = $data['banco_destino'];
$valor = $data['valor'];

$conn = new mysqli("localhost", "root", "", "banco_central");
if ($conn->connect_error) die(json_encode(["status" => "erro", "msg" => "Conexao falhou"]));

$stmt = $conn->prepare("INSERT INTO transacoes (conta_origem, banco_origem, conta_destino, banco_destino, valor, status) VALUES (?, ?, ?, ?, ?, 'pendente')");
$stmt->bind_param("ssssd", $conta_origem, $banco_origem, $conta_destino, $banco_destino, $valor);
$stmt->execute();
$stmt->close();
$conn->close();

// Notifica automaticamente o aluno2 via HTTP POST
$url_destino = "https://teste.loca.lt/Banco/transferencias.php";
$payload_destino = json_encode([
    'conta_destino' => $conta_destino,
    'valor' => $valor
]);
$options_destino = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $payload_destino,
    ],
];
$context_destino  = stream_context_create($options_destino);
$result_destino = @file_get_contents($url_destino, false, $context_destino);
file_put_contents(__DIR__ . '/debug_envio_aluno2.txt', "URL: $url_destino\nPayload: $payload_destino\nResposta: $result_destino\n", FILE_APPEND);

// Resposta final para quem chamou o banco central
if ($result_destino === FALSE) {
    echo json_encode(["status" => "ok", "msg" => "Transferencia registrada no banco central, mas falha ao notificar aluno2."]);
} else {
    echo json_encode(["status" => "ok", "msg" => "Transferencia registrada e notificada ao aluno2.", "resposta_aluno2" => $result_destino]);
}
?>
