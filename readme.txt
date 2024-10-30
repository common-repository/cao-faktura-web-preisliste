=== CAO Faktura Web Preisliste ===
Contributors: mawiti
Tags: preisliste,web,shop,cao,faktura,handelssoftware,warentwirtschaft,commerce
Donate link: https://markus-winter.ch/markus-winter/bankverbindung/
Requires at least: 4.0
Tested up to: 6.1.1
Stable tag: 1.1.17
License: GPLv2 or later
Licence URI: http://www.gnu.org/licenses/gpl-2.0.html

CAO Faktura Preisliste auf WordPress Webseite anzeigen.



== Description ==
Mittels Shortcode werden die Preise aus Ihrer eigenen CAO Faktura Datenbank nach Kathegorien gruppiert auf einer WordPress Webseite angezeigt.

Folgender ShortCode zeigt die Preise der Kategorie 21 und allen darunter liegenden Kathegorien auf der Webesite an:

[nspl kat="21"]

Erstellen Sie im Warenwirtschaftssystem  CAO Faktura Kategorien und zeigen Sie die Preise entsprechend der Kategorie auf Ihrer Webseite an. Auch die Unterkategorien werden gelistet.

Ein Beispiel der Anzeige der Preise sehen Sie auf der Webseite Markus-Winter.ch unter Anderem bei den Granittischen.
https://markus-winter.ch/standbeine/natursteine/granittische/granittisch-modell-purist/



== Frequently Asked Questions ==
Kann ich die Preise einer beliebigen CAO Faktura Datenbank anzeigen lassen?
   Ja, im Plugin kann die gewünschte CAO Faktura Datenbank angegeben werden.

Ich habe kein CAO Faktura, kann ich mit dem Plugin dennoch Preise auf der Webseite anzeigen?
   Ja, die Preise können anstatt in CAO Faktura in einer Excel Tabelle erfasst werden und dann als CSV Datei gespeichert werden. Das Plugin verwendet dann die Preise basierend auf den CSV Dateien.

Warum soll ich dieses Plugin verwenden und die Preise nicht direkt auf der Webseite eintippen?
   Weil Sie möglicherweise die Eine oder Andere Kategorie an mehreren Stellen Ihrer Webseite verwenden möchten und ein Aktualisieren der Preise in CAO Faktura durch das Plugin automatisch an allen Stellen aktualisiert wird.

Wo bekomme ich Hilfe?
   Bei Kontakt@Markus-Winter.ch
   Direkt auf der Seite https://markus-winter.ch/faktenwissen/internet/cao-faktura-preisliste-im-web/preiskategorie-einfuegen/


== Screenshots ==
1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png


==  3rd party service/External Service ==
This Plugin uses an external Service for Database Authentification under https://preise.naturalstone.ch.
The Plugin only receives some Data from the link above to make the Connection to the central CAO Database. It is just a http-request (using the wordpress-api functions) for receiving the credentials. No further Data would be transfered or stored. If the url is not available, no Pricelist will be shown.
If you don't want to use the external Authentification you can set your own credentials in the setting tab of the Plugin. If so change the connection type from "internal" to "mysql".

---german---
Dieses Plugin verwendet zur Datenbankverbindung einen externen Service unter https://preise.naturalstone.ch/
Der Service dient lediglich zur Authentifizierung der Datenbank. Hierbei werden keine weiteren Daten gespeichert oder übermittelt. Es wird ein simpler http-request (über die wordpress-api Funkionen) durchgeführt um auf die Datenbank zugreifen zu können.
Sollte dieser Weg unerwünscht sein, kann über die Plugin-Einstellung auch auf eigene Zugangsdaten umgestellt werden. Dazu muss der Connectiontype von internal auf mysql gesetzt werden.
