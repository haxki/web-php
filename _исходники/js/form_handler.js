var contactStates = {
	1: false,
	2: false,
	4: false,
	5: false,
	'phone': false,
	'Date': false
};
var defaultAnswerDate = "Выберите дату в таблице...";
var errorMessages = {
	'contact1': "Поле ФИО должно содержать три слова, которые разделенны пробелами.",
	'contact2': "Вы не отметили свой пол.",
	'contact4': "Некорректный e-mail!",
	'phone': "Телефон может начинаться только с \"+7\" или \"+3\" и содержать от 9 до 11 цифр без посторонних символов (в том числе пробелов).",
	'empty': "Заполните это поле!",
	'emptyDate': "Вы не выбрали дату рождения."
};
var popMessages = {
	'pop1': "Поле ФИО должно содержать три слова, которые разделены пробелами.",
	'pop2': "Нажмите на любой радиобатн.",
	'pop4': "Е-mail должен содержать некоторое количество символов, собаку, точки, все дела.",
	'popPhone': "Телефон может начинаться только с \"+7\" или \"+3\" и содержать от 9 до 11 цифр без посторонних символов (в том числе пробелов).",
	'pop3': "Нужно выбрать ваш актуальный возраст. Например, были бы вы Майком, а вам в таком случае 112 лет, вам бы следовало взять вариант \"От 55\".",
	'pop5': "Прийдется написать сообщение.",
	'popDate': "Нужно нажать на это поле и выбрать дату."
};
var submitBtn = document.querySelector('form.form input[type="submit"]');
submitBtn.disabled = true;
var timerId;

placeErrorMessageBlocks();
setErrorBehaviours();

function placeErrorMessageBlocks(){
	$('#answer1,#answer4,#answer5,#phone,#answerDate')
		.after($('<p>').addClass('err-msg'))
		.on('input',function(){ errorMessageClear($(this)); })
		.add('#answer21,#answer22')
		.blur(function(){
			switch(this.id){
				case 'answer1': contactStates[1] = handle_empty($('#answer1')) && answer1_handle(); break;
				case 'answer21': case 'answer22': contactStates[2] = answer2_handle(); break;
				case 'answer4': contactStates[4] = handle_empty($('#answer4')) && answer4_handle(); break;
				case 'answer5': contactStates[5] = handle_empty($('#answer5')); break;
				case 'phone': contactStates.phone = handle_empty($('#phone')) && phone_handle(); break;
			}
			checkUnblockSubmit(); 
		})
		.add('#answer3')
		.mouseenter(function(){
			switch(this.id){
				case 'answer1': popOver(this,popMessages.pop1); break;
				case 'answer3': popOver(this,popMessages.pop3); break;
				case 'answer21': case 'answer22': 
					popOver(this,popMessages.pop2); break;
				case 'answer4': popOver(this,popMessages.pop4); break;
				case 'answer5': popOver(this,popMessages.pop5); break;
				case 'phone': popOver(this,popMessages.popPhone); break;
				case 'answerDate': popOver(this,popMessages.popDate); break;
			}
		})
		.mouseleave(function(){
			timerId = setTimeout(function(){ $('.popover').remove(); },1000);
		});
	}


function setErrorBehaviours(){

	$('form.form').on('reset',
		function(){
			$('#answer1,#answer4,#answer5,#phone,#answerDate').each(
				function(){ 
					errorMessageClear($(this));
					submitBtn.disabled = true;
				});
		});

	$('.calendar>nav>div').click(function(){
		if($('#answerDate').val()===defaultAnswerDate){
			invalid($('#answerDate'), errorMessages.emptyDate);
			contactStates.Date = false;
		} else {
			valid($('#answerDate'));
			contactStates.Date = true;
		}
		checkUnblockSubmit();
	});

	$('.calendar>div:last-of-type>div').each(
		function(){
			$(this).click( 
				function(){
					valid($('#answerDate'));
					contactStates.Date = true;
				}); 
		});
}

function answer1_handle(){
	if ($('#answer1').val().split(" ").length!=3){
		invalid($('#answer1'), errorMessages.contact1);
		return false;
	} else {
		valid($('#answer1'));
		return true;
		}
	}

function phone_handle(){
	var pref = $('#phone').val().substring(0,2); 
	var num_count = $('#phone').val().length-1;
	
	if (!numberIsValid()) {
		invalid($('#phone'), errorMessages.phone);
		return false;
	} else {
		valid($('#phone'));
		return true;
	}

	function numberIsValid(){
		return num_count>=9 && num_count<=11 && 
			!isNaN($('#phone').val().substring(1)) && 
			$('#phone').val().split(" ").length==1 && 
			(pref=="+3" || pref=="+7");
		}
	}
function answer2_handle(){ 
	return $('#answer21')[0].checked || $('#answer22')[0].checked;
	}
function answer4_handle(){
	if(email_is_invalid()){ 
		invalid($('#answer4'), errorMessages.contact4); 
	    return false;
	} else { 
		valid($('#answer4'));
		return true; 
	}
	
	function email_is_invalid(){
	  var email = $('#answer4').val();
	  var firstAt = email.indexOf('@'), lastAt = email.lastIndexOf('@'),
	      firstDot = email.indexOf('.'), lastDot = email.lastIndexOf('.');
	  
	  return firstAt==-1 || firstDot==-1 || firstAt!=lastAt || 
	  	   firstAt-lastDot>0 || firstAt==0 || firstDot==0 || 
	  	   lastDot==email.length-1 || email.split("@")[1].indexOf('.')==0;
	}
}

function handle_empty(answer){
	if($(answer)!=null && !$(answer).val()) {
		invalid($(answer), errorMessages.empty);
		return false;
	} else { 
		valid($(answer));
		return true;
	}
}

function errorMessageClear(input){
	$(input).removeAttr('style').next().empty();
}
function valid(input){
	$(input).css('background','#9eff9e').next().empty();
	}
function invalid(input, msg){
	$(input).css('background','#ff9e9e').next().text(msg);
	}
function checkUnblockSubmit(){
	submitBtn.disabled = true;
	for(var answ in contactStates) {
		if (contactStates[answ] === false) return;
	}
	submitBtn.disabled = false;
}

function popOver(elem,msg){
	clearTimeout(timerId);
	$('.popover').remove();
	$(elem)
		.after(
			$('<div>')
			.attr('class','popover')
			.text(msg)
			.offset({
				top: $(elem).position().top+20,
				left: $(elem).position().left
			})
		);
}	