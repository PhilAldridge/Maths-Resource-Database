<?php 
	$title = 'Teaching Materials';
	include 'header.php';
	foreach($atoms as $atom) {
		if($atom['id']==$_GET['id']){
				//id, name, atomtypeid, subtopicid
				$name = $atom['name'];
				$atomtypeid = $atom['atomtypeid'];
				$subtopicid = $atom['subtopicid'];
		}
	}
	
	//fetch ppt link
		$result = mysqli_query($link, 'SELECT driveid FROM atoms WHERE id='.$_GET['id']);
	if(!$result) {
		print "unable to get atomdrivelink";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$atoms2[] = array('driveid' => $row['driveid']); }
	
	$driveid = "";	
	foreach ($atoms2 as $parse) { $driveid = $parse['driveid']; }
	if(strpos($driveid,'embed') !== false) {
		$downloadlink = str_replace('embed','download',$driveid);
	} else {
		$downloadlink = $driveid;
		$driveid = 'https://view.officeapps.live.com/op/embed.aspx?src='.$driveid;
	}
	
	//fetch atomtype
	$result = mysqli_query($link, 'SELECT id, name FROM types WHERE id='.$atomtypeid);
	if(!$result) {
		print "unable to get type";
	}
		while ($row = mysqli_fetch_array($result)) {
		$types[] = array('id' => $row['id'], 'name' => $row['name']);
	}
	foreach ($types as $type){
		$atomtypename = $type['name'];
	}
	
	//fetch prerequisites
	$result = mysqli_query($link, 'SELECT links.parentid, links.childid, atoms.name FROM links INNER JOIN atoms ON links.childid = atoms.id');
	if(!$result) {
		print "unable to get links";
	}
		while ($row = mysqli_fetch_array($result)) {
		$links[] = array('parentid' => $row['parentid'], 'childid' => $row['childid'], 'name' => $row['name']);
	}
	
	//fetch similartopics 
	$result = mysqli_query($link, 'SELECT s.id1, s.id2, a1.name AS name1, a2.name AS name2 FROM similartopics s INNER JOIN atoms a1 ON s.id1 = a1.id INNER JOIN atoms a2 ON s.id2 = a2.id');
	if(!$result) {
		print "unable to get similartopics";
	}
		while ($row = mysqli_fetch_array($result)) {
		$similartopics[] = array('id1' => $row['id1'], 'id2' => $row['id2'], 'name1' => $row['name1'], 'name2' => $row['name2']);
	}
	
	//nextlevel function looks for prerequisite children and creates a new list if it finds one. Runs recursively.
	function nextLevel($flinks, $pid, $fdone) {
		$fnewlist = 0;
		foreach($flinks as $flink2) {
			if($flink2['parentid']==$pid && !in_array($flink2['childid'],$fdone)){
				if($fnewlist==0) { print '<ul>'; }
				array_push($fdone, $flink2['childid']);
				print '<li><a href="atom.php?id='.$flink2['childid'].'">'.$flink2['name'].'</a>';
				$fdone = nextLevel($flinks, $flink2['childid'], $fdone);
				print '</li>';
				$fnewlist = 1;
			}
		}
		if($fnewlist == 1) { print '</ul>'; }
		return $fdone;
	}
?>

<div class="page-content" padding="50px" margin="50px">
<h1><?php print $name; ?></h1>
<img height="327" width="402" src="images/<?php print $_GET['id']; ?>.JPG" onerror="this.src='images/person.jpg'" alt=""/>
<h3>Type of instruction: <a href="<?php print $atomtypename; ?>.php"><?php print $atomtypename; ?></a></h3>
<h3>Prerequisite skills: <sub><i>(Ensure that students can perform these before teaching this topic. This can be achieved through pre-teaching, reassment and review)</i></sub></h3>
<ul>
<?php
	$done = array();
	foreach($links as $link){
		if($link['parentid']==$_GET['id'] && !in_array($link['childid'], $done)){
			array_push($done, $link['childid']);
			print '<li><a href="atom.php?id='.$link['childid'].'">'.$link['name'].'</a>';
			$done = nextLevel($links, $link['childid'], $done);

			print '</li>';	
		}
	}
?>
</ul>

<h3>Highly similar topics: <sub><i>(These should be clustered together during instruction to highlight similarities)</i></sub></h3>
<ul>
<?php
	foreach($similartopics as $similartopic){
		if($similartopic['id1'] == $_GET['id']){
			print '<li><a href="atom.php?id='.$similartopic['id2'].'">'.$similartopic['name2'].'</a></li>';
		} else if ($similartopic['id2'] == $_GET['id']){
			print '<li><a href="atom.php?id='.$similartopic['id1'].'">'.$similartopic['name1'].'</a></li>';
		}
	}
?>
</ul>

<h3>Presentation:</h3>
<p><iframe src="<?php print $driveid; ?>" width="402" height="327" frameborder="0" scrolling="no"></iframe></p>
<p><a href="<?php print $downloadlink; ?>">Download link</a></p>
</div>   
 </body></html>