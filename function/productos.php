<?php

/*
* ean13_DigitoControl. Sirve para generar el dígito de control del código de barras.
* parans --> digitos. Se obtiene los 12 dígitos que componen el código de barras.
* return --> Devuelve el último dígito del código de barras.
*/
function ean13_DigitoControl($digitos){

	// Se convierte a string
	$digitos=(string)$digitos;
	// 1. Se suman los valores impares
	$impares=$digitos{1} + $digitos{3} + $digitos{5} + $digitos{7} + $digitos{9} + $digitos{11};
	// 2. Se mutiplica por 3
	$multImpar=$impares * 3;
	// 3. Se suman los valores pares
	$pares= $digitos{0} + $digitos{2} + $digitos{4} + $digitos{6} + $digitos{8} + $digitos{10};
	// 4. Se suma el valor del paso 2 y el total de los pares
	$total= $multImpar+$pares;
	// 5. Se divide entre diez para saber la centena
	$centena=(ceil($total/10))*10;
	// Se resta el resultado de la suma con el número próximo de la centana
	$check_digit=$centena-$total;
	// Devuelve el dígito del control
	return $check_digit;
}

?>