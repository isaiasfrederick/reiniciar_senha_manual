<?php

require_once ('../../config.php');
require_once ('plugin_config.php');

function alterarSenha($user_id, $new_password)
{

    global $token;
    global $moodle_url;

    /*$users = [
        [
            'id' => $user_id,
            'password' => $new_password,
            'preferences' => [['type' => 'auth_forcepasswordchange', 'value' => 1]]
        ],
    ];*/

    $url = 'https://ead.uftm.edu.br/webservice/rest/server.php'; // URL para onde você deseja enviar a requisição POST
    $data = 'users[0][id]='.$user_id.'&wstoken=2b671e75c491d763ef13f6728b8ccc23&wsfunction=core_user_update_users&moodlewsrestformat=json&users[0][preferences][0][type]=auth_forcepasswordchange&users[0][preferences][0][value]=1&users[0][password]='.strtolower($new_password); // Dados da query string que você deseja enviar
    
    // Cria um contexto de stream para a requisição POST
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $data,
        ],
    ];
    
    $context = stream_context_create($options);
    
    // Faz a requisição POST e obtém a resposta
    $response = json_decode(file_get_contents($url, false, $context));
    
    // Exibe a resposta da requisição
    return array($response === null, json_encode(($response)));

}