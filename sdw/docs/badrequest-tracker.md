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
>        - Punkteanstieg
>            - Exponentielles Ansteigen nach Anzahl bösartiger Requests
>        - Punktegewichtung
>    - **🗑️ Punktereset**
>         - Beispiel
>             - Höhere Punkteeinstieg nach Reset
>             - Gleichbleibender exponentieller Punkteanstieg

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
>    - Je nach Menge der Rerquests
>    #### ⚖️ Punktegewichtung
>    - Je nach Schwere des Rerquests

> [!IMPORTANT]
>
>  ### 🗑️ Punktereset
> 
>    - Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt. Die Punkte, die der Nutzer vor den 30 Tagen auf seinem Punktekonto hat, sind gelöscht und sofern die gespeicherten Punkte die Sperrpunktzahl nicht überschreiten, bleibt der Nutzer entsperrt, bzw. wird entsperrt beim Unterschreiten der Sperrpunktzahl.
>    #### ⛰️ Höherer Punkteeinstieg nach Reset
>    - Gespeicherte Punkte von vor 30 Tagen sind zwar gelöscht, dennoch bleiben die durch die exponentielle Punktevergabe erlangten Punkte, die noch kleine 30 Tage alt sind erhalten
>
>    #### 🔍 Beispiel
>    - Ein Nutzer machte 3 bösartige Request vor 31 Tagen mit einer exponentiellen Punktevergabe von 5, 10 und 20. Der Nutzer machte vor 29 Tagen einen bösartigen Request mit 40 Punkten. Zu dem Zeitpunkt bleiben die durch die exponentielle Kurve erlangten 40 Punkte erhalten, neue bösartige Requests geben dem Nutzer jedoch wieder 5, 10, 20,.. Punkte somit 45, 55, 75,...
>    #### ⚖️ Gleichbleibender exponentieller Punkteanstieg
>    - Bei 30 Tagen ohne bösartiger Requests bekommt der Nutzer, auch bei Vorstoß von vor 30 Tagen wieder 5, 10, 20,.. Punkte, da die älteren Requests gelöscht bleiben und somit auch die gespeicherten Punkte

> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](../README.md)
> 
>    🔗[username-enumeration.md](username-enumeration.md)
