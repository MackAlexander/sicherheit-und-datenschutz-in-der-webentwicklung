# database

## Abhängigkeiten zu anderen Modulen
- wp-admin/includes/upgrade.php

## Beschreibung
Dieses Modul steuert zentral alle Zugriffe auf die Wordpress Datenbank, die für die Verwendung des Plugins notwendig sind.
Es werden zwei neue Tabellen `sdw_security_access_log` und `sdw_security_bans` angelegt, sobald das Plugin deaktiviert wird. Beide Tabellen werden mit dem entsprechenden Prefix `$wpdb->prefix` angelegt, um Komplikationen bei mehreren Wordpress Instanzen zu verhindern.

Alle Datenbankoperationen werden über `wpdb` Klasse initiiert, um die Sicherheit der Website zu gewährleisten und unabhängig von der zu Grunde liegenden Datenbanktechnologie zu sein.

## Klassenvariablen
- **$access_log_table_name** : Name der Tabelle, in der Zugriffprotokolle gespeichert werden.
- **$bans_table_name**: Name der Tabelle, in der Sperrungen gespeichert werden.
- **$access_log_version**: Version der Tabelle, in der Zugriffprotokolle gespeichert werden.
- **$bans_version**: Version der Tabelle, in der Sperrungen gespeichert werden.
> **Achtung:** Werden Änderungen an der Struktur der beiden Tabellen vorgenommen, muss die Version der entsprechenden Tabelle um einen ganzzahligen Wert erhöht werden.

## Funktionen
> ### `get_access_log($limit, $offset)`
> **Ausführendes Ereignis:** Funktionsaufruf in `render_access_log()` des [admin-menu](admin-menu.md) Moduls
> 
> **Beschreibung:**
> Es werden mittels `$wpdb->get_results` und `$wpdb->prepare` `$limit` Einträge beginnend ab dem übergebenen `$offset` mit alle Daten der `sdw_security_access_log` Tabelle gelesen, absteigend nach dem Zeitpunkt sortiert und zurückgegeben. 
>
> Der Tabellenname wird dabei über `$wpdb->prefix` und die Variable `$access_log_table_name` zusammengesetzt.


## 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [cron.md](cron.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
