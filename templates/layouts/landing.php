<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>LiveWatch - Notify when your favorite streamer is live!</title>
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Libs CSS -->
	<link href="/assets/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/css/simple-line-icons.css" rel="stylesheet">
	<link href="/assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/css/prettyPhoto.css" rel="stylesheet" type="text/css" media="all" />

	<!-- Template CSS -->
	<link href="/assets/css/style.css" rel="stylesheet">

	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,800&amp;subsetting=all' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,800,700,300' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="./js/html5shiv.js"></script>
		<script src="./js/respond.js"></script>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->

</head>

<body data-spy="scroll" data-target=".navigation">

	<!-- Banner -->
    <div id="banner" class="bg-blur">
		<!-- Start Header -->
		<div id="header">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Start Logo / Text -->
						<a class="navbar-brand text-logo" href="#">
							<i class="icon-fire blue"></i>LiveWatch
						</a>
						<!-- End Logo / Text -->
					</div>
					<!-- Start Navigation -->
					<div class="navigation navbar-collapse collapse">
						<ul class="nav navbar-nav menu-right">
							<li class="active"><a href="/">Home</a></li>
							{% if user is defined %}
					            <li>{{ user.username }} | <a href="/user/logout">Logout</a></li>
					        {% endif %}
							<li><a href="/watches">Watches</a></li>
							<li><a href="/integrations">Integrations</a></li>
							<li><a href="/faq">FAQ</a></li>
						</ul>
					</div>
					<!-- End Navigation  -->
				</div>
			</nav>
		</div>
		<!-- End Header -->
		<div class="banner-content">
			<div class="container">
				<div class="row">
					<!-- Start Header Text -->
					<div class="col-md-7 col-sm-7">
						<h1>Know when your favorite streams <strong>go live!</strong></h1>
						<p>
							Email notifications are great but sometimes you just need more. LiveWatch allows you to set up
							<strong>custom notifications</strong> to let you know when streams are live and what they're playing.
							<strong>Streamers</strong> can also use LiveWatch to post automatically to their social media without
							having to set up yet another application.
						</p>
						<p>Our real-time notification options include:</p>
						<ul class="banner-list">
							<li><i class="fa fa-check"></i>Custom Emails</li>
							<li><i class="fa fa-check"></i>Posting to Twitter</li>
							<li><i class="fa fa-check"></i>Posting to Facebook</li>
							<li><i class="fa fa-check"></i>Text/SMS Message</li>
							<li><i class="fa fa-check"></i>Discord (Coming Soon)</li>
						</ul>
					</div>
					<!-- End Header Text -->
					<!-- Start Banner Optin Form-->
					<div class="col-lg-4 col-md-4 col-md-offset-1 col-sm-5">
						<div class="banner-form">
							<div class="form-title">
								<h2>Connect with Twitch</h2>
							</div>
							<div class="form-body">
								<p>
									Linking to your Twitch account allows LiveWatch to keep an eye on your favorite
									streamers and send you updates when they go live!
								</p>
								<a href="{{ url }}" class="btn btn-default btn-submit">
									<img src="/assets/img/Glitch_White_RGB.png" height="20"/>&nbsp;&nbsp;Link now!</a>
									<br/>
								<p style="font-size:10px">
									We ask for your email, but don't worry - we'll only us it to send notifications
									and will never share it.
								</p>
							</div>
						</div>
					</div>
					<!-- End Banner Optin Form -->
				</div>
			</div>
		</div>
    </div>
	<!-- End Banner -->

	<!-- Clients Logo -->
	<!-- <div id="clients" class="padding40 bg-grey hidden-xs">
		<div class="container">
			<ul class="list-inline clients-logo text-center">
				<li><img src="/assets/img/logo1.png" alt="" title="" /></li>
				<li><img src="/assets/img/logo2.png" alt="" title="" /></li>
				<li><img src="/assets/img/logo3.png" alt="" title="" /></li>
				<li><img src="/assets/img/logo1.png" alt="" title="" /></li>
				<li><img src="/assets/img/logo2.png" alt="" title="" /></li>
			</ul>
		</div>
	</div> -->
	<!-- End Clients Logo -->

	<!-- Intro -->
	<section id="intro" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 headline">
					<h2>Set up notifications <span class="blue">instantly!</span></h2>
					<p>
						Linking your social media accounts is simple and our easy-to-use interface allows for quick notfication setup.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<img src="/assets/img/notify.png" class="img-responsive" alt="" title="">
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="features"><!-- Main Points -->
						<i class="line-font blue fa fa-chevron-circle-right" aria-hidden="true"></i><!-- Main Point Icon -->
						<h3>Real-time Notifications</h3><!-- Main Title -->
						<p>
							Get notified in real-time when your favorite streats are live based on your notification preferences.
						</p><!-- Main Text -->
					</div><!-- End Main Points -->
					<div class="features">
						<i class="line-font blue fa fa-podcast"></i>
						<h3>Great for Streamers</h3>
						<p>
							Want to automatically post to your own social media accounts when you go live? Set up notifications now!
						</p>
					</div>
					<div class="features">
						<i class="line-font blue fa fa-bullhorn"></i>
						<h3>Multiple Notification Methods</h3>
						<p>
							LiveWatch allows for multiple social media accounts to be used for notifications as well as other alternate methods.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Intro -->

	<!-- Call To Action -->
	<section id="subscribe" class="section bg-blue-pattern">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center white-text">
					<div class="headline">
						<h2><strong>Want to learn more?</strong></h2>
						<p class="subline">Link to your Twitch account to get started now!</p>
					</div>
					<a href="{{ url }}" class="btn btn-transparent btn-big">Link to Twitch</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End Call To Action -->

	<!-- Footer Top -->
	<section class="footer footer-top">
		<div class="container">
			<div class="row">
				<!-- Footer Intro  -->
				<div class="col-md-4">
					<h3>LiveWatch</h3>
					<p>The LiveWatch service allows you to quickly and easily set up notifications when Twitch streams go live.</p>
					<p>We keep things simple and make it a "set it and forget it" process.</p>
				</div>
				<!-- End Footer Intro  -->
				<!-- Contact Details  -->
				<div class="col-md-3">
					<div class="contact-info">
						<h3>Reach Us</h3>
						<ul class="contact-list">
							<li><i class="fa fa-twitter"></i><a href="https://twitter.com/livewatchio">LiveWatch on Twitter</a></li>
							<li><i class="fa fa-envelope"></i><a href="mailto:info@websec.io">inf@websec.io</a></li>
						</ul>
					</div>
				</div>
				<!-- End Contact Details  -->
				<!-- Quick Links -->
				<div class="col-md-2">
					<h3>Quick Links</h3>
					<ul class="quick-links">
						<li><a href="/">Home</a></li>
						<li><a href="/index/watches">Watches</a></li>
						<li><a href="/index/toc">Terms &amp; Conditions</a></li>
						<li><a href="/index/privacy">Privacy Policy</a></li>
					</ul>
				</div>
				<!-- End Quick links -->
				<!-- Social Links -->
				<div class="col-sm-3">
					<h3>Stay in Touch!</h3>
					<p>Follow us on our social networks!</p>
					<ul class="social">
						<li class="twitter"> <a href="https://twitter.com/livewatchio"> <i class="fa fa-twitter"></i> </a> </li>
					</ul>
				</div>
				<!--End Social Links  -->
			</div>
		</div>
	</section>
	<!-- End Footer Top -->

	<!-- Footer Bottom -->
	<footer class="footer footer-sub">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<p>&copy; 2017 - LiveWatch is a presentation of Websec.io</p>
				</div>
				<div class="col-lg-6 col-sm-6">
					<p>&nbsp;</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer Bottom -->

	<!-- Start Js Files -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script><!--jQuery is a Javascript library that greatly reduces the amount of code that you must write.-->
	<script type="text/javascript">window.jQuery || document.write('<script src="/assets/js/jquery-2.1.0.min.js"><\/script>')</script>
	<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script><!--Packed with many functionalies such as carousel slider, responsivity, tabs, drop downs, buttons, and many other features-->
	<script src="/assets/js/modernizr.min.js" type="text/javascript"></script><!--Modernizr is an open-source JavaScript library that helps you build the next generation of HTML5 and CSS3-powered websites.-->
	<script src="/assets/js/jquery.prettyPhoto.js" type="text/javascript" ></script><!-- Script for Lightbox Image  -->
	<script src="/assets/js/custom.js" type="text/javascript"></script><!-- Script File containing all customizations  -->
	<!-- End Js Files  -->

</body>
</html>
