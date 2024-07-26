# database

## Abhängigkeiten
- wp-admin/includes/upgrade.php

## Beschreibung
Dieses Modul steuert zentral alle Zugriffe auf die Wordpress Datenbank, die für die Verwendung des Plugins notwendig sind.
Es werden zwei neue Tabellen `wpprotect_access_log` und `wpprotect_bans` angelegt, sobald das Plugin deaktiviert wird. Beide Tabellen werden mit dem entsprechenden Prefix `$wpdb->prefix` angelegt, um Komplikationen bei mehreren Wordpress Instanzen zu verhindern.

Alle Datenbankoperationen werden über `wpdb` Klasse initiiert, um die Sicherheit der Website zu gewährleisten und unabhängig von der zu Grunde liegenden Datenbanktechnologie zu sein.
Der Tabellenname jeder Operation wird dabei über `$wpdb->prefix` und die Variable `$access_log_table_name` bzw. `$bans_table_name` zusammengesetzt.

## Klassenvariablen
- **$access_log_table_name** : Name der Tabelle, in der Zugriffprotokolle gespeichert werden.
- **$bans_table_name**: Name der Tabelle, in der Sperrungen gespeichert werden.
- **$access_log_version**: Version der Tabelle, in der Zugriffprotokolle gespeichert werden.
- **$bans_version**: Version der Tabelle, in der Sperrungen gespeichert werden.
> **Achtung:** Werden Änderungen an der Struktur der beiden Tabellen vorgenommen, muss die Version der entsprechenden Tabelle um einen ganzzahligen Wert erhöht werden.

## Funktionen
> ### `🔓get_access_log($limit, $offset)`
> **Ausführendes Ereignis:** Funktionsaufruf in `render_access_log()` des [admin-menu](admin-menu.md) Moduls
> 
> **Beschreibung:**
> Es werden mittels `$wpdb->get_results` und `$wpdb->prepare` `$limit` Einträge beginnend ab dem übergebenen `$offset` mit alle Daten der `wpprotect_access_log` Tabelle gelesen, absteigend nach dem Zeitpunkt sortiert und zurückgegeben. 


> ### `🔓get_access_log_count()`
> **Ausführendes Ereignis:** Funktionsaufruf in `render_access_log()` des [admin-menu](admin-menu.md) Moduls
> 
> **Beschreibung:**
> Es wird mittels `$wpdb->get_results` ein `SELECT COUNT(*)` auf die `wpprotect_access_log` Tabelle ausgeführt und die Anzahl an Einträgen zurückgegeben. 


> ### `⛔get_bans($limit, $offset)`
> **Ausführendes Ereignis:** Funktionsaufruf in `render_bans()` des [admin-menu](admin-menu.md) Moduls
> 
> **Beschreibung:**
> Es werden mittels `$wpdb->get_results` und `$wpdb->prepare` `$limit` Einträge beginnend ab dem übergebenen `$offset` mit alle Daten der `wpprotect_bans` Tabelle gelesen, absteigend nach dem Zeitpunkt sortiert und zurückgegeben. 


> ### `⛔get_bans_count()`
> **Ausführendes Ereignis:** Funktionsaufruf in `render_bans()` des [admin-menu](admin-menu.md) Moduls
> 
> **Beschreibung:**
> Es wird mittels `$wpdb->get_results` ein `SELECT COUNT(*)` auf die `wpprotect_bans` Tabelle ausgeführt und die Anzahl an Einträgen zurückgegeben. 


> ### `📋append_access_log($ip_address, $url, $user_agent, $response_code, $classification, $points)`
> **Ausführendes Ereignis:** Funktionsaufruf in `shutdown()` und `wp_login_failed($username, $error)` des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Die übergebenen Parameter werden mittels `INSERT`, `$wpdb->prepare` und `$wpdb->query` in die Tabelle `wpprotect_access_log` eingefügt. 


> ### `🚫ban_ip($ip_address, $duration)`
> **Ausführendes Ereignis:** Funktionsaufruf in `shutdown()` und `wp_login_failed($username, $error)` des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Die übergebenen Parameter werden mittels `INSERT`, `$wpdb->prepare` und `$wpdb->query` in die Tabelle `wpprotect_bans` eingefügt. Der Beginn der Sperrung wird dabei über die SQL Funktion `NOW()` berechnet und das Ende der Sperre über die SQL Funktion `DATE_ADD(NOW(), INTERVAL %d DAY)` und der übergebenen `$duration` berechnet.


> ### `📈get_total_points($ip_address)`
> **Ausführendes Ereignis:** Funktionsaufruf in `shutdown()` und `wp_login_failed($username, $error)` des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Aus der Tabelle `wpprotect_access_log` werden mittels `$wpdb->prepare`, `$wpdb->get_var, `SELECT SUM(points)` die summierten Punkte der übergebenen `$ip_address` zurückgegeben. 


> ### `🗑️remove_old_logs($days)`
> **Ausführendes Ereignis:** Funktionsaufruf in `remove_old_entries()` des [cron](cron.md) Moduls
> 
> **Beschreibung:**
> Mittels `DELETE`, `$wpdb->prepare` und `$wpdb->query` werden alle Einträge der `wpprotect_access_log` Tabelle gelöscht, die älter als die übergebenen `$days` sind. Die Brechnung des exakten Datums erfolgt dabei über die Abfrage `WHERE time < NOW() - INTERVAL %d DAY` und den übergebenen `$days`.


> ### `🗑️remove_old_bans()`
> **Ausführendes Ereignis:** Funktionsaufruf in `remove_old_entries()` des [cron](cron.md) Moduls
> 
> **Beschreibung:**
> Mittels `DELETE` und `$wpdb->query` werden alle Einträge der `wpprotect_bans` Tabelle gelöscht, bei denen das Ende der Sperrung älter ist, als der jetzige Zeitpunkt. Die Brechnung erfolgt dabei über die Abfrage `WHERE end_time < NOW()`.


> ### `🔎is_ip_blocked($ip_address)`
> **Ausführendes Ereignis:** Funktionsaufruf in `check_ip_adress()` und `shutdown()` des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Es wird mittels `$wpdb->get_var`, `$wpdb->prepare` und der übergebenen `$ip_address` geprüft, ob ein aktueller Einträg in der `wpprotect_bans` Tabelle besteht, bei der das Enddatum über den aktuellen Zeitpunkt hinausgeht.
>
> Es wird nicht nur geprüft, ob es einen Eintrag in der Tabelle gibt, sondern auch das `end_time` Feld betrachtet. Da der Cron-Job zur Bereinigung der Tabellen nur einmal täglich läuft, wird so gewährleistet, dass Zugriffe auf die Seite wieder möglich sind, sobald eine Sperrung abgelaufen ist.


> ### `✔️activate()`
> **Ausführendes Ereignis:** [plugins_loaded](https://developer.wordpress.org/reference/hooks/plugins_loaded/) und [register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/)
> 
> **Beschreibung:**
> Sobald das Plugin aktiviert wird oder der Wordpress Hook `plugins_loaded` aufgerufen wird, wird mittels `get_site_option`, dem Tabellennamen `$access_log_table_name` und dem Zusatz `_db_version` geprüft, ob Unterschiede zu der angegebenen `$access_log_version` bestehen. Ist dies der Fall, wird die Funktion `install_log_table()` aufgerufen und die Struktur der Tabelle aktualisiert.
>
> Selbiges wird ebenfalls mit dem Tabellennamen `$bans_table_name` und der Version in `$bans_version` durchgeführt und entsprechend die Funktion `install_bans_table()` aufgerufen, sollten Unterschiede festgestellt werden.


> ### `❌deactivate()`
> **Ausführendes Ereignis:** [register_deactivation_hook](https://developer.wordpress.org/reference/functions/register_deactivation_hook/)
> 
> **Beschreibung:**
> Sobald das Plugin deaktiviert wird, werden beide durch das Plugin angelegte Tabellen `$access_log_table_name` und `$bans_table_name` mit entsprechendem Prefix über die SQL Funktion `DELETE TABLE IF EXISTS` gelöscht und die Versionen beider Tabellen über die Funktion `update_site_option` auf `0` gesetzt.
>
> **Achtung:** Wird das Plugin zu einem späteren Zeitpunkt wieder aktiviert, werden beide Tabellen wieder hergestellt. Alle Daten, die sich zum Zeitpunkt der Deaktivierung in diesen befunden haben, sind aber unwiderruflich verloren! Sollten diese Daten später benötigt werden, müssen die Daten vor der Deaktivierung des Plugins gesichert werden!


> ### `➕install_log_table()`
> **Ausführendes Ereignis:** Funktionsaufruf in activate()
> 
> **Beschreibung:**
> Diese Funktion erstellt, bzw. aktualisiert die Struktur der Tabelle `$access_log_table_name` mit entsprechendem Prefix. Dazu wird zunächst der `charset_collate` über die Funktion `$wpdb->get_charset_collate()` bestimmt und die Tabellenstruktur angegeben. Die Tabelle wird dann über die Funktion `dbDelte` erstellt und über die Funktion `update_site_option` die `_db_version` auf den Wert der `$access_log_version` Variable gesetzt.
>
> Die Struktur der Tabelle ist die folgende:
> |Spaltenname|Datentyp|Zusatz|Beschreibung|
> |---|---|---|---|
> |time|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP NOT NULL|Zeitpunkt der Anfrage|
> |ip_address|VARCHAR(32)|NOT NULL|IP Adresse der Anfrage|
> |url|VARCHAR(128)|NOT NULL|Angefragte URL|
> |user_agent|VARCHAR(128)|NOT NULL|Benutzer User Agent der Anfrage|
> |response_code|INT|NOT NULL|HTTP Responsecode der Anfrage|
> |classification|VARCHAR(128)|NOT NULL|Klassifizierung der Anfrage des [classifier](classifier.md) Moduls|
> |points|DECIMAL|NOT NULL|Vergebe Punkte der Anfrage des [classifier](classifier.md) Moduls|


> ### `➕install_bans_table()`
> **Ausführendes Ereignis:** Funktionsaufruf in activate()
> 
> **Beschreibung:**
> Diese Funktion erstellt, bzw. aktualisiert die Struktur der Tabelle `$bans_table_name` mit entsprechendem Prefix. Dazu wird zunächst der `charset_collate` über die Funktion `$wpdb->get_charset_collate()` bestimmt und die Tabellenstruktur angegeben. Die Tabelle wird dann über die Funktion `dbDelte` erstellt und über die Funktion `update_site_option` die `_db_version` auf den Wert der `$bans_version` Variable gesetzt.
>
> Die Struktur der Tabelle ist die folgende:
> |Spaltenname|Datentyp|Zusatz|Beschreibung|
> |---|---|---|---|
> |ip_address|VARCHAR(32)|NOT NULL|Gesperrte IP Adresse|
> |begin_time|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP NOT NULL|Beginnzeitpunkt der Sperrung|
> |end_time|TIMESTAMP|NOT NULL|Endzeitpunkt der Sperrung|


## 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [Technische README.md](README.md)
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [cron.md](cron.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
