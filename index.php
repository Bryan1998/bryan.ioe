<!DOCTYPE html>
<?php
session_start();

include 'inc/functions.php';

if (!isset($_SESSION['username'])) {
	$user = 'guest';
	$isMember = 0;
} else {
	$user = $_SESSION['username'];
	$isMember = 1;
}

$sql = "SELECT `user_role` FROM `users` WHERE user_name = '$user';";
$result = $mysqli->query($sql);
if (!isset($role)) {
	$role = 'null';
} else {
	while ($obj = $result->fetch_object()) {
		$role = $obj->user_role;
	}
}
if ($role == 'root') {
	$symbol = '#';
} else {
	$symbol = '$';
}

?>
<html>
	<head>
		<title>Bryan.ioe</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<style type="text/css">
		.affix {
			width: auto;
		}
		body {
			padding-top: 70px;
			padding-bottom: 50px;
		}
		textarea.chat {
			resize: vertical;
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		@media screen and (max-width: 768px) {
		    body {
				padding-top: 0px;
				padding-bottom: 0px;
			}
		}
		.form-control {
			width:190px;
		}
		.popover {
			max-width:280px;
		}
		.carousel-indicators li {
			box-shadow: 0px 0px 4px #666;
		}
		</style>
		<script type="text/javascript">
		function auto_grow(element) {
			element.style.height = "5px";
			element.style.height = (element.scrollHeight)+"px";
		}
		function update() {
			$.post("chat.server.php", {},
				function (data){
					var randomstuff = data.split("\u200C");
					if (randomstuff[0] == '1') {
						$("#chat_pop")[0].play();
					}
					$("#screen").val(randomstuff[1]);
				}
			);
			setTimeout('update()', 1000);
		}
		$(document).ready(function() {
			update();
			$("#button").click(
				function () {
					$.post("chat.server.php", {
						message: $("#message").val()
					},
					function (data) {
						var randomstuff = data.split("\u200C");
						if (randomstuff[0] == '1') {
							$("#chat_pop")[0].play();
						}
						$("#screen").val(randomstuff[1]);
						$("#message").val("");
					});
					return false;
				}
			);
			$("[data-toggle=popover]").popover({
				html: true,
				content: function() {
					return $('#popover-content').html();
				}
			});
			$('a.smooth-scroll[href*="#"]:not([href="#"])').click(function () {
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
			$('[data-clampedwidth]').each(function () {
				var elem = $(this);
				var parentPanel = elem.data('clampedwidth');
				var resizeFn = function () {
					var sideBarNavWidth = $(parentPanel).width() - parseInt(elem.css('paddingLeft')) - parseInt(elem.css('paddingRight')) - parseInt(elem.css('marginLeft')) - parseInt(elem.css('marginRight')) - parseInt(elem.css('borderLeftWidth')) - parseInt(elem.css('borderRightWidth'));
					elem.css('width', sideBarNavWidth);
				};

				resizeFn();
				$(window).resize(resizeFn);
			});
		});
		</script>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="50">
		<audio id="chat_pop">
			<source src="audio/pop.mp3"></source>
			<source src="audio/pop.ogg"></source>
		</audio>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><?php echo $user.'@bryan.ioe'.$symbol; ?></a>
				</div>
				<div class="collapse navbar-collapse" id="nav1">
					<ul class="nav navbar-nav">
						<li><a href="#home" class="smooth-scroll">Home</a></li>
						<li><a href="#about" class="smooth-scroll">About</a></li>
						<li><a href="#projects" class="smooth-scroll">Projects</a></li>
						<li><a href="#contact" class="smooth-scroll">Contact</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
<?php if ($isMember == 0): ?>
							<a data-placement="bottom" data-toggle="popover" id="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
<?php else: ?>
							<a href="logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
<?php endif; ?>
						</li>
						<div id="popover-content" class="hide">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#login_tab">Login</a></li>
								<li><a data-toggle="tab" href="#register_tab">Register</a></li>
							</ul>
							<div class="tab-content">
								<div id="login_tab" class="tab-pane fade in active">
									<form class="form-inline" role="form" method="post" action="login.php">
										<div class="form-group">
											<input placeholder="Username" name="username" class="form-control" type="text" required><br>
											<input placeholder="Password" name="password" class="form-control" minlength="6" type="password" required><br>
											<button type="submit" class="btn btn-primary" name="btn-login">Login</button>
										</div>
									</form>
								</div>
								<div id="register_tab" class="tab-pane fade">
									<form class="form-inline" role="form" method="post" action="register.php">
										<div class="form-group">
											<input placeholder="Username" name="username" class="form-control" type="text" required><br>
											<input placeholder="Email" name="email" class="form-control" type="email" required><br>
											<input placeholder="Password" name="password" class="form-control" minlength="6" type="password" required><br>
											<input placeholder="Confirm Password" name="password_confirm" class="form-control" minlength="6" type="password" required><br>
											<button type="submit" class="btn btn-primary" name="btn-register">Register</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid text-center">
			<div class="row content">
				<div id="links" class="col-sm-2">
					<div class="affix" data-clampedwidth="#links">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="panel-heading">
									<h3 class="panel-title">Links:</h3>
								</div>
							</div>
							<div class="panel-body">
								<a class="list-group-item" href="https://bryan1998.github.io/">GitHub</a>
								<hr/>
								<a class="list-group-item" href="/html">HTML</a>
								<a class="list-group-item" href="/phpform">PHPForm</a>
								<a class="list-group-item" href="/python">Python</a>
								<hr/>
								<a class="list-group-item" href="/logs">Logs</a>
								<a class="list-group-item" href="/downloads">Downloads</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-7 text-left">
					<div id="home">
						<div id="carousel1" class="carousel slide" data-ride="carousel">
<?php
$path = 'img/';
$images = glob($path.'*.{jpg,jpeg}', GLOB_BRACE);
?>
							<ol class="carousel-indicators">
<?php foreach ($images as $key=>$image): ?>
<?php if ($key == 0): ?>
								<li data-target="#carousel1" data-slide-to="<?php echo $key; ?>" class="active"></li>
<?php else: ?>
								<li data-target="#carousel1" data-slide-to="<?php echo $key; ?>"></li>
<?php endif; endforeach; ?>
							</ol>
							<div class="carousel-inner">
<?php foreach ($images as $key=>$image): ?>
<?php if ($key == 0): ?>
								<div class="item active">
<?php else: ?>
								<div class="item">
<?php endif; ?>
									<img src="<?php echo $image; ?>"/>
								</div>
<?php endforeach; ?>
							</div>
							<a class="left carousel-control" href="#carousel1" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel1" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<div id="about">
						<hr/><hr/>
						<div class="row">
							<h1>About</h1>
						</div>
						<p>Hi, my name is Bryan Hernandez,</p>
						<p>I'm <?php echo get_age('1998', '6', '23'); ?> years old, and I live in Kennewick, Washington with my step mom and dad.</p>
						<p>My plan is to go to Columbia Basin College (CBC) and study cyber security.</p>
						<br/>
						<p>My interests are:</p>
						<ul>
							<li>Computers (obviously)</li>
							<li>Cars</li>
							<li>Rock music</li>
							<li>Guitars</li>
						</ul>
						<p>I'm good at:</p>
							<ul>
								<li>Computers (obviously)
									<ul>
										<li>Linux</li>
										<li>Hardware</li>
										<li>Coding</li>
									</ul>
								</li>
								<li>Good sense of humor</li>
								<li>(Selective) Quick Study</li>
								<li>Professional procrastinator</li>
							</ul>
						<img class="img-responsive img-circle" src="img/profile/profile.jpg"/>
					</div>
					<div id="projects">
						<hr/><hr/>
						<div class="row">
							<h1>Projects</h1>
						</div>
						<p>One of my projects is my HTPC server.</p>
						<p>Specs are:</p>
						<ul>
							<li>Motherboard: Intel 5500HCV Dual 1366 Socket</li>
							<li>CPU(s): 2X Intel Xeon x5680 3.33GHz Six-Core Processor</li>
							<li>Video Card: MSI GTX 570</li>
							<li>RAM: 36GB DDR3-1333</li>
							<li>Case: Silverstone GD07</li>
							<li>Optical Drive: LG Blu-Ray Drive</li>
							<li>Sound Card: Creative Soundblaster X-Fi Titanium</li>
							<li>HDD: 1TB Seagate</li>
						</ul>
						<p>Pictures:</p>
						<img class="img-responsive img-rounded" src="/img/projects/server1.jpg"/>
						<hr/>
						<img class="img-responsive img-rounded" src="/img/projects/server2.jpg"/>
						<hr/>
						<img class="img-responsive img-rounded" src="/img/projects/server3.jpg"/>
					</div>
					<div id="contact">
						<hr/><hr/>
						<div class="row">
							<h1>Contact</h1>
						</div>
						<h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
				        <h1>Some text to enable scrolling</h1>
					</div>
				</div>
				​<div id="ads" class="col-sm-3 sidenav">
					<div class="affix" data-clampedwidth="#ads">
						<div class="well">
							<form class="form-group">
								<textarea class="form-control chat" rows="15" id="screen"></textarea>
							</form>
						</div>
						<div class="well">
							<form class="form-group">
								<input id="message" <?php if ($isMember == 0) { echo ' value="Log in to use chat" disabled '; } ?> class="form-control" style="width: 100%;">
								<button id="button" <?php if ($isMember == 0) { echo ' disabled '; } ?> class="btn btn-primary">Send</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="navbar navbar-inverse navbar-fixed-bottom">
	    	<div class="container text-center">
				<p class="navbar-text">&copy; Bryan Hernandez 2017-<?php echo date('Y');?></p>
				<?php if ($user == 'root'): ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="https://bryan.ioe/KeepOut623"><i class="fa fa-cog" aria-hidden="true"></i> PHPMyAdmin</a></li>
				</ul>
			<?php endif; ?>
			</div>
		</footer>
	</body>
</html>
