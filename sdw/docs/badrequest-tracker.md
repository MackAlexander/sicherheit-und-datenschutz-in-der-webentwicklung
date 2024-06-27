# THM Security Plugin



## Übersicht badrequest-tracker

!!!!TIP Beschreibung
    Dieses WordPress-Plugin verbessert die Sicherheit und den Datenschutz der Benutzer, indem es verschiedene Maßnahmen implementiert, um die Anonymität der Benutzer zu gewährleisten und sensible Informationen zu schützen. Das Plugin bearbeitet Benutzernamen und Displaynamen, deaktiviert Autoren-Seiten, passt verschiedene WordPress-Filter und Aktionen an und bietet zusätzliche Sicherheitsfunktionen.

## Funktionen

!!!ATTENTION Inhalt
    - **Nutzersperrungen**
        - Sperrungen nach Anzahl bösartiger Requests
        - Entsperrung nach Zeit
            - Löschen der ältesten Tabelleneinträge
    - **Punktesystem**
        - Punkteverteilung
        - Punkteanstieg
            - Exponentielles Ansteigen nach Anzahl bösartiger Requests
        - Punktegewichtung
        - Punktereset
            - Beispiel
        - Höhere Punkteeinstieg nach Reset
            - Gleichbleibender exponentieller Punkteanstieg

!!!DANGER Nutzersperrungen:

    #### Sperrungen nach Anzahl bösartiger Requests
    ##### Exponentielles Ansteigen nach Anzahl bösartiger Requests
    Bösartige Requests werden getrackt und in einer Tabelle gespeichert. Das Punktesystem des Plugins wertet den Request aus. Nach einer gewissen bösartiger Anzahl von Requests wird der Nutzer gesperrt.

    #### Entsperrung nach Zeit
    ##### Löschen der ältesten Tabelleneinträge
    Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt.


!!!DANGER Punktesystem:

    #### Punkteverteilung
    #### Punktegewichtung

    #### Punkteanstieg
    Die Punkteverteilung erfolgt durch die durch das Plugin festgelegte Schwere des bösartigen Requests. Schere bösartige Requests speichern in der Tabelle mehr Punkte auf einmal, was dazu führt, dass der Nutzer den durchgeführten Request nur wenige Male versuchen kann, bis er gesperrt wird.
    - **Exponentielles Ansteigen der Punkte nach Anzahl bösartiger Requests**
    Wiederholte bösartige Requests geben exponentiell mehr Punkte, was zu einer schnelleren Sperrung des Nutzers führt.
    #### Punktereset
    Tabelleneinträge, die bereits 30 Tage gespeichert wurden, werden gelöscht und mit der Löschung auch der damalige Punktestand und der Nutzer wird entsperrt. Die Punkte, die der Nutzer vor den 30 Tagen auf seinem Punktekonto hat, sind gelöscht und sofern die gespeicherten Punkte die Sperrpunktzahl nicht überschreiten, bleibt der Nutzer entsperrt, bzw. wird entsperrt beim unterschreiten der Sperrkunktzahl.
    #### Höhere Punkteeinstieg nach Reset
    Gespeicherte Punkte von vor 30 Tagen sind zwar gelöscht, dennoch bleiben die durch die exponentielle Punktevergabe erlangten Punkte die noch kleine 30 Tage alt sind erhalten
    ##### Beispiel
    Ein nuter machte 3 bösarigen Request vor 31 Tagen mit einer exponentiellen Punktevergabe von 5, 10 und 20. Der Nuter Nachte vor 29 Tagen einen bösartigen Request mit 40 Punkten. Zu dem Zeitpunkt bleiben die durch die expoinentielle Kurve erlangeten 40 Punkte erhalten, neue bösartige Requests geben dem Nutzer jedoch wieder 5, 10, 20,.. Punkte somit 45, 50, 70,...
    ##### Gleichbleibender exponentieller Punkteanstieg
    Bei 30 Tagen ohne bösartiger Requests bekommt der Nutzer, auch bei vorstoß von vor 30 Tagen wieder 5, 10, 20,.. Punkte, da die älteren requests gelöscht bleiben und somit auch die gespeicherten Punkte

