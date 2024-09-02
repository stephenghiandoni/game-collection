
<html>
<head>
<meta charset="UTF-8">
<title>SteveTube</title>
<link rel="stylesheet" href="../css/monster_madness.css?version=1" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/video.js/dist/video-js.min.css" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.css" type="text/css"></link>
<?php
include('def.php');

$kvs_s1 = '../videos/KvS/S1/';
$kvs_s2 = '../videos/KvS/S2/';
$kvs_s3 = '../videos/KvS/S3/';
$kvs_s4 = '../videos/KvS/S4/';
$kvs_s5 = '../videos/KvS/S5/';
$kvs_s6 = '../videos/KvS/S6/';
$kvs_extra = '../videos/KvS/KvS_Other/';
$hey_arnold_s1 = '../videos/External/System Volume Information/videos/HeyArnold/S1/';
$hey_arnold_s2 = '../videos/External/System Volume Information/videos/HeyArnold/S2/';
$hey_arnold_s3 = '../videos/External/System Volume Information/videos/HeyArnold/S3/';
$hey_arnold_s4 = '../videos/External/System Volume Information/videos/HeyArnold/S4/';
$simpsons_s1 = '../videos/External/System Volume Information/videos/TheSimpsons/Season1/';
$simpsons_s2 = '../videos/External/System Volume Information/videos/TheSimpsons/Season2/';
$simpsons_s3 = '../videos/External/System Volume Information/videos/TheSimpsons/Season3/';
$simpsons_s4 = '../videos/External/System Volume Information/videos/TheSimpsons/Season4/';
$simpsons_s5 = '../videos/External/System Volume Information/videos/TheSimpsons/Season5/';
$simpsons_s6 = '../videos/External/System Volume Information/videos/TheSimpsons/Season6/';
$simpsons_s7 = '../videos/External/System Volume Information/videos/TheSimpsons/Season7/';
$simpsons_s8 = '../videos/External/System Volume Information/videos/TheSimpsons/Season8/';
$simpsons_s9 = '../videos/External/System Volume Information/videos/TheSimpsons/Season9/';
$simpsons_s10 = '../videos/External/System Volume Information/videos/TheSimpsons/Season10/';
$simpsons_s11 = '../videos/External/System Volume Information/videos/TheSimpsons/Season11/';
$simpsons_s12 = '../videos/External/System Volume Information/videos/TheSimpsons/Season12/';
$spongebob_s1 = '../videos/SpongeBob/S1/';
$spongebob_s2 = '../videos/SpongeBob/S2/';
$spongebob_s3 = '../videos/SpongeBob/S3/';
$tpb_s1 = '../videos/External/System Volume Information/videos/TPB/Season1/';
$tpb_s2 = '../videos/External/System Volume Information/videos/TPB/Season2/';
$tpb_s3 = '../videos/External/System Volume Information/videos/TPB/Season3/';
$tpb_s4 = '../videos/External/System Volume Information/videos/TPB/Season4/';
$tpb_s5 = '../videos/External/System Volume Information/videos/TPB/Season5/';
$tpb_s6 = '../videos/External/System Volume Information/videos/TPB/Season6/';
$tpb_s7 = '../videos/External/System Volume Information/videos/TPB/Season7/';
$tpb_special = '../videos/External/System Volume Information/videos/TPB/Special/';
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
$avgn = '../videos/AVGN/';
$treehouse_dir = '../videos/TreehouseOfHorror/';
$other_dir = '../videos/OtherHalloweenStuff/';
$ntbts_dir = '../videos/NTBTS/';
$test = '../videos/External/System Volume Information/videos/';
$link_test = '../videos/Links/';

$movies_comedy = '../videos/External/System Volume Information/videos/Movies/Comedy/';
$movies_horror = '../videos/External/System Volume Information/videos/Movies/Horror/';

$current_list = "";
$video_links = array();

//button for selecting which directory of videos to load from
if(isset($_POST['video_filter'])){
	$current_list = $_POST['vid_select_drop'];
	$video_links = populate_links($current_list);
	$json_video_links = json_encode($video_links);
	unset($_POST['video_filter']);
}

if(isset($_POST['home_btn'])){
	header("Location:$index");
	exit;
}

?>
</head>
<body>

<!-- Add a new button and a dir path above for each new folder of shows, videos will populate automatically from their corresponding directory in /var/www/html/videos -->
<div id="player-container">

<video id="video" class="video-js" controls preload="auto" width="640" height="360" data-setup='{}'></video>

<form method="post" id="vid_select_form">
<label for="vid_select_lbl"></label>
<select name="vid_select_drop" id="vname">
<option value='<?php echo $hey_arnold_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$hey_arnold_s1") echo 'selected';?>>Hey Arnold S1</option>
<option value='<?php echo $hey_arnold_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$hey_arnold_s2") echo 'selected';?>>Hey Arnold S2</option>
<option value='<?php echo $hey_arnold_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$hey_arnold_s3") echo 'selected';?>>Hey Arnold S3</option>
<option value='<?php echo $hey_arnold_s4; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$hey_arnold_s4") echo 'selected';?>>Hey Arnold S4</option>
<option value='<?php echo $kvs_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s1") echo 'selected';?>>Kenny vs Spenny - Season 1</option>
<option value='<?php echo $kvs_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s2") echo 'selected';?>>Kenny vs Spenny - Season 2</option>
<option value='<?php echo $kvs_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s3") echo 'selected';?>>Kenny vs Spenny - Season 3</option>
<option value='<?php echo $kvs_s4; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s4") echo 'selected';?>>Kenny vs Spenny - Season 4</option>
<option value='<?php echo $kvs_s5; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s5") echo 'selected';?>>Kenny vs Spenny - Season 5</option>
<option value='<?php echo $kvs_s6; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_s6") echo 'selected';?>>Kenny vs Spenny - Season 6</option>
<option value='<?php echo $kvs_extra; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$kvs_extra") echo 'selected';?>>Kenny vs Spenny - Extras</option>
<option value='<?php echo $ntbts_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$ntbts_dir") echo 'selected';?>>Nirvanna the Band the Show</option>
<option value='<?php echo $simpsons_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s1") echo 'selected';?>>The Simpsons Season 1</option>
<option value='<?php echo $simpsons_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s2") echo 'selected';?>>The Simpsons Season 2</option>
<option value='<?php echo $simpsons_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s3") echo 'selected';?>>The Simpsons Season 3</option>
<option value='<?php echo $simpsons_s4; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s4") echo 'selected';?>>The Simpsons Season 4</option>
<option value='<?php echo $simpsons_s5; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s5") echo 'selected';?>>The Simpsons Season 5</option>
<option value='<?php echo $simpsons_s6; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s6") echo 'selected';?>>The Simpsons Season 6</option>
<option value='<?php echo $simpsons_s7; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s7") echo 'selected';?>>The Simpsons Season 7</option>
<option value='<?php echo $simpsons_s8; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s8") echo 'selected';?>>The Simpsons Season 8</option>
<option value='<?php echo $simpsons_s9; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s9") echo 'selected';?>>The Simpsons Season 9</option>
<option value='<?php echo $simpsons_s10; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s10") echo 'selected';?>>The Simpsons Season 10</option>
<option value='<?php echo $simpsons_s11; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s11") echo 'selected';?>>The Simpsons Season 11</option>
<option value='<?php echo $simpsons_s12; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$simpsons_s12") echo 'selected';?>>The Simpsons Season 12</option>
<option value='<?php echo $spongebob_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$spongebob_s1") echo 'selected';?>>SpongeBob Season 1</option>
<option value='<?php echo $spongebob_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$spongebob_s2") echo 'selected';?>>SpongeBob Season 2</option>
<option value='<?php echo $spongebob_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$spongebob_s3") echo 'selected';?>>SpongeBob Season 3</option>
<option value='<?php echo $tpb_s1; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s1") echo 'selected';?>>Trailer Park Boys Season 1</option>
<option value='<?php echo $tpb_s2; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s2") echo 'selected';?>>Trailer Park Boys Season 2</option>
<option value='<?php echo $tpb_s3; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s3") echo 'selected';?>>Trailer Park Boys Season 3</option>
<option value='<?php echo $tpb_s4; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s4") echo 'selected';?>>Trailer Park Boys Season 4</option>
<option value='<?php echo $tpb_s5; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s5") echo 'selected';?>>Trailer Park Boys Season 5</option>
<option value='<?php echo $tpb_s6; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s6") echo 'selected';?>>Trailer Park Boys Season 6</option>
<option value='<?php echo $tpb_s7; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_s7") echo 'selected';?>>Trailer Park Boys Season 7</option>
<option value='<?php echo $tpb_special; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$tpb_special") echo 'selected';?>>Trailer Park Boys Specials</option>
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
<option value='<?php echo $avgn; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$avgn") echo 'selected';?>>AVGN</option>
<option value='<?php echo $treehouse_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$treehouse_dir") echo 'selected';?>>Treehouse of Horror</option>
<option value='<?php echo $other_dir; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$other_dir") echo 'selected';?>>Misc Shows</option>
<option value='<?php echo $movies_comedy; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$movies_comedy") echo 'selected';?>>Comedy</option>
<option value='<?php echo $movies_horror; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$movies_horror") echo 'selected';?>>Horror</option>
<option value='<?php echo $test; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$test") echo 'selected';?>>Test Dir</option>
<option value='<?php echo $link_test; ?>' <?php  if(isset($_POST['vid_select_drop']) && $_POST['vid_select_drop'] == "$link_test") echo 'selected';?>>Sym Link Test Dir</option>

</select>
<input type="submit" name="video_filter" class="button" value="Display" />
<input type="submit" name="home_btn" class="button" value="Home" />
</form>
<!--div id="title_div" class="vjs-playlist-now-playing"-->
<!--div class="vjs-playlist-now-playing"-->
<!--h3 id="directory_title"></h3-->
<!--/div-->
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
		const clean_title = temp.substring(breakpoint+1).replace(/\.(mp4|mkv)$/g, '');
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
