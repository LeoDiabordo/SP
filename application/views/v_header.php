<!DOCTYPE html>
<!-- 
	Source/s:
		http://www.tutorialspoint.com/php/mysql_paging_php.htm
 -->
<html class="no-js" lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
		<title>UPLB OSA</title>
		<meta name="description" content="UPLB Office of Student Affairs"/>
		<meta name="keywords" content="uplb, osa, uplbosa" />
		<meta name="author" content="OSA-COMMIT:CIA" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/foundation/css/foundation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/foundation/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jqueryui/jquery-ui.css">

        

    </head>
	<body>
        
		<div id="container" class="container" >
			<div class="content">
				<header class="header content-header">
					<div class="header-component">
						<div class="header-image">
							<img src="<?php echo base_url(); ?>assets/img/osam-logo.png" />
						</div>
						<span id="header-minor">University of the Philippines Los Banos</span>
						<span id="header-major">Office of Student Affairs</span>
					</div>
				</header>
				<div class="content-inner">
					<section id="content-drawer" class="header content-drawer">
						<div id="content-login" class="content-login" >
                            
                            <div class="login-component">
								<div class="component component-part1">
									<form method='post' action='<?php echo base_url('/index.php/c_index/login')?>'>
										<input type="text" name="stno" id="login-uname" class="login-uname" placeholder="Student Number" />
										<input type="password" name="pword" id="login-pword" class="login-pword" placeholder="Password"/>
										<input type="submit" name="submit" value="Submit" id="login-submit" class="login-submit" />
									</form>
								</div>
							</div>
                            
<!--
							<div class="login-component">
								<div class="component component-part1">
									<form method='post' action='<?php echo base_url('/index.php/c_index/login')?>'>
										<input type="text" name="stno" id="login-uname" class="login-uname" placeholder="Student Number" />
										<input type="password" name="pword" id="login-pword" class="login-pword" placeholder="Password"/>
										<input type="submit" name="submit" value="Submit" id="login-submit" class="login-submit" />
									</form>
								</div>
								<div class="component component-part2">
									<div class="alt-button"><a href="">Alternate Login</a></div>
									<div class="crt-button"><a href="">Create Account</a></div>
								</div>
							</div>
							<div class="login-icon">
								<svg id="login-svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 300 50">
									<path fill="#111" d="M 0 0 L 0 35 C 100 70 180 5 300 5 L 300 0 Z" />
								</svg>
								<div id="login-button">Login</div>
							</div>
-->
						
                            
							<div class="login-icon">
								<svg width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 300 100">
									<defs>
										<filter id="svg-shadow" x="0" y="0" width="200%" height="200%" >
											<feOffset result="offset" in="SourceAlpha" dx="0" dy="5" />
											<feGaussianBlur result="shadow" in="offset" stdDeviation="10" />
											<feComponentTransfer>
												<feFuncA type="linear" slope="0.5" />
											</feComponentTransfer>
											<feMerge>
												<feMergeNode />
												<feMergeNode in="SourceGraphic"/>
											</feMerge>
										</filter>
									</defs>
									<path fill="#222" d="M 0 0 L 0 29 C 120 30 200 70 300 35 L 300 0 Z" filter="url(#svg-shadow)"/>
									<!-- <path fill="#222" d="M 0 0 L 0 35 C 100 70 180 5 300 5 L 300 0 Z" filter="url(#svg-shadow)"/> -->
									<!-- <path class="" fill="#222" d="M 0 0 L 0 5 L 5 5 C 200 10 350 80 600 70 Q 750 65 850 40 L 850 0 Z" filter="url(#svg-shadow)"/> -->
								</svg>

								<div id="login-button"> <?php if ($this->session->userdata('logged_in')) echo "Hi"; else echo "Log In";?></div>
                            </div>
						</div>
						<div id="content-des" class="content-des">
							<div class="des-filler">

							</div>
							<div class="des">
								<svg id="des-svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 850 100">
									<def>
										<filter id="svg-shadow" x="0" y="0" width="200%" height="200%" >
											<feOffset result="offset" in="SourceAlpha" dx="0" dy="5" />
											<feGaussianBlur result="shadow" in="offset" stdDeviation="10" />
											<feComponentTransfer>
												<feFuncA type="linear" slope="0.5" />
											</feComponentTransfer>
											<feMerge>
												<feMergeNode />
												<feMergeNode in="SourceGraphic"/>
											</feMerge>
										</filter>
									</def>
									<path class="" fill="#222" d="M 850 0 L 850 35 L 845 35 C 650 30 500 80 250 70 Q 100 65 0 40 L 0 0 Z" filter="url(#svg-shadow)"/>									
									<!-- <path class="" fill="#222" d="M 0 0 L 0 5 L 5 5 C 200 10 350 80 600 70 Q 750 65 850 40 L 850 0 Z" filter="url(#svg-shadow)"/>									 -->
									<!-- <path fill="#222" d="M 0 0 L 0 35 C 100 70 180 5 300 5 L 300 0 Z" filter="url(#svg-shadow)"/> -->
								</svg>
							</div>
						</div>
					</section>
					<section id="content-menu" class="content-menu">
						
						<nav id="menu-wrapper" class="menu-component menu-wrapper">
							<button class="menu-trigger">Menu</button>
							<ul class="menu menu-toggle clearfix">
								<li><a href="<?php echo base_url('/index.php/c_index/'); ?>"><div class="menu-item">Home</div></a></li>
								<li><a href="<?php echo base_url('/index.php/c_yearbook'); ?>"><div class="menu-item">UPLB Yearbooks</div></a></li> 

                                

                                <!-- <li><a href=""><div class="menu-item">OSAM Profile</div></a></li>
								<li><a href=""><div class="menu-item">Assistanship</div></a></li>
								<li><a href=""><div class="menu-item">Student Loan Board</div></a></li>
								<li><a href=""><div class="menu-item">One Stop Clearance</div></a></li>
								<li>
									<a href=""><div class="menu-item">Student Orgs</div><div class="icon-next"></div></a>
									<ul class="submenu">
										<li><a href=""><div class="menu-subitem">Recognized Orgs</div></a></li>
										<li><a href=""><div class="menu-subitem">Reminders</div></a></li>
										<li><a href=""><div class="menu-subitem">Recognition Guidelines</div></a></li>
										<li><a href=""><div class="menu-subitem">Application for Recognition</div></a></li>
										<li><a href=""><div class="menu-subitem">Mailing List</div></a></li>
									</ul>
								</li>
								<li><a href=""><div class="menu-item">Scholarship</div></a></li>
								<li><a href=""><div class="menu-item">OSA Staff</div></a></li>
								<li><a href=""><div class="menu-item">Help</div></a></li> -->
							</ul>
						</nav>
					</section>