<?php 
	require_once "db.inc.php" ;	
		//insert atom
	$sql = 'INSERT INTO atoms (id, name, atomtypeid, subtopicid, driveid)
		VALUES ("'.$_POST["id"].'", "'.$_POST["name"].'", "'.$_POST["type"].'", "'.$_POST["subtopic"].'", "'.$_POST["slideid"].'")';
	if(!mysqli_query($link, $sql)){
		print mysqli_error($link);
		print 'could not insert atom';
	}
	
	//insert prerequisites
	if(!empty($_POST['links'])){
		foreach($_POST['links'] as $selected):
			$sql = 'INSERT INTO links (parentid, childid)
				VALUES ("'.$_POST["id"].'", "'.$selected.'")'; 
			if(!mysqli_query($link, $sql)){
				print mysqli_error($link);
				print 'could not insert link';
			}
		endforeach;
		

	}
	
	
	//insert similar topics
	if(!empty($_POST['similartopics'])){
		foreach($_POST['similartopics'] as $selected):
			$sql = 'INSERT INTO similartopics (id1, id2)
				VALUES ("'.$_POST["id"].'", "'.$selected.'")'; 
			if(!mysqli_query($link, $sql)){
				print mysqli_error($link);
				print 'could not insert similar topic';
		}
		endforeach;
		
	}
		
?>
<a href="newatomform.php">Again</a>