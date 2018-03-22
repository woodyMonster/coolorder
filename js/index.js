$(document).ready(function(){
	// prev(1,"#photo");
	// next(1,"#photo");
	$('#d-prev').bind('click', d_prev);
	$('#d-next').bind('click', d_next);
});


var index = 0;
var arrImg = new Array("images/iphone-x.png","images/applew.jpg","images/atv.jpg","images/imac.jpg",
	"images/macbook.jpg","images/macbook2.jpg","images/applepay.png","images/apple-music.png","images/it.jpg","images/android.jpg");
var arrDn = new Array("iPhone X","Apple Watch","Apple TV","iMac","Macbook",
	"Macbook Pro","Apple Pay","Apple Music","iTunes","A__A");
/*
sec = 秒數;
phid = img id;
*/
function prev(sec,phid){
	setInterval(function(){
		index--;
		if (index < 0) index = 9;
		$(phid).attr("src", arrImg[index]);
	}, sec * 1000);
}
function d_prev(){
	index--;
	if (index < 0) index = 9;
	$("#photo").attr("src", arrImg[index]);
	
}
function d_next(){
	var arrImg = new Array("images/iphone-x.png","images/applew.jpg","images/atv.jpg","images/imac.jpg",
	"images/photo.jpg","images/macbook2.jpg","images/apple2.png","images/apple-music.png","images/it.jpg","images/android.jpg");
	index++;
	if (index > 9) index = 0;
	$("#photo").attr("src", arrImg[index]);
}

function next(sec,phid){
	var arrImg = new Array("images/iphone-x.png","images/applew.jpg","images/atv.jpg","images/imac.jpg",
	"images/photo.jpg","images/macbook2.jpg","images/apple2.png","images/apple-music.png","images/it.jpg","images/android.jpg");
	setInterval(function(){
		index++;
		if (index > 9) index = 0;
		$(phid).attr("src", arrImg[index]);
	}, sec * 1000);
	
}
// panel swipe
// $(document).on("pagecreate", "#home", function() {
// 	$(document).on("swipeleft swiperight", "#home", function(e){
// 		if ($(".ui-page-active").jqmData("panel") !== "open" ) {
// 			if (e.type === "swipeleft") {
// 				$("#right-panel").panel("open");
// 			} else if(e.type === "swiperight") {
// 				$("#left-panel").panel("open");
// 			}
// 		}
// 	});
// });
// swipe change img
$(document).on("pagecreate", "#home", function() {
	$(document).on("swipeleft swiperight", "#home", function(e){
		if (e.type === "swipeleft") {
			d_prev();
		} else if(e.type === "swiperight") {
			d_next();
		}
	});
});
/*
$(document).ready(function(){
	setInterval(function(){
		alert("Hello World!");
	}, 2000);
});
*/