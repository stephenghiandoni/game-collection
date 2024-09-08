<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>SteveTube</title>
<link rel="stylesheet" href="../css/monster_madness.css?version=1" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/video.js/dist/video-js.min.css" type="text/css"></link>
<link rel="stylesheet" href="../node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.css" type="text/css"></link>
<?php
include('def.php');

$avgn = 'AVGN';
$hey_arnold = 'Hey Arnold';
$kvs = 'Kenny vs Spenny';
$monster_madness = 'Monster Madness';
$ntbts = 'Nirvanna the Band the Show';
$spongebob = 'Spongebob';
$the_simpsons = 'The Simpsons';
$tpb = 'Trailer Park Boys';
$movies = "Movies";
$special = 'Special';

$avgn_s1 = '../videos/AVGN/Season1/';
$avgn_s2 = '../videos/AVGN/Season2/';
$avgn_s3 = '../videos/AVGN/Season3/';
$avgn_s4 = '../videos/AVGN/Season4/';
$avgn_s5 = '../videos/AVGN/Season5/';
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
$ntbts_s1 = '../videos/External/System Volume Information/videos/NTBTS/Season1/';
$ntbts_s2 = '../videos/External/System Volume Information/videos/NTBTS/Season2/';
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
$treehouse_dir = '../videos/Special/TreehouseOfHorror/';
$halloween_dir = '../videos/Special/Halloween/';
$christmas_dir = '../videos/Special/Christmas/';

$movies_comedy = '../videos/External/System Volume Information/videos/Movies/Comedy/';
$movies_drama = '../videos/External/System Volume Information/videos/Movies/Drama/';
$movies_horror = '../videos/External/System Volume Information/videos/Movies/Horror/';

$selected_show = $_SESSION['selected_show'];
$current_list = $_SESSION['current_list'];

$video_links = array();

if(isset($_POST['show_filter']) || isset(_POST['show_select_drop'])){
	$selected_show = $_POST['show_select_drop'];
	$_SESSION['selected_show'] = $selected_show;
}

//button for selecting which directory of videos to load from
if(isset($_POST['video_filter'])){
	$current_list = $_POST['vid_select_drop'];
	$_SESSION['current_list'] = $current_list;
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
<div id="form-container">
<form method="post" id="show_select_form">
<select name="show_select_drop" id="show_select_drop" >
<option value='' >Select a Show</option>
<option value='<?php echo $avgn; ?>' <?php echo $_SESSION['selected_show'] === $avgn ? 'selected' : ''; ?>><?php echo $avgn; ?></option>
<option value='<?php echo $hey_arnold; ?>'<?php echo $_SESSION['selected_show'] === $hey_arnold ? 'selected' : ''; ?>><?php echo $hey_arnold; ?></option>
<option value='<?php echo $kvs; ?>'<?php echo $_SESSION['selected_show'] === $kvs ? 'selected' : ''; ?>><?php echo $kvs; ?></option>
<option value='<?php echo $ntbts; ?>'<?php echo $_SESSION['selected_show'] === $ntbts ? 'selected' : ''; ?>><?php echo $ntbts; ?></option>
<option value='<?php echo $monster_madness; ?>'<?php echo $_SESSION['selected_show'] === $monster_madness ? 'selected' : ''; ?>><?php echo $monster_madness; ?></option>
<option value='<?php echo $the_simpsons; ?>'<?php echo $_SESSION['selected_show'] === $the_simpsons ? 'selected' : ''; ?>><?php echo $the_simpsons; ?></option>
<option value='<?php echo $spongebob; ?>'<?php echo $_SESSION['selected_show'] === $spongebob ? 'selected' : ''; ?>><?php echo $spongebob; ?></option>
<option value='<?php echo $tpb; ?>'<?php echo $_SESSION['selected_show'] === $tpb ? 'selected' : ''; ?>><?php echo $tpb; ?></option>
<option value='<?php echo $movies; ?>'<?php echo $_SESSION['selected_show'] === $movies ? 'selected' : ''; ?>><?php echo $movies; ?></option>
<option value='<?php echo $special; ?>'<?php echo $_SESSION['selected_show'] === $special ? 'selected' : ''; ?>><?php echo $special; ?></option>
</select>
<input type="submit" name="show_filter" class="button" value="Select Show" />
</form>

<form method="post" id="vid_select_form">
<select name="vid_select_drop" id="vid_select_drop">
<?php if($selected_show === ""){ ?>
<option value='' >Select a Show</option>
<?php } ?>
<?php if($selected_show === $avgn){ ?>
<option value='<?php echo $avgn_s1; ?>' <?php echo $_SESSION['current_list'] === $avgn_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $avgn_s2; ?>' <?php echo $_SESSION['current_list'] === $avgn_s2 ? 'selected' : ''; ?> >Season 2</option>
<option value='<?php echo $avgn_s3; ?>' <?php echo $_SESSION['current_list'] === $avgn_s3 ? 'selected' : ''; ?> >Season 3</option>
<option value='<?php echo $avgn_s4; ?>' <?php echo $_SESSION['current_list'] === $avgn_s4 ? 'selected' : ''; ?> >Season 4</option>
<option value='<?php echo $avgn_s5; ?>' <?php echo $_SESSION['current_list'] === $avgn_s5 ? 'selected' : ''; ?> >Season 5</option>
<?php } ?>
<?php if($selected_show === $hey_arnold){ ?>
<option value='<?php echo $hey_arnold_s1; ?>' <?php echo $_SESSION['current_list'] === $hey_arnold_s1 ? 'selected' : ''; ?>>Season 1</option>
<option value='<?php echo $hey_arnold_s2; ?>' <?php echo $_SESSION['current_list'] === $hey_arnold_s2 ? 'selected' : ''; ?>>Season 2</option>
<option value='<?php echo $hey_arnold_s3; ?>' <?php echo $_SESSION['current_list'] === $hey_arnold_s3 ? 'selected' : ''; ?>>Season 3</option>
<option value='<?php echo $hey_arnold_s4; ?>' <?php echo $_SESSION['current_list'] === $hey_arnold_s4 ? 'selected' : ''; ?>>Season 4</option>
<?php } ?>
<?php if($selected_show === $kvs){ ?>
<option value='<?php echo $kvs_s1; ?>' <?php echo $_SESSION['current_list'] === $kvs_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $kvs_s2; ?>' <?php echo $_SESSION['current_list'] === $kvs_s2 ? 'selected' : ''; ?> >Season 2</option>
<option value='<?php echo $kvs_s3; ?>' <?php echo $_SESSION['current_list'] === $kvs_s3 ? 'selected' : ''; ?> >Season 3</option>
<option value='<?php echo $kvs_s4; ?>' <?php echo $_SESSION['current_list'] === $kvs_s4 ? 'selected' : ''; ?> >Season 4</option>
<option value='<?php echo $kvs_s5; ?>' <?php echo $_SESSION['current_list'] === $kvs_s5 ? 'selected' : ''; ?> >Season 5</option>
<option value='<?php echo $kvs_s6; ?>' <?php echo $_SESSION['current_list'] === $kvs_s6 ? 'selected' : ''; ?> >Season 6</option>
<option value='<?php echo $kvs_extra; ?>' <?php echo $_SESSION['current_list'] === $kvs_extra ? 'selected' : ''; ?> >Extras</option>
<?php } ?>
<?php if($selected_show === $ntbts){ ?>
<option value='<?php echo $ntbts_s1; ?>' <?php echo $_SESSION['current_list'] === $ntbts_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $ntbts_s2; ?>' <?php echo $_SESSION['current_list'] === $ntbts_s2 ? 'selected' : ''; ?> >Season 2</option>
<?php } ?>
<?php if($selected_show === $the_simpsons){ ?>
<option value='<?php echo $simpsons_s1; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $simpsons_s2; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s2 ? 'selected' : ''; ?> >Season 2</option>
<option value='<?php echo $simpsons_s3; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s3 ? 'selected' : ''; ?> >Season 3</option>
<option value='<?php echo $simpsons_s4; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s4 ? 'selected' : ''; ?> >Season 4</option>
<option value='<?php echo $simpsons_s5; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s5 ? 'selected' : ''; ?> >Season 5</option>
<option value='<?php echo $simpsons_s6; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s6 ? 'selected' : ''; ?> >Season 6</option>
<option value='<?php echo $simpsons_s7; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s7 ? 'selected' : ''; ?> >Season 7</option>
<option value='<?php echo $simpsons_s8; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s8 ? 'selected' : ''; ?> >Season 8</option>
<option value='<?php echo $simpsons_s9; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s9 ? 'selected' : ''; ?> >Season 9</option>
<option value='<?php echo $simpsons_s10; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s10 ? 'selected' : ''; ?> >Season 10</option>
<option value='<?php echo $simpsons_s11; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s11 ? 'selected' : ''; ?> >Season 11</option>
<option value='<?php echo $simpsons_s12; ?>' <?php echo $_SESSION['current_list'] === $simpsons_s11 ? 'selected' : ''; ?> >Season 12</option>
<?php } ?>
<?php if($selected_show === $spongebob){ ?>
<option value='<?php echo $spongebob_s1; ?>' <?php echo $_SESSION['current_list'] === $spongebob_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $spongebob_s2; ?>' <?php echo $_SESSION['current_list'] === $spongebob_s2 ? 'selected' : ''; ?> >Season 2</option>
<option value='<?php echo $spongebob_s3; ?>' <?php echo $_SESSION['current_list'] === $spongebob_s3 ? 'selected' : ''; ?> >Season 3</option>
<?php } ?>
<?php if($selected_show === $tpb){ ?>
<option value='<?php echo $tpb_s1; ?>' <?php echo $_SESSION['current_list'] === $tpb_s1 ? 'selected' : ''; ?> >Season 1</option>
<option value='<?php echo $tpb_s2; ?>' <?php echo $_SESSION['current_list'] === $tpb_s2 ? 'selected' : ''; ?> >Season 2</option>
<option value='<?php echo $tpb_s3; ?>' <?php echo $_SESSION['current_list'] === $tpb_s3 ? 'selected' : ''; ?> >Season 3</option>
<option value='<?php echo $tpb_s4; ?>' <?php echo $_SESSION['current_list'] === $tpb_s4 ? 'selected' : ''; ?> >Season 4</option>
<option value='<?php echo $tpb_s5; ?>' <?php echo $_SESSION['current_list'] === $tpb_s5 ? 'selected' : ''; ?> >Season 5</option>
<option value='<?php echo $tpb_s6; ?>' <?php echo $_SESSION['current_list'] === $tpb_s6 ? 'selected' : ''; ?> >Season 6</option>
<option value='<?php echo $tpb_s7; ?>' <?php echo $_SESSION['current_list'] === $tpb_s7 ? 'selected' : ''; ?> >Season 7</option>
<option value='<?php echo $tpb_special; ?>' <?php echo $_SESSION['current_list'] === $tpb_special ? 'selected' : ''; ?> >Specials</option>
<?php } ?>
<?php if($selected_show === $monster_madness){ ?>
<option value='<?php echo $mm2007_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2007_dir ? 'selected' : ''; ?> >2007 History of Horror</option>
<option value='<?php echo $mm2008_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2008_dir ? 'selected' : ''; ?> >2008 GodzillaThon</option>
<option value='<?php echo $mm2009_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2009_dir ? 'selected' : ''; ?> >2009 Monster Madness 3</option>
<option value='<?php echo $mm2010_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2010_dir ? 'selected' : ''; ?> >2010 Camp Cult</option>
<option value='<?php echo $mm2011_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2011_dir ? 'selected' : ''; ?> >2011 Sequel-A-Thon</option>
<option value='<?php echo $mm2012_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2012_dir ? 'selected' : ''; ?> >2012 80's-A-Thon</option>
<option value='<?php echo $mm2013_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2013_dir ? 'selected' : ''; ?> >2013 Sequel-A-Thon 2</option>
<option value='<?php echo $mm2014_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2014_dir ? 'selected' : ''; ?> >2014 Monster Madness 8</option>
<option value='<?php echo $mm2015_dir; ?>' <?php echo $_SESSION['current_list'] === $mm2015_dir ? 'selected' : ''; ?> >2015 Monster Madness 9</option>
<option value='<?php echo $mm_other_dir; ?>' <?php echo $_SESSION['current_list'] === $mm_other_dir ? 'selected' : ''; ?> >Other Monster Madness</option>
<?php } ?>
<?php if($selected_show === $special){ ?>
<option value='<?php echo $treehouse_dir; ?>' <?php echo $_SESSION['current_list'] === $treehouse_dir ? 'selected' : ''; ?> >Treehouse of Horror</option>
<option value='<?php echo $halloween_dir; ?>' <?php echo $_SESSION['current_list'] === $halloween_dir ? 'selected' : ''; ?> >Halloween</option>
<option value='<?php echo $christmas_dir; ?>' <?php echo $_SESSION['current_list'] === $christmas_dir ? 'selected' : ''; ?> >Christmas</option>
<?php } ?>
<?php if($selected_show === $movies){ ?>
<option value='<?php echo $movies_comedy; ?>' <?php echo $_SESSION['current_list'] === $movies_comedy ? 'selected' : ''; ?> >Comedy</option>
<option value='<?php echo $movies_drama; ?>' <?php echo $_SESSION['current_list'] === $movies_drama ? 'selected' : ''; ?> >Drama</option>
<option value='<?php echo $movies_horror; ?>' <?php echo $_SESSION['current_list'] === $movies_horror ? 'selected' : ''; ?> >Horror</option>
<?php } ?>
</select>
<input type="submit" name="video_filter" class="button" value="Display" />
<input type="submit" name="home_btn" class="button" value="Home" />
</form>
</div>
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
