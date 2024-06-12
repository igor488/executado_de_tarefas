<?php
header('Content-Type: application/json');

// Leia o conteúdo da solicitação
$input = file_get_contents('php://input');

// Registre o conteúdo da solicitação para diagnóstico
file_put_contents('php_input.log', $input);

// Decodifica o JSON recebido
$data = json_decode($input, true);

// Verifica se a decodificação ocorreu corretamente
if ($data === null) {
    echo json_encode(['response' => 'Erro ao decodificar JSON.']);
    exit;
}

// Verifica se as chaves 'message' e 'action' existem
if (!isset($data['message']) || !isset($data['action'])) {
    echo json_encode(['response' => 'Dados de entrada inválidos.']);
    exit;
}

$message = escapeshellarg($data['message']);
$action = $data['action'];
$response = '';

if ($action === 'pesquisa') {
    $comando = "python3 script_pesquisa.py " . $message;
    $output = shell_exec($comando);
    $response = $output ? $output : 'Nenhum resultado encontrado.';
} elseif ($action === 'pyautogui') {
    $comando = "python3 script_point.py " . $message;
    $output = shell_exec($comando);
    $response = $output ? $output : 'Ação concluída.';
} else {
    $response = 'Ação inválida.';
}

echo json_encode(['response' => $response]);
?>
