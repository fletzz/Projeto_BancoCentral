<?php
// transferir.php - Aluno1
// Recebe JSON: conta_destino, banco_destino, valor
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['status' => 'erro', 'msg' => 'JSON não recebido ou inválido', 'debug_post' => file_get_contents('php://input')]);
    exit;
}

$conta_origem = "12345"; // Número da conta local do aluno1
$banco_origem = "aluno1";
$conta_destino = $data['conta_destino'];
$banco_destino = $data['banco_destino'];
$valor = $data['valor'];

// Envia para o banco central
$url = 'https://bancocentral123.loca.lt/bancocao/central/processa_transferencia.php'; // Troque pelo seu endereço do banco central
$payload = json_encode([
  'conta_origem' => $conta_origem,
  'banco_origem' => $banco_origem,
  'conta_destino' => $conta_destino,
  'banco_destino' => $banco_destino,
  'valor' => $valor
]);
$options = [
  'http' => [
    'header'  => "Content-type: application/json\r\n",
    'method'  => 'POST',
    'content' => $payload,
  ],
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo $result;
?>
