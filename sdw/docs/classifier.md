# classifier

## Abhängigkeiten zu anderen Modulen
- [config](config.md)
- [suspicious-links](suspicious-links.md)

## Beschreibung
Dieses Modul analysiert und klassifiziert eingehende Anfragen anhand ihrer `URL`, dem `User Agent` und dem `HTTP Statuscode`, um potenziell schädliche Aktivitäten zu erkennen. Dabei wird jeder Anfrage eine entsprechende Klassifizierung und eine Punktzahl zugewiesen, welche in dem [config](config.md) Modul festgelegt ist und die Schwere des potenziellen Risikos wiederspiegelt.


## Funktionen
> ### `classify_request($uri, $user_agent, $status_code)`
> **Ausführendes Ereignis:** Funktionsaufruf in shutdown() des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Über die Funktion `preg_match` wird mittels regulären Ausdrücken geprüft, ob der übergebene `$user_agent` oder die übergebene `$uri` bestimmte Wörter beinhalten. Als letzte Überprüfung wird geschaut, ob der übergebene `$status_code` 404 entspricht.
> Ist eine der Abfragen erfolgreich, wird die entsprechende Klassifizierung zurückgegeben. Sollte kein Fall zutreffend sein und es sich um eine normale Anfrage handeln, wird die Klassifizierung `normal` zurückgegeben. Die Abfragen sind dabei absteigend ihrem Risiko oder potentiellen Schaden sortiert. Sollte einer dieser Fälle greifen, wird die Funktion frühzeitig verlassen, um so Ressourcen zu schonen.
> 
> Die folgenden Fälle wurden dabei berücksichtigt:
> |Fall|Klassifizierung|Notiz|
> |---|---|---|
> |`$uri` beinhaltet `/xmlrpc.php`|xmlrpc||
> |`$uri` beinhaltet `.sql`|database-access||
> |`$uri` beinhaltet `/installer-log.txt`|installer-log||
> |`$user_agent` beinhaltet `/wpscan.com`|wp-scan||
> |`$uri` beinhaltet `/wp-config.php`|config-grabber||
> |`$uri` beinhaltet einen in [suspicious-links](suspicious-links.md) gelisteten Link|suspicious-plugin|Die Abfrage wird erst ausgeführt, sobald die `$uri` `/wp-content/plugins/` beinhaltet, um Ressourcen zu sparen.|
> |`$status_code` ist `404`|404-not-found||


> ### `calculate_points($classification)`
> **Ausführendes Ereignis:** Funktionsaufruf in shutdown() des [badrequest-tracker](badrequest-tracker.md) Moduls
> 
> **Beschreibung:**
> Anhand der zuvor zugewiesenen und als Parameter übergebene Klassifizierung wird die entsprechende Punktzahl des [config](config.md) Moduls zurückgegeben.
>
> Ein Funktionsaufruf und Punktevergabe erfolgt nur, wenn die `$classificiation` nicht `normal` ist.
> Zusätzlich zu den, in der Funktion `classify_request($uri, $user_agent, $status_code)`, vergebenen 7 Klassifizierungen wird auch die Punktzahl für die Klassifizierung `failed-login` vergeben, welche in der `wp_login_failed($username, $error)` Funktion des [badrequest-tracker](badrequest-tracker.md) Moduls vergeben wird.

## 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [database.md](database.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
