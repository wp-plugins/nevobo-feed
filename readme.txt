=== Nevobo Feed ===
Contributors: Masselink
Tags: nevobo, feed, rss, competitie, volleybal, sport
Requires at least: 3.1
Donate link: http://massselink.net/nevobo-feed
Tested up to: 4.0
Stable tag: 4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Toon de standen, uitslagen en programma feeds in de juiste theme-stijl op je wordpress site.

== Description ==

[nevobo feed=<url van de feed>]

De plugin detecteert zelf welke feed het betreft. Plaats de shortcode ergens op de wordpress site.
Via het admin paneel zijn algemene instellingen te wijzigen. Indien in de shortcodes ook waarden worden gespecificeerd hebben deze voorrang op de instellingen in het dashboard. 

De volgende extra opties zijn mogelijk:

aantal=x 
sporthal=1
plaats=1
cache=0
ical=0
sets=1
vereniging='<verenigingsnaam of een deel ervan>'

Aantal=x: De x is een opgegeven numerieke waarde die het aantal getoonde items limiteerd tot het gewenste aantal.
Sporthal=1: geeft de sporthal waar de wedstrijd wordt gespeeld weer in het programma overzicht. (Alleen bij een programmafeed!)
Plaats=1: geeft de plaats waar de wedstrijd wordt gespeeld weer in het programma overzicht. (Alleen bij een programmafeed!)
Cache=0: Het gebruik van RSS caching uitgeschakeld. Caching is standaard ingesteld op 1 uur. Cache = x. 1 = kwartier, 2 = 30 minuten, 3 = 45 minuten etc.
ical=0: Verberg de ical programma link bij een programma.
sets=0: Verberg de setstanden bij een uitslag 
vereniging=<verenigingsnaam>: De plugin markeert de regel bij de stand, en de naam bij het programma en de uitslagen met de class="nevobo_highlight".

voorbeeld: [nevobo feed="http://www.volleybal.nl/application/handlers/export.php?format=rss&type=team&programma=4106DS+4&iRegionId=5000" aantal=3 sporthal=1 plaats=1]

== Installation ==

1. Installeer door in wordpress een nieuwe plugin te zoeken met als naam "Nevobo feed"
2. Activeer de plugin in het 'Plugins' menu in WordPress
3. Gebruik de shortcode [nevobo feed=<url van de feed>] in je site

== Frequently Asked Questions ==

= Welke opties kan ik gebruiken? =

sporthal=1 (zet sporthal aan in het programma overzicht)
plaats=1 (zet plaatsen aan in het programma overzicht)
aantal=x (limiteer het aantal items)
cache=x (0 = schakel de cache uit, 1 = kwartier, 2 = 30 minuten, 3 = 45 minuten etc)
ical=0 (0 schakel de ical link uit)
sets=1 (toon setstanden door op een plaatje te hooveren)

= Welke uitslagen kan ik tonen? =
Het is mogelijk de uitslagen van de poule of de uitslagen van het team weer te geven.
De gekozen feed bepaald de getoonde uitslagen

== Screenshots ==

Er zijn geen screenshots beschikbaar. Klik <a href="http://www.masselink.net/nevobo-feed" taget="_blank">hier</a> om de plugin in werking te zien. Ook <a href="http://krekkers.nl" taget="_blank">Krekkers.nl</a> maakt gebruik van de plugin.

== Changelog ==

= 1.6 =
* Maximale lengte van verenigingsnamen. (Mouseover-tooltip voor volledige naam)
* Code Cleanup

= 1.5.1 =
* Wordpress 4.0 support

= 1.5 =
* Bepaal de highlightkleur nu zelf vanuit het admin menu
* Betere afbeeldingen (Sets/Cal)
* Bugfixes met parameters
* Bugfix met Sporthal en plaats
* Voorbereiding voor GoogleMaps links

= 1.4.3 =
* RSS special characters fix. (Thanks: Bossdwarf)

= 1.4.2 =
* fix waarbij de set afbeelding werd getoond zelfs als deze uit gezet was.

= 1.4.1 =
* fix voor veranderingen door de editor met &, &amp; en &amp;amp;

= 1.4 =
* Instellingen configureerbaar in het dashboard.
* Team highlighting

= 1.3.4 =
* Set standen worden nu getoond als er met de muis over het plaatje wordt gehoverd
* Nieuwe indeling in de tabbelen voor programma en uitslagen.
* ical link veranderd automatisch naar een team of poule programma
* Nieuwe graphics

= 1.3.0 =
* Bugfix als de teamnaam een "-" bevat zoals Set-Up'65. (Regular expression herschreven) 
* Team accentuering. (afwijkende css styling voor de verenigng teams)

= 1.2.2 =
* Toon ical link voor het volledige programma om te importeren in je eigen agenda.

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

= 1.6 =
* Maximale lengte van verenigingsnamen. (Mouseover-tooltip voor volledige naam)
* Code Cleanup

== Donations ==

Het maken (en bijhouden) van plugins kost veel tijd. Donaties als waardering dan ook van harte welkom.
Zo kan ik in mijn (spaarzame) vrijetijd een biertje of kopje koffie drinken.

<a href="masselink.net/nevobo-feed">klik hier oom naar de website te gaan en te doneren</a>

