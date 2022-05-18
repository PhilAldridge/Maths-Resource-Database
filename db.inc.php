<?php


$link = mysqli_connect('REDACTED', 'REDACTED', 'REDACTED', 'REDACTED');
if (!$link)
{
	print "unable to connect";
	exit();
}

if (!mysqli_set_charset($link, 'utf8'))
{
	print "unable to set database connection encoding";
	
	exit();
}


	//fetch topics
	$result = mysqli_query($link, 'SELECT id, name FROM topics');
	if(!$result) { 
		print "unable to get topics";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$topics[] = array('id' => $row['id'], 'name' => $row['name']);
	}
	
	/*foreach ($topics as $topic):
		print $topic['name'];
	endforeach;*/
	
//fetch subtopics
	$result = mysqli_query($link, 'SELECT id, name, topicid FROM subtopics ORDER BY name');
	if(!$result) {
		print "unable to get subtopics";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$subtopics[] = array('id' => $row['id'], 'name' => $row['name'], 'topicid' => $row['topicid']);
	}
	
//fetch atoms
	$result = mysqli_query($link, 'SELECT id, name, atomtypeid, subtopicid FROM atoms ORDER BY name');
	if(!$result) {
		print "unable to get atoms";
	}
	
	while ($row = mysqli_fetch_array($result)) {
		$atoms[] = array('id' => $row['id'], 'name' => $row['name'], 'atomtypeid' => $row['atomtypeid'], 'subtopicid' => $row['subtopicid']);
	}
	

	
?>
