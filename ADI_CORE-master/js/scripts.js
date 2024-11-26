var invertedColors = false;
var grayscaled = false;
var yellowed = false;

var $affectedElements = $("p, h1, h2, h3, h4, h5, h6, li, a");
var $affectedElementsGrayscale = $("section, nav, iframe, footer");

$(document).ready(function() {

    $(window).scroll(function() {

        var height = $('.first-container').height();
        var scrollTop = $(window).scrollTop();

        if (scrollTop >= height - 40) {
            $('.nav-container').addClass('solid-nav');
        } else {
            $('.nav-container').removeClass('solid-nav');
        }

    });
});

function loadPreferences(){
	var localInvertedColors = localStorage.getItem('invertedColors');
	var localGrayScale = localStorage.getItem('grayScale');
	var localYellowed = localStorage.getItem('yellowed');

	if(localInvertedColors === 'true') invertColors();
	if(localGrayScale === 'true') grayscaleEverything();
	if(localYellowed === 'true') yellowMe();
}

function invertColors(){

	if(grayscaled) grayscaleEverything();
	if(yellowed) yellowMe();

	const invertValue = (invertedColors ? '0' : '1');

	$(".showcase").css('filter', 'invert(' + invertValue + ')');
	//$("iframe").css('filter', 'invert(' + invertValue + ')');
	$(".configuration").css('filter', 'invert(' + invertValue + ')');
	$(".footer").css('filter', 'invert(' + invertValue + ')');
	$(".call-to-action").css('filter', 'invert(' + invertValue + ')');

	//set up color properties to iterate through
	var colorProperties = ['color', 'background-color'];

	//iterate through every element in reverse order...
	$($("*").get().reverse()).each(function (i) {
		var color = null;

		for (var prop in colorProperties) {
			prop = colorProperties[prop];

			//if we can't find this property or it's null, continue
			if (!$(this).css(prop)) continue; 

			if($(this).is('img')){
				$(this).css('filter', 'invert(' + invertValue +')');
				continue;
			}

			if($(this).parent('.showcase')){
				continue;
			}

			//create RGBColor object
			color = new RGBColor($(this).css(prop));

			if (color.ok) { 
				//good to go, let's build up this RGB baby!
				//subtract each color component from 255
				$(this).css(prop, 'rgb(' + (255 - color.r) + ', ' + (255 - color.g) + ', ' + (255 - color.b) + ')');
			}

			//$(this).css('filter', 'invert(1)');

			color = null; //some cleanup
		}
	});

	invertedColors = !invertedColors;
	localStorage.setItem('invertedColors', invertedColors);
}

function grayscaleEverything(){

	if(invertedColors) invertColors();
	if(yellowed) yellowMe();

	const grayScaleValue = (grayscaled ? '0' : '1');
	$affectedElementsGrayscale.each(function (i) {
		var $this = $(this);
		if($this.hasClass('control-access')) 
		{
			return; 
		}
		$this.css('filter', 'grayscale(' + grayScaleValue + ')');
	});
	grayscaled = !grayscaled;

	localStorage.setItem('grayScale', grayscaled);
}

function yellowMe(){

	if(grayscaled) grayscaleEverything();
	if(invertedColors) invertColors();

	$($("*").get().reverse()).each(function (i) {
		if(yellowed){
			$(this).removeClass('yellowed');
		}else{
			$(this).addClass('yellowed');
		}
	});

	yellowed = !yellowed;
	localStorage.setItem('yellowed', yellowed);
}


function changeFontSize(direction){
	$affectedElements.each(function (i) {
		var $this = $(this);
		if($this.hasClass('control-access')) 
		{
			return; 
		}
		var fontSize = parseInt($this.css("font-size")) + direction;
        $this.css( "font-size" , fontSize);
	});
}

function fontSizeUp(){
	changeFontSize(1);
}

function fontSizeDown(){
	// if(currentStep > minStep){
	// 	currentStep--;

	// 	$($("*").get().reverse()).each(function (i) {
	// 		var sizeinem=parseFloat($(this).css('font-size')) / 16;
    //  		sizeinem = sizeinem / 1.0013;
	// 		$(this).css('font-size', sizeinem + 'em');
	// 	});
	// }

	changeFontSize(-1);
}

