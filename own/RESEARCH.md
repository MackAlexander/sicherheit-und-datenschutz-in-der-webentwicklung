# Anleitung zur Erzeugung Bösartiger bzw. Gutartiger Daten:

## Gruppe: Nickel, Mack

** Gutartige requests **

+ Zeit der Anfrage *$_SERVER['REQUEST_TIME']*

+ URL der Anfrage *$_SERVER['HTTP_REFERER']*

+ IP Adresse *$_SERVER['SERVER_ADDR']*

+ POST *$_SERVER['REQUEST_METHOD']*

+ HTTP/1.1 *$_SERVER['SERVER_PROTOCOL']*

+ Query-String *$_SERVER['QUERY_STRING']*

+ User-Agent *$_SERVER['HTTP_USER_AGENT']*

+ $user_id = get_current_user_id(); *loggt die User ID, wenn es eine User ID gibt. Leergelassen, wenn es keine User ID gibt (null)*


**Ablauf:**


+ Bild hochladen
+ Startseit uneingelogg wp admin login -




** Bösartige Requests** 

+ WPScan durchsucht folgende Daten:

     + Diese Variable gibt Informationen über die verwendete Server-Software wie Apache oder Nginx zurück. $_SERVER['SERVER_SOFTWARE']:

     + Enthält den Namen des Servers, der die aktuelle Seite hostet. $_SERVER['SERVER_NAME']:

     + Gibt die IP-Adresse des Servers zurück *$_SERVER['SERVER_ADDR']*

     + Zeigt den Dateisystempfad zum Root-Verzeichnis des Webservers. *$_SERVER['DOCUMENT_ROOT']*

     + Enthält den User-Agent des Clients, der die Seite anfordert. *$_SERVER['HTTP_USER_AGENT']*

     + Gibt die HTTP-Anforderungsmethode wie GET, POST, PUT oder DELETE zurück. *$_SERVER['REQUEST_METHOD']*

     + Zeigt die IP-Adresse des Clients, der die Anfrage stellt. *$_SERVER['REMOTE_ADDR']*
 
     + Gibt den Dateipfad des aufgerufenen Skripts zurück. *$_SERVER['SCRIPT_FILENAME']*
	 
	 
**Ablauf**


**Grenzen kennenleren:**

+ Bild hochladen wird nicht geloggt
+ Abfrage eines nicht vorhandenen Bildes wird geloggt

