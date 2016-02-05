window.addEventListener("load", hoveredLargeImg);

// function to initiate two functions when hovered
function hoveredLargeImg() {
	$(".img-thumbnail").hover(insertLgImg, deleteLgImg);
}

// function initiated when hovered 
// create div with class called "bigImg", insert it next to original img
function insertLgImg() {
	var lgImag = $("<img>");
	lgImag.attr("src", lgImagSrc(this.src));
	var div = $("<div class='bigImg'>").append(lgImag);
	$(this).parent().append(div);
}

// function initiated when un-hovered
// delete div with class called "bigImg" 
function deleteLgImg() {
	$(this).parent().find(".bigImg").remove();
}

// take original img source path as parameter, return changed path 
function lgImagSrc(orgSrc) {
	path = 'travel-images/small/';
	str = orgSrc.split('/').pop();
	path += str;
	return path;
}