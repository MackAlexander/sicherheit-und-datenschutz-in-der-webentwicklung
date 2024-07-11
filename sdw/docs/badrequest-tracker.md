# badrequest-tracker

> [!TIP]
> **🔍 Beschreibung**
> 
> Dieses Plugin verbessert die **Sicherheit Ihrer WordPress-Website**, indem es Benutzernamen in öffentlichen Bereichen verbirgt und unerwünschte Anfragen überwacht und blockiert. Dies schützt Ihre Website vor Brute-Force-Angriffen und anderen potenziellen Sicherheitsrisiken.

## Funktionen

> [!WARNING]
>  **📚 Inhalt**
> 
>    - **⛔ Nutzersperrungen**
>        - Sperrungen nach Anzahl bösartiger Requests
>        - Entsperrung nach Zeit
>            - Löschen der ältesten Tabelleneinträge
>    - **🏆 Punktesystem**
>        - Punkteverteilung
>        - Punktegewichtung
>    - **🗑️ Punktereset**

> [!IMPORTANT]
>
> ### ⛔ Nutzersperrungen
>    #### 🚫 Sperrungen nach Anzahl bösartiger Requests
>    ##### Exponentielles Ansteigen nach Anzahl bösartiger Requests
>    - Bösartige Requests werden getrackt und in einer Tabelle gespeichert. Das Punktesystem des Plugins wertet den Request aus. Nach einer gewissen bösartigen Anzahl von Requests wird der Nutzer gesperrt.
>    #### 🗑️ Entsperrung nach Zeit
>    ##### Löschen der ältesten Tabelleneinträge:
>    - Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt.


> [!IMPORTANT]
>
> ### 🏆 Punktesystem
>
>    #### 📊 Punkteverteilung
>    - Je nach Menge der Requests
>    #### ⚖️ Punktegewichtung
>    - Je nach Schwere des Requests

> [!IMPORTANT]
>
>  ### 🗑️ Punktereset
> 
>    - Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt. Die Punkte, die der Nutzer vor den 30 Tagen auf seinem Punktekonto hat, sind gelöscht und sofern die gespeicherten Punkte die Sperrpunktzahl nicht überschreiten, bleibt der Nutzer entsperrt, bzw. wird entsperrt beim Unterschreiten der Sperrpunktzahl.

> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](../README.md)
> 
>    🔗[username-enumeration.md](username-enumeration.md)
