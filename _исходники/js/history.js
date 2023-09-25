var headers, currentHistoryTable, allHistoryTable;
var docName, docNames;

setCurrentDocName();
incrementVisiting();
if (docName==='history') {
	pageNamesInit();
	tableInit();
}

function setCurrentDocName() {
	var linkComponents = document.location.href.split('/'); 
	docName = linkComponents[linkComponents.length-1];
	docName = docName.split('.')[0];
	}
function pageNamesInit(){
	docNames = [];
	$('main > nav:first-child > ul > li > a').each(
		function() { docNames.push(extractDocName(this.href)); }
	);}
function tableInit() {
	currentHistoryTable = $('<table>').html("<th>Страница</th><th>Количество посещений</th>");
	allHistoryTable = currentHistoryTable.clone(true);
	
	$('main > nav:first-child > ul > li > a').each(
		function(){
			var tempDocName = extractDocName(this.href);
			var tempDocNameRu = this.textContent;

			addTableRow(currentHistoryTable, sessionStorage.getItem(tempDocName));
			addTableRow(allHistoryTable, getCookie(tempDocName));

			function addTableRow(table, rowCountVal){
				table.append(
				$('<tr>')
					.append($('<td>').text(tempDocNameRu))
					.append($('<td>').text(rowCountVal || "0"))
				);
			}
		}
	);
	$('.content h2').get(0).after(currentHistoryTable.get(0));
	$('.content h2').get(1).after(allHistoryTable.get(0));
	
	}
function extractDocName(link){
	return link.split('/')[link.split('/').length-1].split('.')[0];
	}
function incrementVisiting(){
	var oldValueStorage = sessionStorage.getItem(docName);
	var oldValueCookie = getCookie(docName);
	
	if (oldValueStorage === undefined) oldValueStorage = 0;
	if (oldValueCookie === undefined) oldValueCookie = 0;

	sessionStorage.setItem(docName, oldValueStorage - 0 + 1);
	setCookie(docName, oldValueCookie - 0 + 1, 7);
	}
function setCookie(name, value, days) {
    var oldValue = getCookie(name);
    if (oldValue !== undefined) deleteCookie(name);
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = name + "=" + value + "; expires=" + date.toGMTString() + "; path=/";
}
function getCookie(name) {
    var pair = document.cookie.split('; ').filter(function(pair){return pair.indexOf(name)===0;})[0];
    if (pair === undefined) return undefined;
    return pair.split('=')[1];
}
function deleteCookie(name) {
	document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
}