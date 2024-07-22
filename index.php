<?php

require_once ('../../config.php');

require_login();

global $COURSE;

// Página de contexto do Moodle.
$PAGE->set_context(context_system::instance());

// Título da página.
$PAGE->set_title('Troca de senha');

// Cabeçalho da página.
$PAGE->set_heading('Troca de senha');

// URL da página.
$url = new moodle_url('/local/uftm_reiniciarsenhamanual/index.php');
$PAGE->set_url($url);

// Limpa o cache de saída.
$PAGE->set_cacheable(true);

// Início do código HTML da página.
echo $OUTPUT->header();

// Mensagem que será exibida.
$html = '<form action="' . $CFG->wwwroot . '/local/uftm_reiniciarsenhamanual/submit.php" method="post" target="_blank">';
$html .= '<b>CPF:</b><p><input class="input-group-text" style="text-align:left;" required placeholder="Sem pontos e sem hífen" type=text name="cpf_text" rows="1" cols="24" maxlength="11" pattern="[0-9]{11}"></input><br>';
$html .= '<input class="btn btn-primary" type="submit" value="Reiniciar a senha">';
$html .= '</form>';

echo $html;

// Fim do código HTML da página.
echo $OUTPUT->footer();


