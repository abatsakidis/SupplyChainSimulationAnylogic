var nbIdentifiers = 0;
var idRow = 0;

function addIdentifier(id) {
	nbIdentifiers++;
	idRow++;
	
	if(document.getElementById('identifiersContainer').style.display === 'none') {
		document.getElementById('identifiersContainer').style.display = '';
	}
	if(document.getElementById('identifiersButton').style.display === 'none') {
		document.getElementById('identifiersButton').style.display = '';
	}
	
	var newIdentifier = document.createElement("DIV");
	newIdentifier.id = 'identifier_' + idRow;
	newIdentifier.style.height = '25px';
	newIdentifier.style.position = 'relative';
	newIdentifier.style.marginTop = '2px';
	newIdentifier.innerHTML = '<input type="text" name="textTemp[0][]" value="' + id + '" style="width:40px;" /> - <input type="text" name="textTemp[1][]" style="width:295px;" /><a href="javascript:removeIdentifier(' + idRow + ');"><img src="delete.png" alt="Delete" style="border:0px; margin-left:5px; margin-top:5px;" /></a>';
	document.getElementById('identifiersContainer').appendChild(newIdentifier);
	document.getElementById('identifier').value = '';
}

function removeIdentifier(id) {
	nbIdentifiers--;
	document.getElementById('identifiersContainer').removeChild(document.getElementById('identifier_' + id));
	if(nbIdentifiers === 0) {
		document.getElementById('identifiersButton').style.display = 'none';
		document.getElementById('identifiersContainer').style.display = 'none';
	}
}

function sendForm() {
	var text2display = document.getElementsByName("text2display");
	var barcodeDrawer = document.getElementsByName("barcode_drawer");
	var gs1128Id = document.getElementsByName("textTemp[0][]");
	var gs1128Content = document.getElementsByName("textTemp[1][]");
	text2display[0].value = '';
	
	for(var i = 0; i < gs1128Id.length; i++) {
		text2display[0].value = text2display[0].value + '(' + gs1128Id[i].value + ')';
		text2display[0].value = text2display[0].value + gs1128Content[i].value + unescape('%1D');
	}
	barcodeDrawer[0].submit();
}