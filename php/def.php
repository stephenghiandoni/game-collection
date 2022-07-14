<?php
$index = "../index.php";
$db_options = "db_options.php";
$games = "games.php";
$display_games = "display_games.php";
$consoles = "consoles.php";
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
		?>
