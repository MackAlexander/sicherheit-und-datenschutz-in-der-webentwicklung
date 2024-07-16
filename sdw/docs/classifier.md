# classifier

> [!TIP]
> **🔍 Beschreibung**
> 
> Dieses Modul klassifiziert eingehende Anfragen und weist ihnen je nach Art der Anfrage Sicherheitsbewertungen Punkte zu.

## Funktionen

> [!WARNING]
>
> **📚 Inhalt**
>    - **🔍 Anfrageklassifizierung**
>        - Identifikation und Klassifikation von Anfragen
         - Erkennung von spezifischen Bedrohungen
>    - **📊 Punktebewertung**
>        - Zuweisung von Punkten basierend auf der Klassifikation

> [!IMPORTANT]
>
> ### 🔍 Anfrageklassifizierung
>
>    #### 🛡️ Identifikation und Klassifikation von Anfragen
>    - Eingehende Anfragen werden analysiert und klassifiziert, um potenziell schädliche Aktivitäten zu erkennen.
>    #### 🚩 Erkennung von spezifischen Bedrohungen
>    - Bestimmte Muster und Inhalte in Anfragen (z.B. /xmlrpc.php, .sql, wp-scan User-Agent) werden erkannt und klassifiziert, um Sicherheitsrisiken zu identifizieren.

> [!IMPORTANT]
>
> ### 📊 Punktebewertung
>
>    #### 🔢 Zuweisung von Punkten basierend auf der Klassifikation
>    - Jede Klassifikation erhält eine spezifische Punktzahl, die die Schwere des potenziellen Risikos widerspiegelt (z.B. config-grabber, wp-scan, 404-not-found).


> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](../README.md)
> 
>    🔗[badrequest-tracker.md](badrequest-tracker.md)
