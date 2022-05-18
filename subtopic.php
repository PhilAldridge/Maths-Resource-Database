<?php
	$title = 'Choose the component you wish to teach';
	include 'header.php'; 
?>

<div class="container-fluid pt70 pb70">
			<div id="fh5co-projects-feed" class="fh5co-projects-feed clearfix masonry">
				<?php foreach ($atoms as $atom){
						if($atom['subtopicid']==$_GET['id']) {
							print '<div class="fh5co-project masonry-brick">
								<a href="atom.php?id='.$atom['id'].'">
								<img src="images/'.$atom['id'].'.JPG" alt="" width="300" onerror="this.src=';
							print "'images/person.jpg';";
							print	'"><h2>'.$atom['name'].'</h2></a></div>';
						}
					}
				?>
				
			</div>
			<!--END .fh5co-projects-feed-->
</div>
<!-- END .container-fluid -->
        
</body></html>