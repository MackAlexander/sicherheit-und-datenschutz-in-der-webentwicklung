# THM Security Plugin

## High-Level Beschreibung
Dieses Plugin verbessert die **Sicherheit Ihrer WordPress-Website**, indem es Benutzernamen in öffentlichen Bereichen verbirgt und unerwünschte Anfragen überwacht und blockiert. Dies schützt Ihre Website vor Brute-Force-Angriffen und anderen potenziellen Sicherheitsrisiken.

## Mehrwert
Durch die Installation dieses Plugins verhindern Sie, dass Angreifer Benutzernamen auf Ihrer Website abfragen und möglicherweise Passwörter knacken können. Außerdem sorgt das Plugin dafür, dass unerwünschte Anfragen von **Plugins** und **Themes** mit Sicherheitslücken automatisch **erkannt** und **blockiert** werden, was die Sicherheit Ihrer Website erhöht.

## Datenschutzinformationen für den Endanwender

### Welche Daten sammelt das Plugin?
- **IP-Adressen:** Diese Daten werden gesammelt, um potenziell unerwünschte oder schädliche Anfragen zu identifizieren und zu blockieren.
- **Zeit der Anfrage:** Zeitstempel der Abfrage werden erfasst, um Muster zu erkennen und mögliche Missbrauchsversuche zu analysieren.
- **URL der Anfrage:** Die URL der Anfrage wird gesammelt, um zu überprüfen, welche Seiten oder Ressourcen aufgerufen werden und ob diese Anfragen legitim sind.
- **POST-Daten:** POST-Daten können Formularinhalte oder Login-Daten enthalten, die zur Authentifizierung und Verarbeitung der Benutzeranfragen benötigt werden.
- **HTTP/1.1:** Das HTTP-Protokoll selbst enthält keine personenbezogenen Daten, wird aber zur Verarbeitung der Anfragen verwendet.
- **Query-String:** Der Query-String kann Suchparameter oder Filterkriterien enthalten, die zur Verarbeitung und Beantwortung der Benutzeranfragen genutzt werden.
- **User ID:** Wenn verfügbar, wird die User ID gesammelt, um Benutzeranfragen zuzuordnen und Benutzersitzungen zu verwalten.
- **User-Agent:** Der User-Agent wird gesammelt, um das verwendete Gerät und den Browser zu identifizieren, was zur Verbesserung der Kompatibilität und Sicherheit der Anwendung beiträgt.
- **Anfragen:** Alle Anfragen werden analysiert, um schädliche Aktivitäten zu erkennen und zu verhindern.

### Warum braucht es diese Daten?
- **IP-Adressen:** Um die Sicherheit der Anwendung zu gewährleisten und schädliche Aktivitäten zu verhindern.
- **Zeit der Anfrage:** Um die Nutzungsmuster zu analysieren und die Leistung der Anwendung zu optimieren.
- **URL der Anfrage:** Um sicherzustellen, dass die aufgerufenen Ressourcen korrekt und sicher sind.
- **POST-Daten:** Zur Verarbeitung von Formularen und Authentifizierungsanfragen.
- **HTTP/1.1:** Zur Abwicklung der Kommunikation zwischen Server und Client.
- **Query-String:** Zur Verarbeitung und Filterung von Suchanfragen und anderen Parametern.
- **User ID:** Zur Verwaltung der Benutzersitzungen und Personalisierung der Benutzererfahrung.
- **User-Agent:** Zur Verbesserung der Kompatibilität und Sicherheit der Anwendung.
- **Anfragen:** Zur Identifizierung und Verhinderung von schädlichen Aktivitäten.

### Was macht es mit diesen Daten?
- **IP-Adressen:** Diese werden genutzt, um schädliche IPs zu blockieren und den Zugriff auf die Anwendung zu sichern.
- **Zeit der Anfrage:** Diese Informationen werden zur Analyse von Nutzungsmustern und zur Leistungsoptimierung verwendet.
- **URL der Anfrage:** Diese Daten werden genutzt, um die Legitimität der Anfragen zu prüfen und sicherzustellen, dass keine unbefugten Zugriffe stattfinden.
- **POST-Daten:** Diese Daten werden zur Authentifizierung und Verarbeitung von Benutzeranfragen verwendet.
- **HTTP/1.1:** Diese Informationen werden zur Verwaltung der Kommunikation zwischen Server und Client genutzt.
- **Query-String:** Diese Daten werden zur Bearbeitung und Beantwortung von Benutzeranfragen verwendet.
- **User ID:** Diese Daten werden zur Verwaltung der Benutzersitzungen und Personalisierung der Benutzererfahrung genutzt.
- **User-Agent:** Diese Informationen werden zur Verbesserung der Kompatibilität und Sicherheit der Anwendung genutzt.
- **Anfragen:** Diese Daten werden zur Analyse und Verhinderung von schädlichen Aktivitäten verwendet.

## Sind die gesammelten Daten personenbezogen?

- **IP-Adressen:** Persönliches Datum nach DSGVO.
- **Zeit der Anfrage:** Der Zeitstempel der Anfrage ist keine personenbezogene Information.
- **URL der Anfrage:** Die URL kann personenbezogene Daten enthalten, z.B. Nutzernamen oder Profilinformationen.
- **POST :** POST-Daten können personenbezogene Informationen enthalten, z.B. Formularinhalte oder Login-Daten.
- **HTTP/1.1 :** Das HTTP-Protokoll enthält keine personenbezogenen Daten.
- **Query-String :** Der Query-String kann personenbezogene Daten enthalten, z.B. Suchparameter oder Filterkriterien.
- **User ID:** User ID eindeutig personenbezogen (DSGVO relevant) 
Nicht eindeutig personenbezogen:
User ID = 123456: ohne weitere Informationen nicht personenbezogen (eher nicht DSGVO relevant).
- **User-Agent:** Die bloße Speicherung des User-Agents ist nicht zwangsläufig DSGVO-widrig.
Werden User-Agent-Daten mit anderen Daten kombiniert, um auf den Nutzer zu schließen, oder zu Trackingzwecken eingesetzt, dann unterliegen sie der DSGVO.
- **Anfragen:** Um zu analysieren, welche Anfragen schädlich sein könnten.



### Warum braucht es diese Daten?
- Diese Daten sind notwendig, um die Website vor Angriffen zu schützen und sicherzustellen, dass nur legitime Anfragen zugelassen werden.

### Was macht das Plugin mit diesen Daten?
- **Analyse:** Die gesammelten Daten werden analysiert, um schädliche Muster zu erkennen.
- **Blockierung:** IP-Adressen, die schädliche Anfragen senden, werden blockiert.

### Wie lange werden die Daten gespeichert?
- Die Daten werden für maximal **30 Tage** gespeichert und danach automatisch gelöscht.
- Durch das Deaktivieren oder das Löschen dieses Wordpress-Plugins werden alle personenbezogene Daten gelöscht, indem das Plugin die gesamten Tabellen löscht, welche personenbezogene Daten enthalten.

### Was passiert danach mit den Daten?
Nach Ablauf der Speicherfrist werden die Daten **sicher gelöscht**, sodass sie nicht mehr auf Einzelpersonen zurückgeführt werden können. Dies stellt sicher, dass keine unnötigen personenbezogenen Daten gespeichert werden und die Privatsphäre der Benutzer gewahrt bleibt.

### Datenschutzerklärung

- Dieses Plugin sammelt IP-Adressen und Anfragen, um die Sicherheit der Website zu gewährleisten. Die gesammelten Daten werden nur für diesen Zweck verwendet und nach 30 Tagen gelöscht.
#
#
#
#
## Installation und Nutzung

- Installation: Laden Sie das Plugin herunter und **installieren** Sie es über das **WordPress-Dashboard** >> **Plugins**.
- Nutzen Sie einen **FTP-Client** und ziehen Sie das Plugin in den Plugins Ordner
- Aktivierung: Klicken Sie anschließend auf **aktivieren** im Plugin Dashboard.
 Konfiguration: Keine weitere Konfiguration nötig – Es gewährleistet die Sicherheit Ihrer Daten.

### Hinweise

- Sie werden im Admin-Bereich benachrichtigt, wenn ein Benutzername mit einem angezeigten Namen übereinstimmt, um Sie auf potenzielle Sicherheitsrisiken hinzuweisen.
Blockierte IPs werden nach einem bestimmten Zeitraum automatisch wieder freigegeben.

### Technische Details
### Tabellen in der Datenbank

### Das Plugin erstellt zusätzliche Tabellen in der WordPress-Datenbank:

- 

### Hooks und Filter

- shutdown: Wird ausgeführt, unmittelbar bevor PHP die Ausführung beendet. Überprüft und blendet Benutzernamen aus.
- Dieser Hook wird von  shutdown_action_hook() aufgerufen und von register_shutdown_function()  in  als Shutdown-Funktion bei PHP registriert wp-settings.php.

- rest_prepare_user: Entfernt Benutzernamen aus REST API Antworten.
- template_redirect: Deaktiviert URLs, die Benutzernamen enthalten.

### Verlinkung der Module

username-enumeration.md
bad-request-tracker.md



    ```markdown