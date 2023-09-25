var states = {
	'fio_test' : false,
	'question1' : false,
	'question3' : false
};
var errorMessages = {
	'fio_test' : "Поле ФИО должно содержать три слова, которые разделенны пробелами.",
	'question3' : "Ответ должен содержать по крайней мере 35 слов.",
	'empty': "Заполните это поле!"
};
var submitBtn = document.querySelector('form.form input[type="submit"]');
	submitBtn.disabled = true;
var answer01 = $("#fio_test");
var answer3 = $("#question3");

$("#fio_test, #question3")
	.after($('<p>').attr("class","err-msg"))
	.on('input', function() { errorMessageClear($(this));} )
	.add("#answer11, #answer12, #answer13, #answer14")
	.blur( function() {
		switch(this.id) {
			case 'fio_test': states.fio_test = handle_empty('#fio_test') && answer01_handle(); break;
			case 'answer11': case 'answer12': case 'answer13': case 'answer14':
				states.question1 = answer1_handle(); break;
			case 'question3': states.question3 = handle_empty('#question3') && answer3_handle();
		} 
		checkUnblockSubmit(); });

$('form.form').on('reset',
	function(){
		$("#fio_test, #question3").each( function(){ 
			errorMessageClear($(this)); 
			submitBtn.disabled = true;
			});
	});
function answer01_handle(){
	if (answer01.val().split(" ").length!=3){
		invalid(answer01, errorMessages.fio_test);
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
	if ($("#question3").val().split(" ").filter(function(word){return word!="";}).length < 35){
		invalid($("#question3"), errorMessages.question3);
		return false;
	} else {
		valid($("#question3"));
		return true;
	}
}
function handle_empty(key){
	var answer = $(key);
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