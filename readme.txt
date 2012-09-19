=== Nevobo Feed ===
Contributors: Masselink
Tags: nevobo, feed, rss, competitie, volleybal, sport
Requires at least: 3.1
Donate link: http://massselink.net/nevobo-feed
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

1. Installeer door in wordpress een nieuwe plugin te zoeken met als naam "Nevobo feed"
2. Activeer de plugin in het 'Plugins' menu in WordPress
3. Gebruik de shortcode [nevobo feed=<url van de feed>] in je site

== Frequently Asked Questions ==

= Welke opties kan ik gebruiken =

sporthal=1 (zet sporthal aan in het programma overzicht)
plaats=1 (zet plaatsen aan in het programma overzicht)
aantal=x (limiteer het aantal items)
cache=x (0 = schakel de cache uit, 1 = kwartier, 2 = 30 minuten, 3 = 45 minuten etc)


== Screenshots ==

Er zijn geen screenshots beschikbaar. Klik <a href="http://www.masselink.net/nevobo-feed" taget="_blank">hier</a> om de plugin in werking te zien.

== Changelog ==

= 1.2 =
* De Nevobo stuurt uitslagen ook als deze nog niet bekend zijn. De plugin geeft nu de status "Uitslag nog niet bekend"

= 1.1 =
* Caching parameter per 15 minuten.

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

= 1.1 =
* Caching parameter per 15 minuten.

== Donations ==

Het maken (en bijhouden) van plugins kost veel tijd. Donaties als waardering dan ook van harte welkom.
Zo kan ik in mijn (spaarzame) vrijetijd een biertje of kopje koffie drinken.

<a href="masselink.net/nevobo-feed">klik hier oom naar de website te gaan en te doneren</a>

