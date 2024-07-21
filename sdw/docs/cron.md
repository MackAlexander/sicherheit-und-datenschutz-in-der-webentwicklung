# cron
> [!TIP]
> **🔍 Beschreibung**
> 
> Dieses Modul verwaltet den täglichen Cron-Job zur Bereinigung alter Zugriffprotokolle und Sperrungen.

## Funktionen

> [!WARNING]
>
> **📚 Inhalt**
>    - **⏲️ schedule_daily_task()**
>        - Einplanung des täglichen Cron-Jobs.
>    - **⏲️ clear_scheduled_task()**
>        - Entfernen des eingeplanten Cron-Jobs.
>    - **🧹 remove_old_entries()**
>        - Löschen von Zugriffprotokollen und Sperren, die älter als eine bestimmte Anzahl von Tagen sind.

> [!IMPORTANT]
>
> ### ⏲️ schedule_daily_task()
>
>    #### Verwendete Wordpress Hooks/Funktionen
>    - register_activation_hook
>    - wp_next_scheduled
>
> Wird ausgeführt, sobald das Plugin aktiviert wird. Es wird zunächst geprüft, ob bereits ein täglicher Cron-Job mit dem Namen `remove_old_entries` existiert. Ist dies nicht der Fall, wird der Hook `remove_old_entries` eingefügt, der einmal täglich aufgerufen wird.

> [!IMPORTANT]
>
> ### ⏲️ clear_scheduled_task()
>
>    #### Verwendete Wordpress Hooks/Funktionen
>    - register_deactivation_hook
>    - wp_next_scheduled
>    - wp_unschedule_event
>
> Wird ausgeführt, sobald das Plugin deaktiviert wird. Der zuvor erstelle Cron-Job wird dann entfernt.

> [!IMPORTANT]
>
> ### 🧹 Entfernen alter Einträge
>
>    #### Verwendete Wordpress Hooks/Funktionen
>    - remove_old_entries
>
> Wird jede 24 Stunden ausgeführt. Ruft die Funktionen `remove_old_logs($days)` und `remove_old_bans()` des [database](database.md) Moduls auf. Die übergebenen Tage werden dabei dem [config](config.md) Modul entnommen.

> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](../README.md)
> 
>    🔗[admin_menu.md](admin_menu.md)
> 
>    🔗[badrequest-tracker.md](badrequest-tracker.md)
> 
>    🔗[classifier.md](classifier.md)
> 
>    🔗[config.md](config.md)
> 
>    🔗[database.md](database.md)
> 
>    🔗[suspicious_links.md](suspicious_links.md)
> 
>    🔗[username-enumeration.md](username-enumeration.md)
