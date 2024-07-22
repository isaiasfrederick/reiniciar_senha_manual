<?php
require ('../../config.php');
require_once ('plugin_config.php');
require_once ('sql_patterns.php');
require_once ('trocar.php');

global $DB;
global $CFG;
global $USER;

require_login();

$cpf_text = required_param('cpf_text', PARAM_TEXT);

$PAGE->set_url('/local/uftm_reiniciarsenhamanual/submit.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Resultado do Formulário');
$PAGE->set_heading('Resultado do Formulário');

$sqlRecuperaUsuariosPermitidos = $sqlRecuperaUsuariosPermitidosPattern;

$registrosOperadoresPermitidos = $DB->get_records_sql($sqlRecuperaUsuariosPermitidos, array($curso_permitido, $USER->id), 0);

echo $OUTPUT->header();

if (count($registrosOperadoresPermitidos) == 0) {
    echo $OUTPUT->box("<div class=\"alert alert-danger\" role=\"alert\"><b>Seu usuário, o '" . $USER->username . "', nao tem permissão para essa operacao! É necessário ser tutor, professor ou gerente para reiniciar a senha desse aluno.</b>
    </div>");
} else {
    $sqlEstudanteAlvo = $sqlEstudanteAlvoPattern;

    $registros = $DB->get_records_sql($sqlEstudanteAlvo, array($curso_permitido, $cpf_text), 0);

    // Se existe pelo menos UM estudante com esse idnumber (CPF) para 
    if (count($registros) == 1) {
        $registros = $array = array_values($registros);
        $senhapadrao = '';

        $id = $registros[0]->id;
        $firstname = $registros[0]->firstname;
        $lastname = $registros[0]->lastname;
        $idnumber = $registros[0]->idnumber;
        $auth = $registros[0]->auth;

        $senhapadrao = substr($firstname, 0, 2) . substr($idnumber, 0, 2) . substr($idnumber, -2) . substr($idnumber, -2);

        if ($auth == 'manual') {
            $retAlterarSenha = alterarSenha($id, $senhapadrao);
            if ($retAlterarSenha[0] === True) {
                echo $OUTPUT->box("<div class=\"alert alert-success\" role=\"alert\"><b>A SENHA FOI ALTERADA COM SUCESSO!</b>
            </div>");
                echo $OUTPUT->box("<b>Nome cursista:</b> " . "<a href=\"" . $wwwroot . "/user/profile.php?id=" . $id . "\">" . $firstname . " " . $lastname . "</a>");
                echo $OUTPUT->box("<b>CPF:</b> " . $idnumber);
                echo $OUTPUT->box("<b>Senha padrão reestabelecida:</b> <p style='font-size:x-large'><b style='color:red'>" . strtolower($senhapadrao) . "</b></p>");
                echo $OUTPUT->box("<b>É necessário contactar o cursista sobre a mudança!</b>");
            } else {
                echo $OUTPUT->box("<div class=\"alert alert-warning\" role=\"alert\"><b>Por alguma razão, a senha não foi trocada   =(  ! Contacte o administrador!</b></div>");
            }
        } else {
            if ($auth == 'db') {
                echo $OUTPUT->box("<div class=\"alert alert-warning\" role=\"alert\"><b>A TROCA DE SENHA PARA ESSE PERFIL DE USUÁRIO SEGUE O PADRÃO UFTM E <u>NÃO PODERÁ SER ALTERADA</u> PELO TUTOR!</b>
            </div>");
                echo $OUTPUT->box("Peça ao/à cursista <b><i><a href=\"" . $wwwroot . "/user/profile.php?id=" . $id . "\">" . $firstname . " " . $lastname . "</a></i></b> que acesse o \"Esqueceu o seu usuário ou senha\" na página de login");
                echo $OUTPUT->box("<a href=\"https://ead.uftm.edu.br/login/forgot_password.php\">Link com a página para trocar senha de TODOS os sistemas UFTMNet</a>");
                echo $OUTPUT->box("Qualquer dúvida por parte do cursista no processo de trocar senha poderá ser bem respondida pelo e-mail suporte.dti@uftm.edu.br");
            } else {
                echo $OUTPUT->box("<div class=\"alert alert-error\" role=\"alert\"><b>ERRO! Contacte o administrador!</b></div>");
            }
        }
    } else {
        echo $OUTPUT->box("<div class=\"alert alert-danger\" role=\"alert\"><b>O estudante não foi encontrado! Você pode ter digitado o CPF errado!</b></div>");
    }
}

echo $OUTPUT->footer();

?>