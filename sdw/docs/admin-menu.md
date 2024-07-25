# admin_menu

## Abhängigkeiten zu anderen Modulen
- [config](config.md)

## Beschreibung
Dieses Modul fügt ein Admin-Menü im Wordpress-Admin-Bereich hinzu, in dem Protokolleinträge und Sperrungen eingesehen werden können.
>
> **Achtung:** Alle angezeigten Inhalte dieses Moduls werden über die Funktionen `esc_html()` und `sanitize_text_field()` abgesichert, um das unerwünschte Ausführen von bösartigem Code zu unterbinden.

## Funktionen
> ### `add_menu()`
> **Ausführendes Ereignis:** [admin_menu](https://developer.wordpress.org/reference/hooks/admin_menu/) 
> 
> **Beschreibung:**
> Diese Funktion ruft die Funktion `add_management_page` auf und fügt einen neuen Menüpunkt namens `SDW` im Werkzeuge-Menü des WordPress-Admin-Bereichs hinzu. 
> Als Callback wird dabei die Funktion `render_management_page()` hinterlegt.
>
> **Achtung:** Der Menüpunkt ist nur für Benutzer sichtbar, die über die [manage_options](https://wordpress.org/documentation/article/roles-and-capabilities/#manage_options)  Rechte verfügen.

> ### `render_management_page()`
> **Ausführendes Ereignis:** Funktionsaufruf in `add_menu()`
> 
> **Beschreibung:**
> Nach einer erfolgreichen Rechteprüfung mittels `current_user_can` und der Berechtigung `manage_options` wird eine Navigationsleiste mit zwei Tabs aufgezeigt.
> 
> Der erste - standardmäßig ausgewählte Tab - zeigt das `Access Log` an. Wird dieser ausgewählt, wird die Funktion `render_access_log()` aufgerufen.
> 
> Der zweite Tab zeigt aktuelle `Bans` an. Wird dieser ausgewählt, wird die Funktion `render_bans()` aufgerufen.

> ### `render_access_log()`
> **Ausführendes Ereignis:** Der SDW Menüpunkt wird geöffnet oder der Tab `Access Log` wird ausgewählt.
> 
> **Beschreibung:**
> Aus dem [config](config.md) Modul wird der Wert für die gewünschte Anzahl an Einträgen pro Seite entnommen.
> Ebenfalls werden mit der `get_access_log_count` Funktion des [database](database.md) Moduls die Anzahl an Protokolleinträgen geladen.
> Ist diese Zahl größer als die definierte Anzahl an Einträgen pro Seite, wird durch Teilen der Einträge pro Seite durch die Gesamteinträge die Seiten an Protokolleinträgen berechnet.
>
> Die neusten Protokolleinträge werden durch die Funktion `get_access_log` des [database](database.md) Moduls mit dem entsprechenden Offset und Anzahl in einer Tabelle mit dem Tabellenkopf `Timestamp`, `IP`, `URL`, `User Agent`, `Response Code`, `Classification` und `Points` angezeigt.
> Unter der Tabelle befinden sich Links, um die verschiedene Seiten an Logs durchzublättern, sofern es mehr Einträge gibt, als auf einer Seite angezeigt werden sollen.
> Dabei werden immer nur die Logs für die jeweilige Seite geladen, um den Ressourcenverbrauch so gering wie möglich zu halten.

> ### `render_bans()`
> **Ausführendes Ereignis:** Der Tab `Bans` wird ausgewählt.
> 
> **Beschreibung:**
> Aus dem [config](config.md) Modul wird der Wert für die gewünschte Anzahl an Einträgen pro Seite entnommen.
> Ebenfalls werden mit der `get_bans_count` Funktion des [database](database.md) Moduls die Anzahl an Bans geladen.
> Ist diese Zahl größer als die definierte Anzahl an Einträgen pro Seite, wird durch Teilen der Einträge pro Seite durch die Gesamteinträge die Seiten an Bans berechnet.
>
> Die neusten Bans werden durch die Funktion `get_bans` des [database](database.md) Moduls mit dem entsprechenden Offset und Anzahl in einer Tabelle mit dem Tabellenkopf `IP`, `Begin` und `End` angezeigt.
> Unter der Tabelle befinden sich Links, um die verschiedene Seiten an Logs durchzublättern, sofern es mehr Einträge gibt, als auf einer Seite angezeigt werden sollen.
> Dabei werden immer nur die Bans für die jeweilige Seite geladen, um den Ressourcenverbrauch so gering wie möglich zu halten. 

## 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [cron.md](cron.md)
- [database.md](database.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
