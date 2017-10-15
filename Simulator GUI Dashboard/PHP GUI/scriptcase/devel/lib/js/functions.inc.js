function protectAjaxChar(str_field)
{
	str_field = replaceAll(str_field, '#', '__HASH__');
	str_field = replaceAll(str_field, '+', '__PLUS__');
	str_field = replaceAll(str_field, '-', '__MINUS__');
	str_field = replaceAll(str_field, '.', '__DOT__');
	str_field = replaceAll(str_field, ',', '__COMMA__');
	str_field = replaceAll(str_field, '&', '__E__');
	str_field = replaceAll(str_field, ' ', '__SPC__');
	return str_field;
}

function replaceAll(string, token, newtoken) {
	while (string.indexOf(token) != -1)
	{
 		string = string.replace(token, newtoken);
	}
	return string;
}