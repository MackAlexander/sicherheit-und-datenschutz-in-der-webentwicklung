# config

> [!TIP]
> **🔍 Beschreibung**
> 
> Dieses Modul definiert verschiedene Konstanten zur Steuerung des Verhaltens und der Schwellenwerte für sicherheitsrelevante Aktionen innerhalb des Plugins. Diese Konstanten helfen bei der Verwaltung von Sicherheitsmaßnahmen wie Protokollierung, Sperrungen und Bewertungen verdächtiger Aktivitäten.

## Funktionen

> [!WARNING]
>
> **📚 Inhalt**
> - **⚙️ Standardwerte**
>   - Standardbenutzername für anonyme Nutzer
>   - Anzahl der Protokolleinträge pro Seite
> - **⛔ Sperrdauer und Punktesystem**
>   - Dauer einer Nutzersperrung
>   - Zeitraum zur Bereinigung alter Einträge
>   - Maximale Punktzahl vor Sperrung
> - **📊 Punkteverteilung mit unterschiedlicher Pnktzahl für**
>   - Datenbankzugriff
>   - XML-RPC Zugriffe
>   - WordPress Scan Ereignisse
>   - Installer-Log Ereignisse
>   - Konfigurations-Grabber Ereignisse
>   - verdächtige Plugin Ereignisse
>   - nicht gefundene Ressourcen
>   - fehlgeschlagene Anmeldungen

> [!IMPORTANT]
>
> ### ⚙️ Standardwerte
>   - Standardbenutzername für anonyme Nutzer: `Anonymous`
>   - Anzahl der Protokolleinträge pro Seite: `10`

> [!IMPORTANT]
>
>    #### ⛔ Sperrdauer und Punktesystem
>   - Dauer einer Nutzersperrung: `7` Tage
>   - Zeitraum zur Bereinigung alter Einträge: `30` Tage
>   - Maximale Punktzahl vor Sperrung: `50`
>   - Punkte für Datenbankzugriff: `15`
>   - Punkte für XML-RPC Zugriffe: `15`
>   - Punkte für WordPress Scan Ereignisse: `10`
>   - Punkte für Installer-Log Ereignisse: `10`
>   - Punkte für Konfigurations-Grabber Ereignisse: `5`
>   - Punkte für verdächtige Plugin Ereignisse: `5`
>   - Punkte für nicht gefundene Ressourcen: `1`
>   - Punkte für fehlgeschlagene Anmeldungen: `1`

> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](../README.md)
> 
>    🔗[badrequest-tracker.md](badrequest-tracker.md)
