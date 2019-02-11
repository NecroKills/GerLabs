<?php

("SELECT
      LAB.nome AS nomeLaboratorio,
      RES.title,
      RES.color,
      RES.start,
      RES.end,
      USER.nome AS usuarioNome,
      USER.email AS usuarioEmail,
      PROF.nome AS professorNome
FROM
     usuarios AS USER,
     professores AS PROF,
     laboratorios AS LAB,
     reservas AS RES

WHERE     PROF.id = RES.professores_id
      and USER.id = RES.usuarios_id
      and LAB.id = RES.laboratorios_id
      and RES.laboratorios_id = 3
      and RES.situacao = 0")

 ?>
