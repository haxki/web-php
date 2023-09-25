var fotos = [];
for (var i = 0; i < 18; i++) 
	fotos.push("img/bb/" + (i+1) + ".jpg");
var titles = ["По пути в школу","Осенние каникулы","Купил бутерброд в столовой",
	"Хочу наклейки с машинками","Привет!","Приходится избегать старшеклассников",
	"Делаем ремонт в классе, вляпался в шпаклевку","ИЗО","Физра на улице",
	"\"Гадкий Я\" мой любимый мультфильм!","Сажаю лук на уроке трудов",
	"Старшаки посадили в землю, пророс","Последний звонок - больше не в началке",
	"Несколько дней без пива","Новый год","Объясняю Тайсону как правильно драться",
	"Завтра 7 уроков и классный час","Подписал футболку для физкультуры, чтоб не украли"
];



	for (var i = 0; i < fotos.length; i++) {
		$('.gallery').append(
			$('<div>').append(
				$('<img>').attr({'src' : fotos[i], 'title' : titles[i], 'alt' : 'Фото не найдено'}), 
				$('<p>').text(titles[i])
			)
		);
	}
	
	fotos.forEach(function(foto){
		$('img[src="'+foto+'"]').click( 
			function(){
				if ($('.fingers')[0]===undefined){
					var imgNum = foto.split('/')[foto.split('/').length-1].split('.')[0];
					var imgInfo = $('<div>').text(imgNum + ' фото из ' + $('.gallery img').length);
					var fingerPrev = $('<div>')
						.text('👈')
						.click(function(){ 
							if (imgNum > 1) {
								imgNum--;
								$('.img-window img')
									.animate({opacity:0},500,'linear',
										function(){
											$(this).replaceWith($($('.gallery img').get(imgNum-1)).clone());

											imgInfo.text(imgNum + ' фото из ' + $('.gallery img').length);
							
											if (imgNum >= $('.gallery img').length) fingerNext.fadeTo(0, 0.5);
											else fingerNext.removeAttr('style');
											if (imgNum <= 1) fingerPrev.fadeTo(0, 0.5);
											else fingerPrev.removeAttr('style');	

											$('.img-window').css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
										});
							}
						});
					var fingerNext = $('<div>')
						.text('👉')
						.click(function(){
							if (imgNum < $('.gallery img').length) { 
								imgNum++;
								$('.img-window img')
									.animate({opacity:0},500,'linear',
										function(){
											$(this).replaceWith($($('.gallery img').get(imgNum-1)).clone());

											imgInfo.text(imgNum + ' фото из ' + $('.gallery img').length);
							
											if (imgNum >= $('.gallery img').length) fingerNext.fadeTo(0, 0.5);
											else fingerNext.removeAttr('style');
											if (imgNum <= 1) fingerPrev.fadeTo(0, 0.5);
											else fingerPrev.removeAttr('style');	

											$('.img-window').css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
										});
							}
						});

					if (imgNum <= 1)
						fingerPrev.fadeTo(0, 0.5);
					else if (imgNum >= $('.gallery img').length) 
						fingerNext.fadeTo(0, 0.5);

					$('<div>')
					.append(
						$(this).clone(),
						$('<div>').attr('class','fingers')
							.append(fingerPrev, imgInfo, fingerNext)
						)
					.appendTo($('body'))
					.click(function(event){
						if(event.target!==fingerNext[0] &&
						 event.target!==fingerPrev[0] && 
						 event.target!==imgInfo[0] &&
						 event.target !== $('.fingers')[0]
						 )
							$(this).remove();
						})
					.attr('class', 'img-window')
					.css('left', (outerWidth/2 - $('.img-window img').width()/2)/outerWidth*100 + '%');
				}
			}
		);
	});