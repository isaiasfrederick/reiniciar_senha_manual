<?php

$sqlRecuperaUsuariosPermitidosPattern = "SELECT u.id, u.firstname, u.lastname, u.idnumber, u.auth
FROM {user} u
JOIN {role_assignments} ra ON u.id = ra.userid
JOIN {context} ctx ON ra.contextid = ctx.id
JOIN {course} c ON ctx.instanceid = c.id
JOIN {role} r ON ra.roleid = r.id
WHERE c.id = ? AND u.id = ? AND r.shortname IN ('tutor', 'teacher', 'editingteacher', 'manager');";

$sqlEstudanteAlvoPattern = "SELECT u.id, u.firstname, u.lastname, u.idnumber, u.auth
FROM {user} u
JOIN {role_assignments} ra ON u.id = ra.userid
JOIN {context} ctx ON ra.contextid = ctx.id
JOIN {course} c ON ctx.instanceid = c.id
JOIN {role} r ON ra.roleid = r.id
WHERE c.id = ? AND regexp_replace(u.idnumber, '[.-]', '', 'g') = ?
AND r.shortname = 'student' LIMIT 1";