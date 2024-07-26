# WPProtect
[![WPProtect.png](https://i.postimg.cc/YCKJXFtL/WPProtect.png)](https://postimg.cc/YhRn0hGt)

**🔍 Beschreibung**

Dieses Plugin verbessert die **Sicherheit Ihrer WordPress-Website**, indem es Benutzernamen in öffentlichen Bereichen verbirgt und unerwünschte Anfragen überwacht und blockiert. Dies schützt Ihre Website vor Brute-Force-Angriffen und anderen potenziellen Sicherheitsrisiken.

> ## 📚 Inhalt
>    - **🚀 Mehrwert**
>    - **🏁 Verwendungszweck**
>    - **🚧 Abgrenzung**
>    - **🔒 Datenschutzinformationen**
>    - **💡 Hinweise**
>    - **📦 Installation**
>    - **🔒 Technische Details**
>    - **🧩 Links zu den Modulen**

> **🚀 Mehrwert**
> 
> Durch die Installation dieses Plugins verhindern Sie, dass Angreifer Benutzernamen auf Ihrer Website abfragen und möglicherweise Passwörter knacken können. Außerdem sorgt das Plugin dafür, dass unerwünschte Anfragen von den installierten **WordPress Plugins** mit Sicherheitslücken automatisch **erkannt** und **blockiert** werden, was die Sicherheit Ihrer Website erhöht.

>  **🏁 Verwendungszweck**
> 
> Ziel des Plugins ist es Benutzernamen zu verschleiern, Angreifern den Zugriff auf die Website zu erschweren und IPs über ein Punktesystem je nach Schweregrad zu sperren, welches der Benutzer selbst konfigurieren kann.

> **🚧 Abgrenzung**
> #### Dieses Plugin:
> - ist nur für WordPress geeignet
> - protokolliert nur bösartige Requests
> - trackt nur Requests zum Schutz vor bekannten Wordpress Plugins mit Sicherheitslücken
> - funktioniert nicht in 100% der Fälle. Unter Umständen können Plugin-Funktionen nicht mehr funktionieren.
> - könnte nach einem WordPress-Update nur eingeschränkt oder gar nicht mehr funktionieren
> - garantiert nicht, dass neue Sicherheitslücken sofort oder überhaupt geschlossen werden
> - ist **NICHT** für einen vollständigen Schutz vor Hackern geeignet

>   ## 🔒 Datenschutzerklärung
>    - Dieses Plugin sammelt IP-Adressen und Anfragen, um die Sicherheit der Website zu gewährleisten. Die gesammelten Daten werden nur für diesen Zweck verwendet und nach 30 Tagen gelöscht.
> ### ❓ Warum braucht es diese Daten?
>    - Diese Daten sind notwendig, um die Website vor Angriffen zu schützen und sicherzustellen, dass nur legitime Anfragen zugelassen werden.
> ### 🛠️ Was macht das Plugin mit diesen Daten?
>    - **Analyse:** Die gesammelten Daten werden analysiert, um schädliche Muster zu erkennen.
>    - **Blockierung:** IP-Adressen, die schädliche Anfragen senden, werden blockiert.
> ### ⏳ Wie lange werden die Daten gespeichert?
>    - Die Daten werden für **30 Tage** gespeichert und nach dem 30. Tag automatisch gelöscht.
>    - Durch das Deaktivieren oder das Löschen dieses WordPress-Plugins werden alle personenbezogene Daten gelöscht, indem das Plugin die gesamten Tabellen löscht, welche personenbezogene Daten enthalten.
> ### 🗑️ Was passiert danach mit den Daten?
> - Nach Ablauf der Speicherfrist werden die Daten **sicher gelöscht**, sodass sie nicht mehr auf Einzelpersonen zurückgeführt werden können. Dies stellt sicher, dass keine unnötigen personenbezogenen Daten gespeichert werden und die Privatsphäre der Benutzer gewahrt bleibt.
> ### 📋 Wie aussagekräftig ist der Log?
> - Das Plugin trackt ausschließlich bösartige Requests, dies dient der Übersichtlichkeit und der Datensparsamkeit und ist ein wichtiger Aspekt des Plugins, um die Performance der Website nicht zu Ungunsten des Nutzers zu verschlechtern.
> 
> ## 🔒 Copy-and-Paste Datenschutzerklärung für den Endanwender:
> Übersicht:
> ```
>- 🌐 IP-Adressen: Das Plugin benötigt werden diese Daten, um die Sicherheit der Anwendung zu gewährleisten und schädliche Aktivitäten zu verhindern.
>- ⏱️ Zeit der Anfrage: Zeitstempel der Anfragen werden erfasst, um Angriffsmuster zu erkennen und die Anwendung zu optimieren (keine personenbezogenen Daten).
>- 🧭 URL der Anfrage: Die URL der Anfrage wird gesammelt, um die Legitimität der Anfragen zu prüfen und Sicherheitsrisiken zu minimieren (möglicherweise personenbezogene Daten enthalten).
>- 🧑‍💻 User-Agent: Die Sammlung des User-Agents zur Verbesserung der Kompatibilität und Sicherheit ist DSGVO-konform, solange die Daten zweckgebunden, minimiert und nicht für Trackingzwecke verwendet werden. Bedenken Sie die Anonymisierung/Pseudonymisierung zum Datenschutz.
>- 💬 Anfragen: Zur Analyse werden, all diese DSGVO konformen Anfragen werden auf schädliche Aktivitäten geprüft.
>```
> 🔒 Überblick über Art und Zweck der verwendeten Daten:
>
> |🛠️ Beschreibung|🌐 IP-Adressen|⏱️ Zeit der Anfrage|🧭 URL der Anfrage|🧑‍💻 User-Agent|💬 Anfragen
> |---|---|---|---|---|---|
> |Welche Daten das Plugins sammelt|Diese Daten werden gesammelt, um potenziell unerwünschte oder schädliche Anfragen zu identifizieren und zu blockieren|Zeitstempel der Abfragen werden erfasst, um Muster zu erkennen und mögliche Missbrauchsversuche zu analysieren.|Die URL der Anfrage wird gesammelt, um zu überprüfen, welche Seiten oder Ressourcen aufgerufen werden und ob diese Anfragen legitim sind|Der User-Agent wird gesammelt, um das verwendete Gerät und den Browser zu identifizieren, was zur Verbesserung der Kompatibilität und Sicherheit der Anwendung beiträgt|Alle Anfragen werden analysiert, um schädliche Aktivitäten zu erkennen und zu verhindern|
> |Warum das Plugin diese Daten benötigt|Dies gewährleistet die Sicherheit der Anwendung und schädliche Aktivitäten werden verhindert|Dies wird vom Plugin verwendet, um die Nutzungsmuster zu analysieren und die Leistung der Anwendung zu optimieren|Um sicherzustellen, dass die aufgerufenen Ressourcen korrekt und sicher sind, wird vom Plugin die URL Anfragen gesammelt|Zur Verbesserung der Kompatibilität und Sicherheit der Anwendung werden diese Daten benötigt|Zur Identifizierung und Verhinderung von schädlichen Aktivitäten werden diese Daten benötigt|
> |Was das Plugin macht mit diesen Daten macht|Das Plugin nutzt diese Daten, um IP-Adressen zu blockieren und den Zugriff auf die Anwendungen auf Ihrer Website zu sichern.|Das Plugin nutzt diese Informationen zur Analyse von Nutzungsmustern und zur Leistungsoptimierung.|Diese Daten werden genutzt, um die Legitimität der Anfragen zu prüfen und sicherzustellen, dass keine unbefugten Zugriffe stattfinden|Diese Informationen werden zur Verbesserung der Kompatibilität und Sicherheit der Anwendung genutzt|Diese Daten werden zur Analyse und Verhinderung von schädlichen Aktivitäten verwendet|
> |Sind die gesammelten Daten personenbezogen sind|Es handelt sich hierbei um personenbezogene Daten nach DSGVO.|Der Zeitstempel der Anfrage ist keine personenbezogene Information.|Die URL kann personenbezogene Daten enthalten, z.B. Nutzernamen oder Profilinformationen|Die Speicherung des User-Agents ist nicht DSGVO-widrig, da die gesammelten User-Agent-Daten nicht mit anderen Daten kombiniert, um auf den Nutzer zu schließen, oder zu Trackingzwecken eingesetzt werden|Um zu analysieren, welche Anfragen schädlich sein könnten|

>## 💡 Hinweise zur Nutzung des Plugins
>
> **📦 Installation**
>    - Lade das Plugin in dein WordPress-Verzeichnis hoch (/wp-content/plugins/).
>    - **Aktiviere** das Plugin im WordPress-Adminbereich unter **Plugins**.
>         - Konfiguration: **Keine** weitere Konfiguration nötig – Es gewährleistet die Sicherheit Ihrer Daten.
>
> **💡 Hinweise**
>    - Sie werden im Admin-Bereich benachrichtigt, wenn ein Benutzername mit einem angezeigten Namen übereinstimmt, um Sie auf potenzielle Sicherheitsrisiken hinzuweisen.
    Blockierte IPs werden nach einem bestimmten Zeitraum automatisch wieder freigegeben.

>## 🔒 Technische Details
>
> **📊 Tabellen in der Datenbank**
>   - Das Plugin erstellt zusätzliche Tabellen in der WordPress-Datenbank
>
>
> **⚓ Hooks und Filter**
>
>    - shutdown: Wird ausgeführt, unmittelbar bevor PHP die Ausführung beendet. Überprüft und blendet Benutzernamen aus.
>    - Dieser Hook wird von  shutdown_action_hook() aufgerufen und von register_shutdown_function()  in  als Shutdown-Funktion bei PHP registriert wp-settings.php.
>    - rest_prepare_user: Entfernt Benutzernamen aus REST API Antworten.
>    - template_redirect: Deaktiviert URLs, die Benutzernamen enthalten.

> **🧩 Links zu den Modulen**
> 
>    🔗[Technische Dokumentation md](docs/README.md)
> 
>    🔗[admin-menu.md](docs/admin-menu.md)
> 
>    🔗[badrequest-tracker.md](docs/badrequest-tracker.md)
> 
>    🔗[classifier.md](docs/classifier.md)
> 
>    🔗[config.md](docs/config.md)
> 
>    🔗[cron.md](docs/cron.md)
> 
>    🔗[database.md](docs/database.md)
> 
>    🔗[suspicious_links.md](docs/suspicious_links.md)
> 
>    🔗[username-enumeration.md](docs/username-enumeration.md)
