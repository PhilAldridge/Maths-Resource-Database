<?php 
	require_once "db.inc.php" ;	
?>

<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class=" js no-touch" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php print $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your page description here">
    <meta name="author" content="">
    <!-- css -->
    <link href="css/menu.css" rel="stylesheet">
    
    	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts
	<link rel="stylesheet" href="css/icomoon.css">-->
	<!-- Bootstrap 
	<link rel="stylesheet" href="css/bootstrap.css">-->
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div style="background:#999; font-size:22px; text-align:center; line-height:80px; color:#FFF; font-weight:bold;">DI GCSE
    </div>
	<!-- start header -->
	<header>	
		<div class="container">
				<div class="navbar navbar-static-top">
					<div class="navigation">
						<nav>
						<ul class="nav topnav bold">
							<li class="active">
							<a href="index.php">Home</a>
							</li>
                            <?php 
								foreach ($topics as $topic):
									print '<li class="dropdown">
											<a href="#">'.$topic['name'].'<i class="icon-angle-down"></i></a>
											<ul style="display: none;" class="dropdown-menu bold">';
									foreach ($subtopics as $subtopic):
										if ($subtopic['topicid']==$topic['id']) {
											print '<li class="dropdown"><a href="subtopic.php?id='.$subtopic['id'].'">'.$subtopic['name'].'<i class="icon-angle-right"></i></a>
											<ul style="display: none" class="dropdown-menu sub-menu-level1 bold">';
											
											//TODO add atoms here
											foreach ($atoms as $atom):
												if($atom['subtopicid']==$subtopic['id']){
													print '<li><a href="atom.php?id='.$atom['id'].'">'.$atom['name'].'</a></li>';
												}
											endforeach;
											
											print '</ul></li>';
										}
									endforeach;
									print '</ul></li>';
								endforeach;
							?>
							
							<li>
							<form action="search.php" method="get"><input type="text" size="10" class="" name="search"/><button type="submit"><i class="icon-search"></i></button></form>
							</li>
						</ul>
						</nav>
					</div>
				</div>
			</div>
			</div>
		</div>
	</header>	
	<!-- end header -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.masonry.min.js"></script>
	<script src="js/main.js"></script>

