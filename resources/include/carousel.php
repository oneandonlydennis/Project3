<head>
	<style>
	.carousel-inner > .carousel-item > img {
		width:80%;
		height:250px;
	}
</style>
</head>

<div id="RotatingHome" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#RotatingHome" data-slide-to="0" class="active"></li>
		<li data-target="#RotatingHome" data-slide-to="1"></li>
		<li data-target="#RotatingHome" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<img src="./resources/images/carousel1.png" alt="First slide">
		</div>
		<div class="carousel-item">
			<img src="./resources/images/carousel1.png" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img src="./resources/images/carousel1.png" alt="Third slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#RotatingHome" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#RotatingHome" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>