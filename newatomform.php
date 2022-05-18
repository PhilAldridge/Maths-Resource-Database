<?php 
	require_once "db.inc.php" ;	
	$idnum = 0;
	foreach ($atoms as $atom):
		print $atom['id'];
		if($atom['id']>$idnum){
			
			$idnum = $atom['id'];
		}
	endforeach;
	$idnum++;
	print $idnum;
	
	//fetch types
	$result = mysqli_query($link, 'SELECT id, name FROM types');
	if(!$result) {
		print "unable to get types";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$types[] = array('id' => $row['id'], 'name' => $row['name']);
	}
	
	
?>

<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class=" js no-touch" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Create new page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your page description here">
    <meta name="author" content="">
    <!-- css -->
    <link href="css/menu.css" rel="stylesheet">
</head>
<body>
<h1>Use this form to create a new page</h1>
 <form action="submitform.php" method="post" enctype="multipart/form-data">
	<div>Atom name:<input name="name" type="text" size="30" maxlength="255" /></div>
    <input type="hidden" name="id" value="<?php print $idnum; ?>" />
    <div>Suptopic:<select name="subtopic" size="20">
    	<?php
			foreach ($topics as $topic):
				print '<optgroup label="'.$topic['name'].'" >';
					foreach ($subtopics as $subtopic):
						if($topic['id']==$subtopic['topicid']){
							print '<option value="'.$subtopic['id'].'">'.$subtopic['name'].'</option>';
						}
					endforeach;
				print '</optgroup>';
			endforeach;
		?>	
    </select></div>
    <div>Instruction type<select name="type" size="8">
    	<?php
			foreach ($types as $type):
				print '<option value="'.$type['id'].'">'.$type['name'].'</option>';
			endforeach;
		?>	
    </select></div>
    <div>Pre-requisite skills<select name="links[]" size="20" multiple>
    	<?php
			$options = "";
			foreach ($subtopics as $subtopic):
				$options .= '<optgroup label="'.$subtopic['name'].'">';
				foreach ($atoms as $atom):
					if($atom['subtopicid']==$subtopic['id']) {
						$options .= '<option value="'.$atom['id'].'">'.$atom['name'].'</option>';
					}
				endforeach;						
				$options.= '</optgroup>';
			endforeach;
			print $options;
			?>	
    </select></div>
    <div>Highly similar topics<select name="similartopics[]" size="20" multiple>
    	<?php print $options;	?>	
    </select></div>
    <div>Slide ID:<input name="slideid" type="text" size="30" /></div>
    <div><input type="submit"/></div>
</form>
</body>
</html>