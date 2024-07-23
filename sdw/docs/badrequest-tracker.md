# Beschreibung
Dieses Modul überwacht HTTP-Anfragen in Echtzeit, klassifiziert sie auf ihre Sicherheitsrelevanz hin und ergreift entsprechende Maßnahmen, wie z.B. das Blockieren von IP-Adressen bei verdächtigem Verhalten oder das Protokollieren fehlgeschlagener Login-Versuche.

## Funktionen
> ## `Nutzersperrungen`
>    #### Sperrungen nach Anzahl bösartiger Requests
>    - Bösartige Requests werden getrackt und in einer Tabelle gespeichert. Das Punktesystem des Plugins wertet den Request aus. Nach einer gewissen bösartigen Anzahl von Requests wird der Nutzer gesperrt.
>    #### Entsperrung nach Zeit
>    ##### Löschen der ältesten Tabelleneinträge:
>    - Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt.

> ## `Punktesystem`
>    #### Punkteverteilung
>    - Je nach Menge der Requests
>    #### Punktegewichtung
>    - Je nach Schwere des Requests

> ## `Punktereset`
> 
>    - Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt. Die Punkte, die der Nutzer vor den 30 Tagen auf seinem Punktekonto hat, sind gelöscht und sofern die gespeicherten Punkte die Sperrpunktzahl nicht überschreiten, bleibt der Nutzer entsperrt, bzw. wird entsperrt beim Unterschreiten der Sperrpunktzahl.

# 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [admin_menu.md](admin_menu.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [cron.md](cron.md)
- [database.md](database.md)
- [suspicious_links.md](suspicious_links.md)
- [username-enumeration.md](username-enumeration.md)
