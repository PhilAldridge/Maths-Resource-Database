<?php 
	$title = 'Search results';
	include 'header.php';
	
	//fetch search results
	$result = mysqli_query($link, 'SELECT id, name FROM atoms WHERE name LIKE "%'.$_GET['search'].'%"');
	if(!$result) {
		print "unable to get results";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$searchresults[] = array('id' => $row['id'], 'name' => $row['name'], 'atomtypeid' => $row['atomtypeid'], 'subtopicid' => $row['subtopicid']);
	}
	
	
	?>
	
<div class="container-fluid pt70 pb70">
			<div id="fh5co-projects-feed" class="fh5co-projects-feed clearfix masonry">
				<?php foreach ($searchresults as $atom){
							print '<div class="fh5co-project masonry-brick">
								<a href="atom.php?id='.$atom['id'].'">
								<img src="images/'.$atom['id'].'.JPG" alt="" width="300" onerror="this.src=';
							print "'images/person.jpg';";
							print	'"><h2>'.$atom['name'].'</h2></a></div>';
						}
				?>
				
			</div>
			<!--END .fh5co-projects-feed-->
</div>
<!-- END .container-fluid -->
        
</body></html>