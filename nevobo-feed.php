<?php
/*
Plugin Name: Nevobo Feed
Plugin URI: http://masselink.net/nevobo-feed
Description: Toon de RSS feeds van de Nevobo volleybal competitie in stijl op je website. Gebruik shortcode: [nevobo feed="url"] 
Version: 1.3.4
Author: Harold Masselink
Author URI: http://Masselink.net
*/
define('nevobo_feed_versie','1.3.4');
add_shortcode('nevobo','nevobo_shortcode');

// Nevobo Feed shortcode toevoegen
function nevobo_shortcode($paras="",$content="") {
    extract(shortcode_atts(array('feed'=>'','aantal'=>'','sporthal'=>'','plaats'=>'','cache'=>'', 'team'=>'', 'ical'=>''),$paras));
    return get_nevobo($feed,$aantal,$sporthal,$plaats,$cache,$team,$ical,'sc');
}


// Nevobo Feed Shortcode
function nevobo_feed($feed,$add_paras) {
    // van de parameters
        $sporthal=get_feed_parameters($add_paras,"sporthal");
		$plaats=get_feed_parameters($add_paras,"plaats");
        $cache=get_feed_parameters($add_paras,"cache");
        $team=get_feed_parameters($add_paras,"team");
        $ical=get_feed_parameters($add_paras,"ical");

    // Trap de feed af
    echo get_nevobo($feed,$aantal,$sporthal,$plaats,$cache,$team,$ical);
    return;
}	

// Feed list code
function get_nevobo($feed,$aantal="20",$sporthal="",$plaats="",$cache="4",$team="",$ical="") {  
    $code="<!-- Nevobo Feed ".nevobo_feed_versie." | http://www.masselink.net -->\n";
    // Alles naar de kleine letters om waarden te kunnen testen (behalve de url, deze blijft intact)
    $list_limit=strtolower($list_limit);
	
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
        $cache_time=$cache*900;
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
			$team='krekkers';
			if ($aantal==null) {$aantal=6;}
			if ($ical==null) {$ical=1;}  
             $items=array_slice($array->items,0,$aantal);
			//rss table headers | 1-stand, 2-uitslagen, 3-Programma
            $code .= '<table id="nevobo_feed">';
			switch ($nevobo_feedtype) {
					case 1:
						$code .= '<thead><tr><th>#     </th><th>Team </th><th>Wedstrijden </th><th>Punten </th></tr></thead><tbody>';
						$code .= '<tr>';
						foreach ($items as $item) {
							$standen = explode("<br />", $item[description]);
							$i=0;
						    $len = count($standen);
						    foreach ($standen as $stand) {
						    	if (($i==0) OR ($i==($len-1))) { $i++; continue; } 
						    	$i++;
						    	$regex = "#([0-9]?[0-9]). ([^\,]+), wedstr: ([^\,]+), punten: ([^\,]+)#";
								preg_match($regex, $stand, $groep);
								if ($team!="") if (stristr($groep[2],$team)) $code .= "<tr class='nevobo_highlight'>"; else $code .= "<tr>";
								$code .= "<td>".$groep[1]."</td><td>".$groep[2]."</td><td>".$groep[3]."</td><td>".$groep[4]."</td></tr>";
							}
						
						}
						$code .= '</tr>';
					break;
					case 2: //Uitslagen
						$code = '<table id="nevobo_feed">';
						$code .='<thead><tr><th>Datum   </th><th>Thuisploeg </th><th></th><th>Uitploeg</th><th>Resultaat </th></tr></thead><tbody>';
						foreach ($items as $item) {
										//Datum
										$code .= '<tr>';
										$regex = '#[^ ]+ ([0-9]?[0-9]) (...) (....) [^ ]+ [^ ]+#';
										preg_match($regex, $item[pubdate], $groep);
										$code .= "<td>".$groep[1]." ".$groep[2]."</td>";
										//wedstrijd gegevens
										$regex = '#Wedstrijd: ([\w\W\s\S\d\D]+) - ([\w\W\s\S\d\D]+), Uitslag: ([^,]+)*, Setstanden: ?(.*)#'; 
										preg_match($regex, $item[description], $groep);
										if ($team!="") if (stristr($groep[1],$team)) $groep[1] = "<span class='nevobo_highlight'>".$groep[1]."</span>";
										if ($team!="") if (stristr($groep[2],$team)) $groep[2] = "<span class='nevobo_highlight'>".$groep[2]."</span>";
										$check = '<td>'.$groep[1].'</td><td> - </td><td> '.$groep[2].'</td><td>'.$groep[3];
										if ($groep[4]!='') { 
											$check .= '   <img src="'.get_site_url().'/wp-content/plugins/nevobo-feed/images/sets_grey.png" title="'.$groep[4].'"></td>';
										} else {
											$check .= 'onbekend';
										}
										if (stristr($check,"geen uitslagen")) {$code .= "<td><br>Er zijn nog geen uitslagen bekend<br><br></td><td></td><td></td>"; } else {
											$code .= $check;
										}
										$code .= '</tr>';
					    	 }
						         
					break;
					case 3: //Programma
						$code.='<thead><tr><th>Datum   </th><th>Tijd </th><th>Thuisploeg </th><th></th><th>Uitploeg</th>';
						if ($sporthal==1) { $code .= '<th>Sporthal </th>';}
						if ($plaats==1) { $code .= '<th>Plaats </th>';}
						$code .= '</tr></thead><tbody>';
						 // Loopje voor alle items
							foreach ($items as $item) {
                						$titel=$item[title];
										//Tijden en wedstrijd
										$code .= "<tr>";
										$regex = "#([^ ]+) ([^ ]+) ([0-9]?[0-9]:[0-9][0-9]): (.*) - (.*)#";
										preg_match($regex, $item[title], $groep); 
										if ($team!="") if (stristr($groep[4],$team)) $groep[4] = "<span class='nevobo_highlight'>".$groep[4]."</span>";
										if ($team!="") if (stristr($groep[5],$team)) $groep[5] = "<span class='nevobo_highlight'>".$groep[5]."</span>";
										$code .= "<td>".$groep[1]." ".$groep[2]."</td><td>".$groep[3]."</td><td>".$groep[4]."</td><td> - </td><td>".$groep[5]."</td>";
										
									//Speellocatie toevoegen
										$groep = '';
										if ($sporthal==1 || $plaats==1) {
											$regex = "#Wedstrijd: (.*), Datum: (.*), Speellocatie: (.*), (.*)#";
											preg_match($regex, $item[description], $groep);
											if ($sporthal==1) { $code .= "<td>".$groep[3]."</td>"; }
											if ($plaats==1) { $code .= "<td>".$groep[4]."</td>"; }
											}
										$code .= '</tr>';
					}
					break;
					default:
						$check_failure=1;
						$code.=nevobo_feed_fout("Het type feed kan niet worden bepaald. Betreft het wel een Nevobo feed?","Nevobo Feed");

            }
            $code .= "</tbody></table>";
            if (($nevobo_feedtype==3) && ($ical==1)) {
            	$icalfeed = str_replace("format=rss", "format=ical", $feed);
            	if (stristr($icalfeed,"poule")) { $code .= '<img align="absmiddle" src="'.get_site_url().'/wp-content/plugins/nevobo-feed/images/ical_grey.png"> <a href="'.$icalfeed.'">Voeg het volledige programma van de poule aan je agenda toe</a><br /><br />'; 
            	} else {
            		$code .= '<img align="absmiddle" src="'.get_site_url().'/wp-content/plugins/nevobo-feed/images/ical_grey.png"> <a href="'.$icalfeed.'">Voeg het volledige programma van het team aan je agenda toe</a><br /><br />';
            	}

        }
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
