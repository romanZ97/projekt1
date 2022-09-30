# Wirtschaftsinformatik Projekt 1 - GastroWeb

Im Projekt1 wurde eine Webanwendung "GastroWeb" für ein Restaurant mit Bestell- und Tischreservierungssystem entwickelt.

Die Anwendung ist in zwei Sichten (Benutzer und Admin) aufgebut:
#### Benutzeransicht
> Dabei können die Benutzern die Speisen anschauen und eine Bestell- und Tischreservierungsvorgänge durchfüchren.

#### Adminansicht
> Dabei können die Moderatoren die wäsentliche Daten verwalten, wie z.B. Hinzufügen, Ändern und Lösche von Speisen, Kategorien sowie Datensätze von Bestellungen und Reservierungen.

## Inbetriebnahme

### Projektordner
> Projekt Ordner soll aufm Webserwer geclont werden, z.B. in XAMMP ist das Projekt unter ```htdocs``` Ordner herunterzuladen.

### Globalpfad einrichten.
> Globaler Pfad wird für Verweiseindeudigkeit angelegt, damit die Referenzen zu jeweiligen Subseiten eindeutig zu definieren bleiben.

> Bsp.: "http://localhost:8888/projekt1"

- Der globaler Pfad ist unter [``` projekt1/config/globalpath.php ```](/config/globalpath.php) zu bestimmen.

### Verbindung zur Datenbank einrichten.
- Erstmal soll die Datenbank aufgebaut werden, dafür ist die Datei [``` projekt1/db/projek1.sql ```](/assets/db/projekt1.sql) zu nutzen.
- Die Verbindung zu der Datenbank wird von der Datei [```projek1/config/db_connect.php ```](/config/db_connect.php) durchgeführt. 
  (Hier sind die Datenbank Zugänge einzugeben)

### Die Webanwendung ist durch ```globalpath```/index.php  für Usersich und durch ```globalpath```/admin/index.php für Adminsicht abzurufen.
