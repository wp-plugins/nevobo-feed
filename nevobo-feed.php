<?php
/*
Plugin Name: Nevobo Feed
Plugin URI: http://masselink.net/nevobo-feed
Description: Toon de RSS feeds van de Nevobo volleybal competitie in stijl op je website. Gebruik shortcode: [nevobo feed="url"] 
Version: 1.7
Author: Harold Masselink
Author URI: http://Masselink.net
*/
define('nevobo_feed_versie','1.7');
add_shortcode('nevobo','nevobo_shortcode');
add_action('admin_menu', 'nevobo_admin_actions');
add_action( 'wp_enqueue_scripts', 'nevobo_feed_stylesheet' );

// Nevobo Feed shortcode toevoegen
function nevobo_shortcode($paras="",$content="") {
    $param = shortcode_atts(array('feed'=>'','aantal'=>'','sporthal'=>'','plaats'=>'','cache'=>'', 'vereniging'=>'', 'ical'=>'', 'sets'=>'', 'naamlengte_prog'=>'','naamlengte_uitslag'=>'','naamlengte_stand'=>'', 'widget'=>''),$paras);
    return get_nevobo($param['feed'],$param['aantal'],$param['sporthal'],$param['plaats'],$param['cache'],$param['vereniging'],$param['ical'],$param['sets'],$param['naamlengte_prog'],$param['naamlengte_uitslag'],$param['naamlengte_stand'],$param['widget']);
}


// Nevobo Feed Shortcode
function nevobo_feed($feed,$add_paras) {
        // Parameter afhandeling
        $sporthal=get_feed_parameters($add_paras,"sporthal");
		$plaats=get_feed_parameters($add_paras,"plaats");
        $cache=get_feed_parameters($add_paras,"cache");
        $vereniging=get_feed_parameters($add_paras,"vereniging");
        $ical=get_feed_parameters($add_paras,"ical");
        $sets=get_feed_parameters($add_paras,"sets");
        $naamlengte_prog=get_feed_parameters($add_paras,"naamlengte_prog");
        $naamlengte_uitslag=get_feed_parameters($add_paras,"naamlengte_uitslag");
        $naamlengte_stand=get_feed_parameters($add_paras,"naamlengte_stand");


    // Trap de feed af
    echo get_nevobo($feed,$aantal,$sporthal,$plaats,$cache,$vereniging,$ical,$sets,$naamlengte_prog,$naamlengte_uitslag,$naamlengte_stand);
    return;
}	

// Feed list code
function get_nevobo($feed,$aantal,$sporthal,$plaats,$cache,$vereniging,$ical,$sets,$naamlengte_prog,$naamlengte_uitslag,$naamlengte_stand) {  
    //Standaard parameter fallback
	if (!is_null($vereniging)) $vereniging=get_option('nevobofeed_vereniging');
	if (!is_null($sporthal)) $sporthal=get_option('nevobofeed_sporthal'); 
	if (!is_null($plaats)) $plaats=get_option('nevobofeed_plaats');
	if (!is_null($cache)) $cache=get_option('nevobofeed_cache');
	if (!is_null($ical)) $ical=get_option('nevobofeed_ical');
	if (!is_null($sets)) $sets=get_option('nevobofeed_sets');
	if (!is_null($naamlengte_prog)) $naamlengte_prog=get_option('nevobofeed_naamlengte_prog');
	if (!is_null($naamlengte_uitslag)) $naamlengte_uitslag=get_option('nevobofeed_naamlengte_uitslag');
	if (!is_null($naamlengte_stand)) $naamlengte_stand=get_option('nevobofeed_naamlengte_stand');
	$highlight_color=get_option('nevobofeed_highlight_color');
    $image_set=get_option('nevobofeed_image_set');
        
    $code="<!-- Nevobo Feed ".nevobo_feed_versie." | http://www.masselink.net -->\n";
    $code.="<span class='nevobofeed'>";
	
    // Limiten instellen
    $check_failure=false;
	//bepaal het feed type om verschillende stijlen te gebruiken | 1-stand, 2-uitslagen, 3-programma
	$nevobo_feedtype=0;
	if (stristr($feed, 'standen')) { $nevobo_feedtype=1;
									 if (empty($aantal)) { $aantal=get_option('nevobofeed_standen_aantal'); }
								   	 if (empty($aantal)) { $aantal=12; }
								}
	if (stristr($feed, 'uitslagen')) { $nevobo_feedtype=2; 
									   if (empty($aantal)) { $aantal=get_option('nevobofeed_uitslagen_aantal'); }
									   if (empty($aantal)) { $aantal=6; }
								     }
	if (stristr($feed, 'programma')) { $nevobo_feedtype=3; 
									   if (empty($aantal)) { $aantal=get_option('nevobofeed_programma_aantal'); }
									   if (empty($aantal)) { $aantal=6; }
								     }
    
    // Maak gebruik van de MagpieRSS Cache
   if ($cache!=0) {
        $cache_time=$cache*900;
        define('MAGPIE_CACHE_AGE',$cache_time);
        define('MAGPIE_CACHE_ON',true); //true
    } else {
        define('MAGPIE_CACHE_ON',false);
    }
 
    if ($check_failure!==true) {
       @include_once(ABSPATH.WPINC.'/rss.php');
       @$array=fetch_rss(wp_specialchars_decode($feed));

		 // Als er geen feed is gevonden, dan een foutmelding genereren
        if ($array=="") {
            $check_failure=1;
            $code.=nevobo_feed_fout("De opgegeven Feed kan niet worden verwerkt.","Nevobo Feed");
        } else {
        	
// Start of processing loop -----------------------------------------------------------------
             $items=array_slice($array->items,0,$aantal);
			//rss table headers | 1-stand, 2-uitslagen, 3-Programma
            $code .= "<table class='nevobofeed'>";
			switch ($nevobo_feedtype) {
					case 1: //Stand
						$code .= "<thead><tr><th>#</th><th style='min-width: 150px;'>Team </th><th>Wedstr.</th><th>Punten </th></tr></thead><tbody>";
						$code .= "<tr>";
						foreach ($items as $item) {
							$standen = explode("<br />", $item[description]);
							$i=0;
						    $len = count($standen);
						    foreach ($standen as $stand) {
						    	if (($i==0) OR ($i==($len-1))) { $i++; continue; } 
						    	$i++;
						    	$regex = "#([0-9]?[0-9]). ([^\,]+), wedstr: ([^\,]+), punten: ([^\,]+)#";
								preg_match($regex, $stand, $groep);
								$plek = $groep[1];
								$ploeg = $groep[2];
								$wedstrijden = $groep[3];
								$punten = $groep[4];
								if ($vereniging!="") if (stristr($ploeg,$vereniging)) $code .= "<tr style='color:".$highlight_color."'>"; else $code .= "<tr>";
								$code .= "<td>".$plek."</td><td title='".$ploeg."' style='max-width:".$naamlengte_stand."px;'>".$ploeg."</td><td>".$wedstrijden."</td><td>".$punten."</td></tr>";
								if ($i>$aantal) break;
							}
						
						}
						$code .= "</tr>";
					break;
					case 2: //Uitslagen
						$code = "<table class='nevobofeed'>";
						$code .="<thead><tr><th>Datum</th><th style='min-width: 150px;'>Thuisploeg </th><th></th><th style='min-width: 150px;'>Uitploeg</th><th>Resultaat </th></tr></thead><tbody>";
						foreach ($items as $item) {
										//Datum
										$code .= "<tr>";
										$regex = "#[^ ]+ ([0-9]?[0-9]) (...) (....) [^ ]+ [^ ]+#";
										preg_match($regex, $item[pubdate], $groep);
										$datum1 = $groep[1];
										$datum2 = $groep[2];
										$code .= "<td>".$datum1." ".$datum2."</td>";
										//wedstrijd gegevens
										$regex = "#Wedstrijd: ([\w\W\s\S\d\D]+) - ([\w\W\s\S\d\D]+), Uitslag: ([^,]+)*, Setstanden: ?(.*)#"; 
										preg_match($regex, $item[description], $groep);
										$thuisploeg = $groep[1];
										$uitploeg = $groep[2];
										$uitslag = $groep[3];
										$setstanden = $groep[4];

										$check = "<td title='".$thuisploeg."' style='max-width:".$naamlengte_uitslag."px;'>";
										
										if ($vereniging!="") if (stristr($thuisploeg,$vereniging)) $check .= "<span style='color:".$highlight_color."'>";
										$check .= $thuisploeg;
										if ($vereniging!="") if (stristr($thuisploeg,$vereniging)) $check .= "</span>";
										$check .= "</td><td> - </td>";
										
										$check .= "<td title='".$uitploeg."' style='max-width:".$naamlengte_uitslag."px;'>";
										if ($vereniging!="") if (stristr($uitploeg,$vereniging)) $check .= "<span style='color:".$highlight_color."'>";
										$check .= $uitploeg;
										if ($vereniging!="") if (stristr($uitploeg,$vereniging)) $check .= "</span>";
										$check .= "</td><td>".$uitslag;
										if ($setstanden!='') { 
											if ($sets=='1') {$check .= "<img src='".get_site_url()."/wp-content/plugins/nevobo-feed/images/".$image_set."_sets.png' title='".$setstanden."'></td>";}
										} else {
											$check .= "onbekend";
										}
										if (stristr($check,"geen uitslagen")) {$code .= "<td><br>Er zijn nog geen uitslagen bekend<br><br></td><td></td><td></td>"; } else {
											$code .= $check;
										}
										$code .= "</tr>";
					    	 }
						         
					break;
					case 3: //Programma
						$code = "<table class='nevobofeed'>";
						$code.="<thead><tr><th>Datum</th><th>Tijd</th><th style='min-width: 150px;'>Thuisploeg </th><th></th><th style='min-width: 150px;'>Uitploeg</th>";
						if ($sporthal==1) { $code .= "<th>Sporthal</th>";}
						if ($plaats==1) { $code .= "<th>Plaats</th>";}
						$code .= "</tr></thead><tbody>";
						 // Loopje voor alle items
							foreach ($items as $item) {
                						$titel=$item[title];
										$regex = "#([^ ]+) ([^ ]+) ([0-9]?[0-9]:[0-9][0-9]): (.*) - (.*)#";
										preg_match($regex, $item[title], $groep); 
										$datum1 = $groep[1];
										$datum2 = $groep[2];
										$tijd = $groep[3];
										$thuisploeg = $groep[4];
										$uitploeg = $groep[5];

										$code .= "<tr><td>".$datum1." ".$datum2."</td><td>".$tijd."</td>";
										$code .= "<td title='".$thuisploeg."' style='max-width:".$naamlengte_prog."px;'>";
										
										if ($vereniging!="") if (stristr($thuisploeg,$vereniging)) $code .= "<span style='color:".$highlight_color."'>";
										$code .= $thuisploeg;
										if ($vereniging!="") if (stristr($thuisploeg,$vereniging)) $code .= "</span>";
										$code .= "</td><td> - </td>";
										
										$code .= "<td title='".$uitploeg."' style='max-width:".$naamlengte_prog."px;'>";
										if ($vereniging!="") if (stristr($uitploeg,$vereniging)) $code .= "<span style='color:".$highlight_color."'>";
										$code .= $uitploeg;
										if ($vereniging!="") if (stristr($uitploeg,$vereniging)) $code .= "</span>";
										$code .= "</td>";

										//Speellocatie toevoegen
										$groep = "";
										if ($sporthal==1 || $plaats==1) {
											$regex = "#Wedstrijd: (.*), Datum: (.*), (.*), Speellocatie: (.*), (.*), (.*) (.*)#";
											preg_match($regex, $item[description], $groep);
											if ($sporthal==1) { $code .= "<td>".$groep[4]."</td>"; }
											if ($plaats==1) { $code .= "<td>".$groep[7]."</td>"; }
											}
										$code .= "</tr>";
					}
					break;
					default:
						$check_failure=1;
						$code.=nevobo_feed_fout("Het type feed kan niet worden bepaald. Betreft het wel een Nevobo feed?","Nevobo Feed");

            }
            $code .= "</tbody></table>";
            if (($nevobo_feedtype==3) && ($ical==1)) {
            	$icalfeed = str_replace("format=rss", "format=ical", $feed);
            	if (stristr($icalfeed,"poule")) { $code .= "<img src='".get_site_url()."/wp-content/plugins/nevobo-feed/images/".$image_set."_ical.png'> <a href='".$icalfeed."'>Voeg het volledige programma van de poule aan je agenda toe</a><br /><br />"; 
            	} else {
            		$code .= "<img align='absmiddle' src='".get_site_url()."/wp-content/plugins/nevobo-feed/images/".$image_set."_ical.png'> <a href='".$icalfeed."'>Voeg het volledige programma van het team aan je agenda toe</a><br /><br />";
            	}

        }
        }
    }
// Stop of processing loop -----------------------------------------------------------------
    $code.="</span>";
    $code.="<!-- einde van de nevobo feed -->";
    return $code;
}

function nevobo_admin_actions() {
add_options_page("Nevobo-feed", "Nevobo-feed", 1, "nevobo-feed-plugin", "nevobo_feed_admin");   
}

function nevobo_feed_admin() {  
    include('nevobo-feed_admin.php');
}

function nevobo_feed_stylesheet() {
        // Respects SSL, Style.css is relative to the current file
        wp_register_style( 'nevobo-feed_style', get_site_url().'/wp-content/plugins/nevobo-feed/style/nevobo-feed.css' );
        wp_enqueue_style( 'nevobo-feed_style' );
    }  

// Fout rapportage
function nevobo_feed_fout($errorin,$plugin_name) {
    return "<p style=\"font-weight: bold;\">".$plugin_name.": ".__($errorin)."\n";
}