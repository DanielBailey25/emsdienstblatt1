# Dienstblatt
Ein Projekt um die Verwaltung von medizinischen Angestellten im Spiel GTA 5 (GTA 5 RolePlay) einfacher zu machen.

Das Dienstblatt wird zurzeit auf dem deutschen [Grand-RP](https://gta5grand.com/) Server mit rund 1000 Spielern genutzt. Die Anzahl der aktiven User vom Dienstblatt beträgt 113 (Stand: 19.10.2021).

Sinn und Zweck des Projektes ist es ein einfach zu verwaltendes Backend für die Leitungsebene der Medics zu schaffen.

## Features (User)

- Dashboard - Zeigt alle aktive Einheiten welche sich zurzeit im Dienst befinden und welchem Ort oder Krankenhaus diese zugeordnet sind
- Eintragen im Dienstblatt um auf dem Dashboard zu erscheinen
- Urlaub kann über ein Formular eingereicht werden
- Urlaubsübersicht aller User
- Ingame Telefonnummer und Passwort für das Dienstblatt kann im Profil bearbeitet werden
- Neuste Neuigkeiten aus der Leitebene einsehen
- Mitarbeiterübersicht
- Ausbildungen - Welche von den Admins eingepflegt werden, können hier abgerufen werden
- User kann sich selbständig wieder aus dem Dienstblatt austragen

## Features (User + Admin)

- Übersicht aller User
- Rang von Spielern ändern, um diesen z.b. dem Rang im Spiel anzugleichen
- Rechte zum Admin können über die Userübersicht vergeben werden
- Neue Benutzer können angelegt werden
- Neue Neuigkeiten können angelegt werden
- Verwarnungen an User welcher negativ aufgefallen sind, können in der Mitarbeiterübersicht vergeben werden
- Ausbildung hinzufügen (pdf, jpeg, jpg, png)
- Ausbildung freischalten - falls die Ausbildung nicht als öffentlich markiert wurde, können einzelne User für die Dokumente freigeschaltet werden
- Kann einzelne User aus dem Dienstblatt austragen, falls diese es vergessen haben


## Installation
```bash
git clone git@github.com:mfrischbutter/dienstblatt.git
composer install
./vendor/bin/sail up
```

## Screenshots
![Dashboard](https://postimg.cc/hz9kzrQd)
![Newsübersicht](https://postimg.cc/3dc3HtX8)
![Ausbildungen freigeschaltet](https://postimg.cc/rd6cDzZ7)
![Userübersicht (Admin)](https://postimg.cc/G9MCkXSF/dfbd1c7c)
![News erstellen (Admin)](https://postimg.cc/XZ0SVmpb)
![Profil](https://postimg.cc/HVJfbdMm)


## License
[MIT](https://choosealicense.com/licenses/mit/)
