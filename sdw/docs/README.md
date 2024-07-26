# Technische Dokumentation

## Aufbau
Alle Module des `WPProtect` Plugins befinden sich in einem `modules` Ordner.

Das Plugin besteht aus den beiden Hauptmodulen [username-enumeration](username-enumeration.md) und dem [badrequest-tracker](badrequest-tracker.md). Diese rufen weitere Untermodule auf.

Jedes Modul verwendet den Namespace `WPProtect\Security` und besteht dabei aus einer eigenen Klasse. Funktionen der Module sind als statische Klassenfunktion deklariert.


## Wordpress Hooks
> **Achtung:** Verwendete Hooks und Funktionen könnten bei zukünftigen Updates als `deprecated` eingestuft werden. Aus diesem Grund sollten die hier aufgelisteten Hooks und Funktionen regelmäßig auf Aktualität geprüft werden.

|Hook|Datei|Funktion|
|---|---|---|
|[admin_menu](https://developer.wordpress.org/reference/hooks/admin_menu/) |[admin-menu.php](admin-menu.md)|add_menu()|
|[init](https://developer.wordpress.org/reference/hooks/init/) |[badrequest-tracker.php](badrequest-tracker.md)|check_ip_adress()|
|[wp_login_failed](https://developer.wordpress.org/reference/hooks/wp_login_failed/)|[badrequest-tracker.php](badrequest-tracker.md)|wp_login_failed()|
|[shutdown](https://developer.wordpress.org/reference/hooks/shutdown/)|[badrequest-tracker.php](badrequest-tracker.md)|shutdown()|
|[register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/)|[cron.php](cron.md)|schedule_daily_task()|
|[register_deactivation_hook](https://developer.wordpress.org/reference/functions/register_deactivation_hook/)|[cron.php](cron.md)|clear_scheduled_task()|
|[register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/)|[database.php](database.md)|activate()|
|[register_deactivation_hook](https://developer.wordpress.org/reference/functions/register_deactivation_hook/)|[database.php](database.md)|deactivate()|
|[plugins_loaded](https://developer.wordpress.org/reference/hooks/plugins_loaded/)|[database.php](database.md)|activate()|
|[register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/)|[username-enumeration.php](username-enumeration.md)|activate()|
|[register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/) |[username-enumeration.php](username-enumeration.md)|update_all_users_nickname()|
|[user_register](https://developer.wordpress.org/reference/hooks/user_register/)|[username-enumeration.php](username-enumeration.md)|user_register()|
|[profile_update](https://developer.wordpress.org/reference/hooks/profile_update/) |[username-enumeration.php](username-enumeration.md)|profile_update()|
|[user_profile_update_errors](https://developer.wordpress.org/reference/hooks/user_profile_update_errors/)|[username-enumeration.php](username-enumeration.md)|user_profile_update_errors()|
|[template_redirect](https://developer.wordpress.org/reference/hooks/template_redirect/) |[username-enumeration.php](username-enumeration.md)|disable_author_page()|
|[admin_notices](https://developer.wordpress.org/reference/hooks/admin_notices/) |[username-enumeration.php](username-enumeration.md)|admin_notices()|
|[the_author](https://developer.wordpress.org/reference/hooks/the_author/) |[username-enumeration.php](username-enumeration.md)|the_author()|
|[get_the_author_display_name](https://core.trac.wordpress.org/browser/tags/3.9.1/src/wp-includes/author-template.php#L116)|[username-enumeration.php](username-enumeration.md)|get_the_author_display_name()|
|[get_comment_author](https://developer.wordpress.org/reference/hooks/get_comment_author/)|[username-enumeration.php](username-enumeration.md)|get_comment_author()|
|[author_link](https://developer.wordpress.org/reference/hooks/author_link/)|[username-enumeration.php](username-enumeration.md)|author_link()|
|[login_errors](https://developer.wordpress.org/reference/hooks/login_errors/)|[username-enumeration.php](username-enumeration.md)|login_errors()|
|[rest_endpoints](https://developer.wordpress.org/reference/hooks/rest_endpoints/)|[username-enumeration.php](username-enumeration.md)|rest_endpoints()|
|[oembed_response_data](https://developer.wordpress.org/reference/hooks/oembed_response_data/)|[username-enumeration.php](username-enumeration.md)|oembed_response_data()|

## Erweiterung des Plugins
### Verwendung von Wordpress Hooks
```php
add_action('init', ['WPProtect\Security\<Klassenname>', '<Funktionssname>'], <Priorität>, <Anzahl an Parameter>);
```

### Aufruf von Funktionen
```php
require_once(dirname(__FILE__) . '/<dateiname>.php');
<Klassenname>::<Funktionssname>
```

## Performance Auswirkungen
Durch zusätzliche Datenbank Operationen wird die Performance einer Wordpress Installation von `WPProtect` negativ beeinflusst.
Diese Auswirkungen sind jedoch marginal.

Zur Bewertung wurde durch das `ab`-Tools des `apache2-utils` Paket ein Lasttest auf eine Wordpress Installation durchgeführt. Dazu wurden 100 Anfragen gesendet, von denen jeweils 10 gleichzeitig gesendet wurden und die durchschnittliche Antwortzeit ohne `WPProtect` und mit `WPProtect` betrachtet.

### Ergebnis
#### Ohne `WPProtect`
- **Anfragen pro Sekunde:** 73,87
- **Dauer pro Anfrage:** 135,378 ms
- **Dauer der längsten Abfrage:** 203 ms

#### Mit `WPProtect`
- **Anfragen pro Sekunde:** 70,48
- **Dauer pro Anfrage:** 141,887 ms
- **Dauer der längsten Abfrage:** 212 ms

Betrachtet man die Dauer pro Anfrage, ist eine Verschlechterung von etwa 4,8% bzw. 6,509 ms zu sehen. 

> **Achtung:** Dieser Test wurde auf eine lokale Wordpress Installation durchgeführt. Die effektiven Werte können je nach verwendetem Server abweichen, das Verhältnis der beiden Werte sollte jedoch bestehen bleiben. Ebenfalls ist es möglich, dass eine sehr hohe Anzahl an Einträgen die Performance des Plugins weiter verschlechtert.

## 🔗 Dokumentation der einzelnen Module
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [cron.md](cron.md)
- [database.md](database.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)

## 🔗 [README.md](../README.md)
