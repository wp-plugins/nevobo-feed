<?php
/*
Plugin Name: Nevobo Feed
Plugin URI: http://masselink.net/nevobo-feed
Description: Toon de RSS feeds van de Nevobo volleybal competitie in stijl op je website. Gebruik shortcode: [nevobo feed="url"] 
Version: 1.0.2
Author: Harold Masselink
Author URI: http://Masselink.net
*/
define('nevobo_feed_versie','1.0.2');
add_shortcode('nevobo','nevobo_shortcode');

// Nevobo Feed shortcode toevoegen
function nevobo_shortcode($paras="",$content="") {
    extract(shortcode_atts(array('feed'=>'','aantal'=>'','sporthal'=>'','plaats'=>'','cache'=>''),$paras));
    return get_nevobo($feed,$aantal,$sporthal,$plaats,$cache,'sc');
}


// Nevobo Feed Shortcode
function nevobo_feed($feed,$add_paras) {
    // van de parameters
        $sporthal=get_feed_parameters($add_paras,"sporthal");
		$plaats=get_feed_parameters($add_paras,"plaats");
        $cache=get_feed_parameters($add_paras,"cache");

    // Trap de feed af
    echo get_nevobo($feed,$aantal,$sporthal,$plaats,$doel,$cache);
    return;
}
	

// Feed list code
function get_nevobo($feed,$aantal="20",$sporthal="",$plaats="",$cache="1") {  
    $code="<!-- Nevobo Feed ".nevobo_feed_versie." | http://www.masselink.net -->\n";
    // Alles naar de kleine letters om waarden te kunnen testen (behalve de url, deze blijft intact)
    $list_limit=strtolower($list_limit);
    $doel=strtolower($doel);
    $cache=strtolower($cache);
	
    // Limiten instellen
    $check_failure=false;
    $feed=str_replace('&amp;','&',$feed);
 
	//bepaal het feed type om verschillende stijlen te gebruiken | 1-stand, 2-uitslagen, 3-programma
	$nevobo_feedtype=0;
	if (stristr($feed, 'standen')) { $nevobo_feedtype=1;}
	if (stristr($feed, 'uitslagen')) { $nevobo_feedtype=2; }
	if (stristr($feed, 'programma')) { $nevobo_feedtype=3; }
    
    // Maak gebruik van de MagpieRSS Cache
   if ($cache!=0) {
        $cache_time=$cache*3600;
        define('MAGPIE_CACHE_AGE',$cache_time);
        define('MAGPIE_CACHE_ON',true); //true
    } else {
        define('MAGPIE_CACHE_ON',false);
    }
 
    if ($check_failure!==true) {
       @include_once(ABSPATH.WPINC.'/rss.php');
       @$array=fetch_rss($feed);

		
		 // Als er geen feed is gevonden, dan een foutmelding genereren
        if ($array=="") {
            $check_failure=1;
            $code.=nevobo_feed_fout("De opgegeven Feed kan niet worden verwerkt.","Nevobo Feed");
        } else {
        	
// Start of processing loop -----------------------------------------------------------------
			if ($aantal==null) {$aantal=6;}  
             $items=array_slice($array->items,0,$aantal);
			//rss table headers | 1-stand, 2-uitslagen, 3-Programma
            $code = '<table id="nevobo_feed">';
			switch ($nevobo_feedtype) {
					case 1:
						$code .= '<thead><tr><th>#     </th><th>Team </th><th>Wedstrijden </th><th>Punten </th></tr></thead><tbody>';
						$code .= '<tr>';
						foreach ($items as $item) {
							$standen = explode("<br />", $item[description]);
						    
						    foreach ($standen as $stand) {
						    	if (stristr($stand,'Team')) { continue; } 
						    	$regex = "#([0-9]?[0-9]). ([^\,]+), wedstr: ([^\,]+), punten: ([^\,]+)#";
								$replacement = "<tr><td>$1</td><td>$2</td><td>$3</td><td>$4</td></tr>";
								$code .= preg_replace($regex, $replacement, $stand);
							}
						
						}
						$code .= '</tr>';
					break;
					case 2: //Uitslagen
						$code .='<thead><tr><th>Datum   </th><th>Wedstrijd </th><th>Resultaat </th></tr></thead><tbody>';
						foreach ($items as $item) {
										//Datum
										$code .= '<tr>';
										$regex = "#[^ ]+ ([0-9]?[0-9]) (...) (....) [^ ]+ [^ ]+#";
										$replacement = '<td>$1 $2</td>';
										$code .= preg_replace($regex, $replacement, $item[pubdate]);
										//wedstrijd gegevens
										$regex = '#[^ ]+ ([^-]+) - ([^,]+), Uitslag: ([^,]+), Setstanden: (.*)#'; 
										$replacement = '<td>$1 - $2</td><td>$3 ($4)</td>';
										$check = preg_replace($regex, $replacement, $item[description]);
										if (stristr($check,"geen uitslagen")) {$code .= "<td><br>Er zijn nog geen uitslagen bekend<br><br></td><td></td><td></td>"; } else {
											$code .= $check;
										}
										$code .= '</tr>';
					    	 }
						         
					break;
					case 3: //Programma
						$code.='<thead><tr><th>Datum   </th><th>Tijd </th><th>Wedstrijd </th>';
						if ($sporthal==1) { $code .= '<th>Sporthal </th>';}
						if ($plaats==1) { $code .= '<th>Plaats </th>';}
						$code .= '</tr></thead><tbody>';
						 // Loopje voor alle items
							foreach ($items as $item) {
                						$titel=$item[title];
										//Tijden en wedstrijd
										$code .= '<tr>';
										$regex = '#([^ ]+) ([^ ]+) ([0-9]?[0-9]:[0-9][0-9]): (.*)#'; 
										$replacement = '<td>$1 $2</td><td>$3</td><td>$4</td>';
										$code .= preg_replace($regex, $replacement, $item[title]);
						
									//Speellocatie toevoegen
										$replacement = '';
										if ($sporthal==1 || $plaats==1) {
											$regex = "#Wedstrijd: (.*), Datum: (.*), Speellocatie: (.*), (.*)#";
											if ($sporthal==1) { $replacement .= "<td>$3</td>"; }
											if ($plaats==1) { $replacement .= "<td>$4</td>"; }
											$code .= preg_replace($regex, $replacement, $item[description]);
											}
										$code .= '</tr>';
										
					}
					break;
					default:
						$check_failure=1;
						$code.=nevobo_feed_fout("Het type feed kan niet worden bepaald. Betreft het wel een Nevobo feed?","Nevobo Feed");

            }
            $code .= "</tbody></table>";
        }
    }
// Stop of processing loop -----------------------------------------------------------------
    $code.="<a style='display:none;' href='http://masselink.net/nevobo-feed'><img src='http://masselink.net/tracker/nevobo-feed-pixel.png?".$_SERVER["SERVER_NAME"]."'></a>";
    $code.="<!-- einde van de nevobo feed -->";
    return $code;
}

// Fout rapportage
function nevobo_feed_fout($errorin,$plugin_name) {
    return "<p style=\"font-weight: bold;\">".$plugin_name.": ".__($errorin)."\n";
}
