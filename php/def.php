<?php
//when adding a new gid, must also update translate_gid function(change gid to what pricecharting uses as console name)
$index = "../index.php";
$db_options = "db_options.php";
$games = "games.php";
$display_games = "display_games.php";
$consoles = "consoles.php";
$value_pg = "value.php";
$gid_famicom = "famicom";
$gid_sfamicom = "super_famicom";
$gid_3ds = "3ds";
$gid_a2600 = "a2600";
$gid_ds = "ds";
$gid_gb = "gb";
$gid_gba = "gba";
$gid_gbc = "gbc";
$gid_gc = "gc";
$gid_genesis = "genesis";
$gid_n64 = "n64";
$gid_nes = "nes";
$gid_ps1 = "ps1";
$gid_ps2 = "ps2";
$gid_ps3 = "ps3";
$gid_ps4 = "ps4";
$gid_ps5 = "ps5";
$gid_psp = "psp";
$gid_ps_vita = "ps_vita";
$gid_saturn = "saturn";
$gid_sms = "sms";
$gid_snes = "snes";
$gid_switch = "switch";
$gid_vb = "virtual_boy";
$gid_wii = "wii";
$gid_wiiu = "wii-u";
$gid_xbox = "xbox";
$gid_x360 = "x360";
$gid_xbone = "xbone";
$csv_path_3ds = "../csv/3ds.csv";
$csv_path_a2600_1 = "../csv/a2600_1.csv";
$csv_path_a2600_2 = "../csv/a2600_2.csv";
$csv_path_ds_1= "../csv/ds_1.csv";
$csv_path_ds_2= "../csv/ds_2.csv";
$csv_path_ds_3= "../csv/ds_3.csv";
$csv_path_ds_4= "../csv/ds_4.csv";
$csv_path_famicom = "../csv/famicom.csv";
$csv_path_gb = "../csv/gb.csv";
$csv_path_gba = "../csv/gba.csv";
$csv_path_gbc = "../csv/gbc.csv";
$csv_path_gc = "../csv/gc.csv";
$csv_path_genesis = "../csv/genesis.csv";
$csv_path_n64 = "../csv/n64.csv";
$csv_path_nes = "../csv/nes.csv";
$csv_path_ps1_1 = "../csv/ps1_1.csv";
$csv_path_ps1_2 = "../csv/ps1_2.csv";
$csv_path_ps2_1 = "../csv/ps2_1.csv";
$csv_path_ps2_2 = "../csv/ps2_2.csv";
$csv_path_ps3_1 = "../csv/ps3_1.csv";
$csv_path_ps3_2 = "../csv/ps3_2.csv";
$csv_path_ps3_3 = "../csv/ps3_3.csv";
$csv_path_ps3_4 = "../csv/ps3_4.csv";
$csv_path_ps4_1 = "../csv/ps4_1.csv";
$csv_path_ps4_2 = "../csv/ps4_2.csv";
$csv_path_ps5_1 = "../csv/ps5_1.csv";
$csv_path_psp = "../csv/psp.csv";
$csv_path_ps_vita_1 = "../csv/ps_vita_1.csv";
$csv_path_ps_vita_2 = "../csv/ps_vita_2.csv";
$csv_path_ps_vita_3 = "../csv/ps_vita_3.csv";
$csv_path_ps_vita_4 = "../csv/ps_vita_4.csv";
$csv_path_ps_vita_5 = "../csv/ps_vita_5.csv";
$csv_path_ps_vita_6 = "../csv/ps_vita_6.csv";
$csv_path_saturn = "../csv/saturn.csv";
$csv_path_sms = "../csv/sms.csv";
$csv_path_snes = "../csv/snes.csv";
$csv_path_switch_1 = "../csv/switch_1.csv";
$csv_path_switch_2 = "../csv/switch_2.csv";
$csv_path_switch_3 = "../csv/switch_3.csv";
$csv_path_switch_4 = "../csv/switch_4.csv";
$csv_path_switch_5 = "../csv/switch_5.csv";
$csv_path_vb = "../csv/virtual_boy.csv";
$csv_path_wii = "../csv/wii.csv";
$csv_path_wiiu = "../csv/wii-u.csv";
$csv_path_xbox = "../csv/xbox.csv";
$csv_path_x360_1 = "../csv/x360_1.csv";
$csv_path_x360_2 = "../csv/x360_2.csv";
$csv_path_xbone_1 = "../csv/xbone_1.csv";
$csv_path_xbone_2 = "../csv/xbone_2.csv";
$err_owner_msg = "Error: No owner selected for ";

$region_list = array(
		"NTSC",
		"NTSC-J",
		"PAL"
		);

$platform_list = array(
		//NINTENDO
		"NES",
		"Famicom",
		"SNES",
		"SNES&nbspModel&nbsp2",
		"Super&nbspFamicom",
		"Virtual&nbspBoy",
		"N64",
		"N64&nbspJungle&nbspGreen",
		"N64&nbspIce&nbspBlue",
		"N64&nbspClear&nbspRed",
		"N64&nbspClear&nbspBlue",
		"N64&nbspFuntastic&nbspJungle&nbspGreen",
		"N64&nbspGold",
		"N64&nbspPikachu&nbspBlue",
		"Gamecube",
		"Wii",
		"Wii&nbspU",
		"Switch",
		//SONY
		"PS1",
		"PS2&nbspFat",
		"PS2&nbspSlim",
		"PS3&nbspFat",
		"PS3&nbspSlim",
		"PS4",
		"PS5",
		//SEGA
		"Master&nbspSystem",
		"Genesis&nbsp&nbsp2",
		"Saturn",
		//ATARI
		"Atari&nbsp2600",
		//HANDHELDS
		"GameBoy&nbspOriginal",
		"GameBoy&nbspColor",
		"GameBoy&nbspAdvance",
		"GameBoy&nbspAdvance&nbspSP",
		"DS&nbspOriginal",
		"DSi",
		"DS&nbspLite",
		"DS&nbspLite&nbspThe&nbspWorld&nbspEnds&nbspWith&nbspYou&nbspEdition",
		"3DS",
		"3DS&nbspXL&nbspYoshi&nbspSpecial&nbspEdition",
		"PSP",
		"PS&nbspVita",
		"PS&nbspVita&nbspTV",
		//MICROSOFT
		"Xbox&nbspOriginal",
		"Xbox&nbsp360",
		"Xbox&nbspOne",
		//MISC
		"NES&nbspClassic&nbspEdition",
		"SNES&nbspClassic&nbspEdition",
		"Sega&nbspGenesis&nbspMini",
		"PlayStation&nbspClassic&nbspConsole"
		);

//change gid to platform named used by pricecharting.com
//using literal name of gids defined above instead of globals, hopefully will not need to change :D
function translate_gid($raw_gid){
	if($raw_gid === "a2600")
		return 'Atari-2600';
	elseif($raw_gid === "famicom")
		return "Famicom";
	elseif($raw_gid === "super_famicom")
		return "Super-Famicom";
	elseif($raw_gid === "3ds")
		return "Nintendo-3DS";
	elseif($raw_gid === "ds")
		return "Nintendo-DS";
	elseif($raw_gid === "gb")
		return "Gameboy";
	elseif($raw_gid === "gba")
		return "Gameboy-Advance";
	elseif($raw_gid === "gbc")
		return "Gameboy-Color";
	elseif($raw_gid === "n64")
		return "Nintendo-64";
	elseif($raw_gid === "gc")
		return "GameCube";
	elseif($raw_gid === "nes")
		return "NES";
	elseif($raw_gid === "snes")
		return "Super-Nintendo";
	elseif($raw_gid === "virtual_boy")
		return "Virtual-Boy";
	elseif($raw_gid === "wii")
		return "Wii";
	elseif($raw_gid === "wii-u")
		return "Wii-U";
	elseif($raw_gid === "switch")
		return 'Nintendo-Switch';
	elseif($raw_gid === "ps1")
		return 'Playstation';
	elseif($raw_gid === "ps2")
		return 'Playstation-2';
	elseif($raw_gid === "ps3")
		return 'Playstation-3';
	elseif($raw_gid === "ps4")
		return 'Playstation-4';
	elseif($raw_gid === "ps5")
		return 'Playstation-5';
	elseif($raw_gid === "psp")
		return "PSP";
	elseif($raw_gid === "ps_vita")
		return "Playstation-Vita";
	elseif($raw_gid === "sms")
		return 'Sega-Master-System';
	elseif($raw_gid === "genesis")
		return 'Sega-Genesis';
	elseif($raw_gid === "saturn")
		return 'Sega-Saturn';
	elseif($raw_gid === "xbox")
		return "Xbox";
	elseif($raw_gid === "x360")
		return "Xbox-360";
	elseif($raw_gid === "xbone")
		return "Xbox-One";
	else
		return $raw_gid;
}

//append region to string for building pricecharting url properly
function translate_region($raw_region){
	if($raw_region === 'NTSC-J')
		return 'jp-';
	elseif($raw_region === 'PAL')
		return 'pal-';
	else
		return $raw_region;
}

?>
