# username-enumeration

> [!TIP]
> **🔍 Beschreibung**
> 
> Dieses Plugin verbessert die **Sicherheit Ihrer WordPress-Website**, indem es Benutzernamen in öffentlichen Bereichen verbirgt und unerwünschte Anfragen überwacht und blockiert. Dies schützt Ihre Website vor Brute-Force-Angriffen und anderen potenziellen Sicherheitsrisiken.

## Funktionen

> [!WARNING]
>
> **📚 Inhalt**
>    - **Benutzerverwaltung**
>        - Standard-Nickname und Anzeige-Name setzen
>        - Anzeige-Name darf nicht dem Login-Namen entsprechen
>    - **Deaktivierung von Autoren-Seiten**
>        - Autoren-Seiten deaktivieren
>    - **Backend-Warnungen**
>        - Warnung im Admin-Bereich
>    - **Anpassungen von Autoren- und Kommentar-Anzeigenamen**
>        - Autorenname im RSS-Feed und Blog-Posts anpassen
>    - **URLs und Fehlermeldungen**
>        - Autoren-URL deaktivieren
>        - Generische Fehlermeldungen bei Login-Fehlern
>    - **REST-API und Embeds**
>        - Benutzerendpunkte in der REST-API deaktivieren
>        - Autorinformationen aus Embeds entfernen
>    - **Sitemaps**
>        - Benutzersitemaps deaktivieren    

> [!IMPORTANT]
>
> ### ⚙️Benutzerverwaltung
>
>    #### Standard-Nickname und Anzeige-Name setzen
>    ##### Funktionsweise:
>    Beim Erstellen eines neuen Benutzers wird durch die Funktion user_register der Nickname und der Anzeige-Name des neuen Benutzers auf "Anonymous" gesetzt. Dies wird durch den Hook user_register erreicht, der die Funktion THM\Security\Username::user_register aufruft.
>
>    ##### Standard-Nickname und Anzeige-Name setzen: Beim Erstellen eines neuen Benutzers wird der Nickname und der Anzeige-Name auf "Anonymous" gesetzt.
>
>    ```` codadd_action('user_register', ['THM\Security\Username', 'user_register'], 10, 2); ````
>
>    ##### Anzeige-Name darf nicht dem Login-Namen entsprechen: Beim Aktualisieren des Profils wird überprüft, ob der Anzeige-Name dem Login-Namen entspricht. Falls ja, wird der Anzeige-Name auf "Anonymous" zurückgesetzt.
>
>    ```` add_action('profile_update', ['THM\Security\Username', 'profile_update'], 10, 3); ````
>    ```` add_action('user_profile_update_errors', ['THM\Security\Username', 'user_profile_update_errors'], 10, 3); ````
>    #
>    #### 🔍Im Detail:
>    ###### Der Hook **profile_update** wird aufgerufen, wenn ein Benutzerprofil aktualisiert wird.
>    - Die Funktion THM\Security\Username::profile_update erhält drei Parameter: die Benutzer-ID ($user_id), die alten Benutzerdaten ($old_user_data) und die neuen Benutzerdaten ($userdata).
>    - Innerhalb dieser Funktion wird get_userdata verwendet, um die aktuellen Benutzerdaten zu erhalten und zu überprüfen, ob der Anzeige-Name dem Login-Namen entspricht. 
>    - Falls ja, wird wp_update_user aufgerufen, um den Nickname und den Anzeige-Namen zu ändern.
>        Der Hook user_profile_update_errors fügt einen Fehler hinzu, wenn der Benutzer versucht, den Anzeige-Namen auf den Login-Namen zu setzen.

> [!IMPORTANT]
>
> ### ⛔Deaktivierung von Autoren-Seiten
>
>    #### Autoren-Seiten deaktivieren: Wenn eine Autoren-Seite aufgerufen wird, zeigt WordPress eine 404-Seite an.
>
>    ```` add_action('template_redirect', ['THM\Security\Username', 'disable_author_page'], 10, 0); ````
>    #   
>    #### 🔍Im Detail:
>    - Der Hook template_redirect wird vor dem Laden der Vorlage aufgerufen, um bedingte Umleitungen vorzunehmen.
>        - Die Funktion THM\Security\Username::disable_author_page prüft, ob die aktuelle Anfrage eine Autoren-Seite ist (is_author()).
>    - Wenn dies der Fall ist, wird die Anfrage in eine 404-Seite umgewandelt, indem global $wp_query verwendet wird, um den Status auf 404 zu setzen, und status_header(404) sowie nocache_headers() aufgerufen werden.



> [!IMPORTANT]
>
> ### ⚠️Backend-Warnungen
>
>    #### Warnung im Admin-Bereich: Wenn der aktuelle Benutzer den Anzeige-Namen "Anonymous" hat, wird eine Warnung im Admin-Bereich angezeigt.
>
>    ```` add_action('admin_notices', ['THM\Security\Username', 'admin_notices'], 10, 0); ````
>    #   
>    #### 🔍Im Detail:
>    - Der Hook admin_notices wird verwendet, um Benachrichtigungen im Admin-Bereich anzuzeigen.
>        - Die Funktion THM\Security\Username::admin_notices prüft, ob der aktuelle Benutzer den Anzeige-Namen "Anonymous" hat (wp_get_current_user()).
>    - Wenn dies der Fall ist, wird eine HTML-Benachrichtigung mit einer Warnmeldung und einem Link zur Profilseite des Benutzers ausgegeben.



> [!IMPORTANT]
>
> ### 💬Anpassungen von Autoren- und Kommentar-Anzeigenamen
>
>    #### Autorenname im RSS-Feed und Blog-Posts anpassen: Benutzernamen werden durch "Anonymous" ersetzt.
>
>    ```` add_filter('the_author', ['THM\Security\Username', 'the_author'], 10, 1); ````
>    ```` add_filter('get_the_author_display_name', ['THM\Security\Username', 'get_the_author_display_name'], 10, 3); ````
>    ```` add_filter('get_comment_author', ['THM\Security\Username', 'get_comment_author'], 10, 3); ````
>    #   
>    #### 🔍Im Detail:
>    - Der Hook the_author wird verwendet, um den Autorennamen im RSS-Feed zu filtern.
>        - Die Funktion THM\Security\Username::the_author prüft, ob der Benutzername existiert (username_exists), und ersetzt ihn gegebenenfalls durch "Anonymous".
>    - Der Hook get_the_author_display_name wird verwendet, um den Autorennamen in Blog-Posts zu filtern.
>        - Die Funktion THM\Security\Username::get_the_author_display_name funktioniert ähnlich wie the_author und ersetzt den Anzeigennamen durch "Anonymous", falls der Benutzername existiert.
>    - Der Hook get_comment_author wird verwendet, um den Namen des Kommentarautors zu filtern.
>        - Die Funktion THM\Security\Username::get_comment_author prüft, ob der Kommentarautor ein Benutzer ist (get_user_by) und ersetzt den Namen durch "Anonymous", falls der Benutzername existiert.



> [!IMPORTANT]
>
> ### 🌐URLs und Fehlermeldungen
>
>    #### Autoren-URL deaktivieren: Die Autoren-URL wird auf der aktuellen Seite belassen und die Umleitung von ?author=1 zu /author/name wird deaktiviert.
>
>    ```` add_filter('author_link', ['THM\Security\Username', 'author_link'], 10, 3); ````
>
>    Generische Fehlermeldungen bei Login-Fehlern: Bei falschen Login-Daten wird eine allgemeine Fehlermeldung angezeigt.
>
>    ```` add_filter('login_errors', ['THM\Security\Username', 'login_errors'], 10, 1); ````
>    #   
>    #### 🔍Im Detail:
>    - Der Hook author_link wird verwendet, um die Autoren-URL zu filtern.
>        - Die Funktion THM\Security\Username::author_link setzt den Link auf false, wodurch die Autoren-URL deaktiviert wird.
>    - Der Hook login_errors wird verwendet, um die Fehlermeldungen bei fehlgeschlagenen Anmeldeversuchen zu filtern.
>        - Die Funktion THM\Security\Username::login_errors ersetzt die Standardfehlermeldung durch eine generische Meldung "Wrong Username or password".


> [!IMPORTANT]
>
> ### 🛠️REST-API und Embeds
>
>    #### Benutzerendpunkte in der REST-API deaktivieren: Die Endpunkte für Benutzer werden aus der WordPress REST-API entfernt.
>
>    ```` add_filter('rest_endpoints', ['THM\Security\Username', 'rest_endpoints'], 10, 1); ````
>
>    Autorinformationen aus Embeds entfernen: Autorenname und URL werden aus Embed-Daten entfernt.
>
>    ```` add_filter('oembed_response_data', ['THM\Security\Username', 'oembed_response_data'], 10, 4); ```` 
>    #   
>    #### 🔍Im Detail:
>    - Der Hook rest_endpoints wird verwendet, um die REST-API-Endpunkte zu filtern.
>        - Die Funktion THM\Security\Username::rest_endpoints entfernt die Endpunkte /wp/v2/users und /wp/v2/users/(?P<id>[\d]+) aus dem Array der Endpunkte.
>    - Der Hook oembed_response_data wird verwendet, um die Embed-Daten zu filtern.
>        - Die Funktion THM\Security\Username::oembed_response_data entfernt die Schlüssel author_url und author_name aus den Embed-Daten.

> [!IMPORTANT]
>
> ### 🗺️Sitemaps
>
>    #### Benutzersitemaps deaktivieren: Die Benutzer-URL in der Sitemap wird deaktiviert und der Link aus der Haupt-Sitemap entfernt.
>
>    add_filter('wp_sitemaps_add_provider', ['THM\Security\Username', 'wp_sitemaps_add_provider'], 10, 2);
>
>    ```` add_filter('wp_sitemaps_add_provider', ['THM\Security\Username', 'wp_sitemaps_add_provider'], 10, 2); ````
>    #   
>    #### 🔍Im Detail:
>    - Der Hook wp_sitemaps_add_provider wird verwendet, um die Anbieter von Sitemaps zu filtern.
>        - Die Funktion THM\Security\Username::wp_sitemaps_add_provider überprüft, ob der Name des Anbieters "users" ist, und entfernt diesen Anbieter gegebenenfalls. 

> [!Note]
> **🧩 Links zu den Modulen**
>
>    🔗[README.md](README.md)
> 
>    🔗[badrequest-tracker.md](badrequest-tracker.md)
