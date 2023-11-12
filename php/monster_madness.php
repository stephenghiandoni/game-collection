
<html>
<head>
<meta charset="UTF-8">
<title>SteveTube</title>
<link rel="stylesheet" href="../css/monster_madness.css?version=1" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/video.js/dist/video-js.min.css" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.css" type="text/css"></link>
<?php
$kvs_s1 = '../videos/KvS/S1/';
$kvs_s2 = '../videos/KvS/S2/';
$kvs_s3 = '../videos/KvS/S3/';
$kvs_s4 = '../videos/KvS/S4/';
$kvs_s5 = '../videos/KvS/S5/';
$kvs_s6 = '../videos/KvS/S6/';
$kvs_extra = '../videos/KvS/KvS_Other/';
$mm2007_dir = '../videos/MonsterMadnessArchive/2007 - History of Horror/';
$mm2008_dir = '../videos/MonsterMadnessArchive/2008 - GodzillaThon/';
$mm2009_dir = '../videos/MonsterMadnessArchive/2009 - Monster Madness 3/';
$mm2010_dir = '../videos/MonsterMadnessArchive/2010 - Camp Cult/';
$mm2011_dir = '../videos/MonsterMadnessArchive/2011 - Sequel-A-Thon/';
$mm2012_dir = '../videos/MonsterMadnessArchive/2012 - 80s-A-Thon/';
$mm2013_dir = '../videos/MonsterMadnessArchive/2013 - Sequel-A-Thon-2/';
$mm2014_dir = '../videos/MonsterMadnessArchive/2014 - Monster Madness 8/';
$mm2015_dir = '../videos/MonsterMadnessArchive/2015 - Monster Madness 9/';
$mm_other_dir = '../videos/MonsterMadnessArchive/Other/';
$treehouse_dir = '../videos/TreehouseOfHorror/';
$treehouse_original_dir = '../videos/Treehouse of Horror Original Aspect Ratio/';
$other_dir = '../videos/OtherHalloweenStuff/';
$current_list = "";
$video_links = array();

//button for selecting which directory of videos to load from
if(isset($_POST['video_filter'])){
	$current_list = $_POST['vid_select_drop'];
	$video_links = populate_links($current_list);
	$json_video_links = json_encode($video_links);
	unset($_POST['video_filter']);
}
?>
</head>
<body>

<!-- Add a new button and a dir path above for each new folder of shows, videos will populate automatically from their corresponding directory in /var/www/html/videos -->
<div id="player-container">
<form method="post">
<label for="vid_select_lbl">Videos: </label>
<select name="vid_select_drop" id="vname">
<option value='<?php echo $kvs_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s1") echo 'selected';?>>Kenny vs Spenny - Season 1</option>
<option value='<?php echo $kvs_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s2") echo 'selected';?>>Kenny vs Spenny - Season 2</option>
<option value='<?php echo $kvs_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s3") echo 'selected';?>>Kenny vs Spenny - Season 3</option>
<option value='<?php echo $kvs_s4; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s4") echo 'selected';?>>Kenny vs Spenny - Season 4</option>
<option value='<?php echo $kvs_s5; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s5") echo 'selected';?>>Kenny vs Spenny - Season 5</option>
<option value='<?php echo $kvs_s6; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s6") echo 'selected';?>>Kenny vs Spenny - Season 6</option>
<option value='<?php echo $kvs_extra; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_extra") echo 'selected';?>>Kenny vs Spenny - Extras</option>
<option value='<?php echo $mm2007_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2007_dir") echo 'selected';?>>2007 History of Horror</option>
<option value='<?php echo $mm2008_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2008_dir") echo 'selected';?>>2008 GodzillaThon</option>
<option value='<?php echo $mm2009_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2009_dir") echo 'selected';?>>2009 Monster Madness 3</option>
<option value='<?php echo $mm2010_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2010_dir") echo 'selected';?>>2010 Camp Cult</option>
<option value='<?php echo $mm2011_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2011_dir") echo 'selected';?>>2011 Sequel-A-Thon</option>
<option value='<?php echo $mm2012_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2012_dir") echo 'selected';?>>2012 80's-A-Thon</option>
<option value='<?php echo $mm2013_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2013_dir") echo 'selected';?>>2013 Sequel-A-Thon 2</option>
<option value='<?php echo $mm2014_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2014_dir") echo 'selected';?>>2014 Monster Madness 8</option>
<option value='<?php echo $mm2015_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm2015_dir") echo 'selected';?>>2015 Monster Madness 9</option>
<option value='<?php echo $mm_other_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$mm_other_dir") echo 'selected';?>>Other Monster Madness</option>
<option value='<?php echo $treehouse_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$treehouse_dir") echo 'selected';?>>Treehouse of Horror</option>
<option value='<?php echo $treehouse_original_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$treehouse_original_dir") echo 'selected';?>>Treehouse of Horror (4:3)</option>
<option value='<?php echo $other_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$other_dir") echo 'selected';?>>Misc Shows</option>
</select>
<input type="submit" name="video_filter" class="button" value="Display" />
</form>
<!--div id="title_div" class="vjs-playlist-now-playing"-->
<div class="vjs-playlist-now-playing">
<!--h3 id="directory_title"></h3-->
</div>
<video id="video" class="video-js" controls preload="auto" width="640" height="360" data-setup='{}'></video>
<div class="vjs-playlist"></div>
</div>

<script type="text/javascript" src="../node_modules/video.js/dist/video.min.js"></script>
<script type="text/javascript" src="../node_modules/videojs-playlist/dist/videojs-playlist.min.js" defer></script>
<script type="text/javascript" src="../node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.min.js" defer></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function(){
	var player = videojs('video');
	var passed_playlist = document.getElementById('playlist_div');
	var json_video_links = JSON.parse('<?php echo $json_video_links; ?>');
	var titles = [];
	const videos = [];
	player.playlist(videos); //clear playlist
//	document.getElementById('directory_title').innerText = '<?php echo $current_list; ?>';
	
	//generate clean titles for each item in the directory
	for(let i = 0; i < json_video_links.length; i++){
		var temp = json_video_links[i];
		const breakpoint = temp.lastIndexOf('/');
		const clean_title = temp.substring(breakpoint+1).replace('.mp4', '');
		titles[i] = clean_title;	
	}

	//generate playlist from list of items in directory
	for(let i = 0; i < json_video_links.length; i++){
		videos.push({	
		name: titles[i],
        sources: [{ src: json_video_links[i], type: 'video/mp4' }]
	    });
	}
	
	player.playlist(videos);
	player.playlist.autoadvance(0);
	player.playlistUi();
});

</script>
<?php
function populate_links($video_dir){
	$video_list = "";
	$fullpath = [];
	//gather paths for each video in chosen directory
	if(is_dir($video_dir)){
		$video_list = scandir($video_dir);//get contents of directory
		foreach($video_list as $vid){
			if($vid != '.' && $vid != '..'){
				$video_fullpath = "$video_dir" . "$vid";
				$video_fullpath = str_replace('\'', '', $video_fullpath);
				$fullpath[] = $video_fullpath;
			}
		}
    }else{
		$video_list = "-1";
	}
	return $fullpath;
}
?>
</body>
</html>
