var linkComponents = document.location.href.split("/"); 
var docName = linkComponents[linkComponents.length-1];
if (docName.indexOf('#') !== -1) 
	docName = docName.split('#')[0];
$('nav a[href="'+ docName + '"]').addClass('this-page-li');

$('nav a:not([href="'+docName+'.html"])')
	.mouseover( function(){ $(this).addClass('on-page-li');} )
	.mouseout( function(){ $(this).removeClass('on-page-li');} );

var hobbiesList = $('<ul>');
["films - Фильмы и сериалы", "games - Компьютерные игры", "music - Музыка"]
 .forEach( function(item){
	var pair = item.split(" - ");
	hobbiesList.append(
		$('<li>').append( 
		$('<a>')
			.attr('href','hobbies.html#' + pair[0])
			.text(pair[1])
			.addClass('sublist')
			.mouseover(function(){ 
				$(this).addClass('on-page-li')
				.css('background','#00b4f5'); })
			.mouseout(function(){ 
				$(this).removeClass('on-page-li').attr('style',''); })
		));
	});

hobbiesList.hide();
$('nav a[href="hobbies.html"]').click(
	function(event){
		event.preventDefault();
		$(this).after(hobbiesList).next().toggle();
	});

$('nav a[href="photos.html"]').click(
	function(event){
		event.preventDefault();
		$('body').append(
			$('<div>').addClass('disclaimer').append(
				$('<div>').append(
					$('<p>').text("На данной странице содержатся фотографии Майка Эрмантраута."),
					$('<br>'),
					$('<p>').text("Вы точно хотите их видеть?"),
					$('<div>').append(
						$('<a>').attr('href','photos.html').append(
							$('<div>').text("Да")//"Мне есть 18"
							),
						$('<a>').attr('href','').append(
							$('<div>').text("Нет").click(function(){$('.disclaimer').remove();})
						)
					)
				)
			)
		);
	});