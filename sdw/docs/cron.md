# cron

## Abhängigkeiten
- [config](config.md)
- [database](database.md)

## Beschreibung
Dieses Modul verwaltet den täglichen Cron-Job zur Bereinigung alter Zugriffprotokolle und Sperrungen.


## Funktionen
> ### `📆schedule_daily_task()`
> **Ausführendes Ereignis:** [register_activation_hook](https://developer.wordpress.org/reference/functions/register_activation_hook/) 
> 
> **Beschreibung:**
> Es wird zunächst mit der Funktion `wp_next_scheduled` geprüft, ob bereits ein Cron-Job mit dem Namen `remove_old_entries` existiert. 
> Ist dies nicht der Fall, wird der eigene Hook `remove_old_entries` täglich zur aktuellen Uhrzeit eingeplant.
>
> **Achtung:** Der Hook und die entsprechende Funktion werden für den entsprechenden Zeitpunkt eingeplant, aber erst ausgeführt, sobald ein Aufruf auf die Website erfolgt.

> ### `🧹clear_scheduled_task()`
> **Ausführendes Ereignis:** [register_deactivation_hook](https://developer.wordpress.org/reference/functions/register_deactivation_hook/)
> 
> **Beschreibung:**
> Der zuvor erstelle Hook `remove_old_entries` wird mit der Funktion `wp_unschedule_event` entfernt.

> ### `🗑️remove_old_entries()`
> **Ausführendes Ereignis:** `remove_old_entries`
> 
> **Beschreibung:**
> Ruft die Funktionen `remove_old_logs($days)` und `remove_old_bans()` des [database](database.md) Moduls auf. Die übergebenen Tage werden dabei dem [config](config.md) Modul entnommen.

## 🔗 Links zu den anderen Modulen
- [README.md](../README.md)
- [Technische README.md](README.md)
- [admin-menu.md](admin-menu.md)
- [badrequest-tracker.md](badrequest-tracker.md)
- [classifier.md](classifier.md)
- [config.md](config.md)
- [database.md](database.md)
- [suspicious-links.md](suspicious-links.md)
- [username-enumeration.md](username-enumeration.md)
