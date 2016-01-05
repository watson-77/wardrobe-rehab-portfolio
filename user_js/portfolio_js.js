function zebra() {
	var count = document.getElementsByClassName("fotocaption").length;
	elems = document.getElementsByClassName("fotocaption");
	for (var i = 0; i < count; i++) {
		if ((i%2) == 0) {
			elems[i].style.background = '#019A98';
		}
		else {
			elems[i].style.background = '#007C7A';
		}
	}
}
window.onload = function () {
	zebra();
}