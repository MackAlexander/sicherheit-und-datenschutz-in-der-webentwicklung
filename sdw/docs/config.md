# Beschreibung
Dieses Modul dient als generelle Konfigurationsdatei des Plugins. Es definiert Konstanten zur Steuerung des Verhaltens und der Grenzwerte für sicherheitsrelevante Aktionen sowie der vergebenen Punkte für verschiedene bösartigen Anfragen.

# Konstanten
| Name | Beschreibung | Standardwert |
|---|---|---|
| `DEFAULT_NAME` | Der Standardname, der verwendet wird, um den Loginnamen der Benutzer zu verschleiern, wenn diese keinen eigenen Nicknamen setzen. | `Anonymous` |
| `LOGS_PER_PAGE` | Die maximale Anzahl der Protokolleinträge, die pro Seite im [admin-menu](admin-menu.md) angezeigt werden. | 10 |
| `BAN_DURATION` | Die Dauer in Tagen, für die ein Benutzer gesperrt wird. | 7 |
| `CLEAN_DURATION` | Die Dauer in Tagen, nach der Protokolleinträge bereinigt werden. | 30 |
| `MAX_POINTS` | Die maximale Anzahl der Punkte, die ein Benutzer haben kann, bevor eine Sperrung erfolgt. | 50 |
| `DATABASE_ACCESS_POINTS` | Punkte, die für Zugriffe auf die Datenbank vergeben werden. | 15 |
| `XMLRPC_POINTS` | Punkte, die für XML-RPC-Vorgänge vergeben werden. | 15 |
| `WP_SCAN_POINTS` | Punkte, die für WP-Scan als "User Agent" vergeben werden. | 10 |
| `INSTALLER_LOG_POINTS` | Punkte, die für Zugriffe auf Installationsprotokolle vergeben werden. | 10 |
| `CONFIG_GRAPPER_POINTS` | Punkte, die für Zugriffe auf  Konfigurationssammlungen vergeben werden. | 5 |
| `SUSPICIOUS_PLUGIN_POINTS` | Punkte, die für Zugriffe auf verdächtige Plugins vergeben werden. | 5 |
| `NOT_FOUND_POINTS` | Punkte, die für Zugriffe auf nicht gefundene Seiten vergeben werden. | 1 |
| `FAILED_LOGIN_POINTS` | Punkte, die für fehlgeschlagene Anmeldeversuche vergeben werden. | 1 |


# 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [cron.md](cron.md)
- [database.md](database.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
