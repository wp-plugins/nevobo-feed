=== Nevobo Feed ===
Contributors: masselink
Tags: nevobo, feed, rss, competitie, volleybal, sport
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 3.4.1
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

Niet beschikbaar

== Changelog ==

= 0.9b =
* Eerste release

== Upgrade Notice ==

= 0.9b =
* Eerste release