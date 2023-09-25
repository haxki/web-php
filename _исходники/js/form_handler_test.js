var states = {
	'01' : false,
	1 : false,
	3 : false
};
var errorMessages = {
	'01' : "Поле ФИО должно содержать три слова, которые разделенны пробелами.",
	3 : "Ответ должен содержать по крайней мере 35 слов.",
	'empty': "Заполните это поле!"
};
var submitBtn = document.querySelector('form.form input[type="submit"]');
	submitBtn.disabled = true;
var answer01 = $("#answer01");
var answer3 = $("#answer3");

$("#answer01,#answer3")
	.after($('<p>').attr("class","err-msg"))
	.on('input', function(){ errorMessageClear($(this));} )
	.add("#answer11,#answer12,#answer13,#answer14")
	.blur( function(){ 
		switch(this.id){
			case 'answer01': states['01'] = handle_empty('01') && answer01_handle(); break;
			case 'answer11':case 'answer12':case 'answer13':case 'answer14': 
				states[1] = answer1_handle(); break;
			case 'answer3': states[3] = handle_empty(3) && answer3_handle();
		} 
		checkUnblockSubmit(); });

$('form.form').on('reset',
	function(){
		$("#answer01,#answer3").each( function(){ 
			errorMessageClear($(this)); 
			submitBtn.disabled = true;
			});
	});
function answer01_handle(){
	if (answer01.val().split(" ").length!=3){
		invalid(answer01, errorMessages['01']);
		return false;
	} else {
		valid(answer01);
		return true;
		}
	}
function answer1_handle(){
	return $('#answer11')[0].checked || 
		$('#answer12')[0].checked || 
		$('#answer13')[0].checked || 
		$('#answer14')[0].checked;
}

function answer3_handle(){
	if ($("#answer3").val().split(" ").filter(function(word){return word!="";}).length < 35){
		invalid($("#answer3"), errorMessages[3]);
		return false;
	} else {
		valid($("#answer3"));
		return true;
	}
}
function handle_empty(key){
	var answer = $("#answer" + key);
	if(answer!=null && !answer.val()) {
		invalid(answer, errorMessages.empty);
		return false;
	} else { 
		valid(answer);
		return true;
	}
}
function errorMessageClear(input){ 
	input.attr('style','').next().empty(); }
function valid(input){ 
	input.css('background','#9eff9e').next().empty(); }
function invalid(input, msg){ 
	input.css('background','#ff9e9e').next().text(msg); }
function checkUnblockSubmit(){
	submitBtn.disabled = true;
	for(var answ in states) {
		if (states[answ] === false) return;
	}
	submitBtn.disabled = false;
}