<?php 

// Día del mes con 2 dígitos, y con ceros iniciales, de 01 a 31
date("d");
// Día del mes, sin ceros iniciales, de 1 a 31
date("j");
// Día de la semana en inglés, con 3 letras, de Mon a Sun
date("D");
// Día de la semana en inglés, de Sunday a Saturday
date("l");
// del día de la semana, desde 1 (lunes) hasta 7 (domingo)
date("N");
// Sufijo del día del mes con 2 caracteres --> st, nd, rd o th
date("S");
// Número entero que representa el día de la semana, de 0 (dom) a 6 (sab)
date("W");
// Día del año, de 0 a 365
date("z");

 echo date("W"),'<br/ >';


// Mes actual en inglés, de January a December
date("F");
// Mes actual en 2 dígitos y con 0 en caso del 1 al 9, de 1 a 12
date("m");
// Mes actual en texto en 3 dígitos en inglés, de Jan a Dec
date("M");
// Mes actual en digitos sin 0 inicial, de 1 a 12
date("n");
// Número de días del mes actual, de 28 a 31
date("t");

echo date('n'),'<br/ >';

// Antes del mediodía, despues del mediodía, am o pm (minúsculas)
date("a");
// Antes del mediodía, despues del mediodía, AM o PM (mayúsculas)
date("A");
// Horario de 12 horas sin ceros, de 1 a 12
date("g");
// Horario de 12 horas con ceros, de 01 a 12
date("h");
// Horario de 24 horas sin ceros, de 0 a 23
date("G");
// Horario de 24 horas con ceros, de 01 a 23
date("H");
// minutos con ceros iniciales
date("i");
// segundos con ceros iniciales
date("s");

echo date("d") . " del " . date("m") . " de " . date("Y"),' hora',date('H'),date('i'),date('s');


?>