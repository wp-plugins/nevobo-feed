=== Nevobo Feed ===
Contributors: Masselink
Tags: nevobo, feed, rss, competitie, volleybal, sport
Requires at least: 3.1
Tested up to: 3.4.2
Stable tag: 3.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Toon de standen, uitslagen en programma feeds in de juiste theme-stijl op je wordpress site.

== Description ==

[nevobo feed=<url van de feed>]

De plugin detecteert zelf welke feed het betreft. Plaats de volgende shortcode ergens op de wordpress site. 
De volgende extra opties zijn mogelijk:

aantal=x 
sporthal=1
plaats=1
cache=0

Bij Aantal=x is de x een opgegeven numerieke waarde die het aantal getoonde items limiteerd tot het gewenste aantal.
Sporthal=1 geeft de sporthal waar de wedstrijd wordt gespeeld weer in het programma overzicht. (Alleen bij een programmafeed!)
Plaats=1 geeft de plaats waar de wedstrijd wordt gespeeld weer in het programma overzicht. (Alleen bij een programmafeed!)
Met Cache=0 wordt het gebruik van RSS caching uitgeschakeld. Caching is standaard ingesteld op 3600 (1 uur)

voorbeeld: [nevobo feed="http://www.volleybal.nl/application/handlers/export.php?format=rss&type=team&programma=4106DS+4&iRegionId=5000" aantal=3 sporthal=1 plaats=1]

== Installation ==

Deze sectie is voor de instalatie van de plugin.

e.g.

1. Unzip de `nevobo-feed.zip` in de `/wp-content/plugins/` directory
1. Activeer de plugin in het 'Plugins' menu in WordPress
1. Gebruik de shortcode [nevobo feed=<url van de feed>] in je site

== Frequently Asked Questions ==

= Welke opties kan ik gebruiken =

sporthal=1 (alleen bij programma's)
plaats=1 (alleen bij programma's)
aantal=x (limiteer het aantal items)
cache=0 (schakel de cache uit)


== Screenshots ==

Er zijn geen screenshots beschikbaar. Klik <a href="http://www.masselink.net/nevobo-feed" taget="_blank">hier</a> om de plugin in werking te zien.

== Changelog ==

= 1.0.3 =
* Kleine Fix. Debug stond nog aan

= 1.0.2 =
* Kleine fix voor als er geen uitslag bekend is
* Kleine optimalizatie & Backlink

= 1.0.1 =
* Kleine fix in de uitlijning van de tabelheaders. (staan nu niet meer tegen elkaar)

= 1.0 =
* Bugfix in Uitslagen

= 0.9b =
* Eerste release

== Upgrade Notice ==

= 1.0.3 =
* Kleine Fix. Debug stond nog aan

== Donations ==

Het maken (en bijhouden) van plugins kost veel tijd. Donaties als waardering dan ook van harte welkom.
Zo kan ik in mijn (spaarzame) vrijetijd een biertje of kopje koffie drinken.

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SC7YX4S3PA79W">
<input type="image" src="https://www.paypalobjects.com/nl_NL/NL/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal, de veilige en complete manier van online betalen.">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form>

