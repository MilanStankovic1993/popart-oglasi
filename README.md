# PopArt Oglasi – Laravel aplikacija za male oglase

PopArt Oglasi je demo web aplikacija razvijena kao zadatak za PopArt.  
Aplikacija predstavlja sistem malih oglasa (poput KupujemProdajem.com)  
uz odvojene uloge Admin i Customer korisnika.

Aplikacija je izgrađena u **Laravel 11** frameworku sa **Breeze autentifikacijom**  
i prilagođenim front-end prikazom za goste i registrovane korisnike.

---

# Funkcionalnosti

## 1. Oglasi (Ads)
Svaki oglas sadrži:
- naslov  
- opis  
- cenu  
- stanje („novo“, „polovno“)  
- glavnu sliku  
- kontakt telefon  
- lokaciju  
- kategoriju  
- korisnika (vlasnika)

Customer korisnik može:
- kreirati svoj oglas  
- menjati svoj oglas  
- obrisati svoj oglas  
- videti listu svojih oglasa na dashboard-u  

Admin korisnik može:
- raditi kompletan CRUD nad svim oglasima u sistemu  
- birati kojem user-u pripada oglas  

---

## 2. Kategorije (Category)
Kategorije:
- imaju naziv  
- podržavaju **beskonačno ugnježdenje** (multi-level)  
- Admin ima CRUD nad kategorijama  
- Front prikaz koristi rekurzivno iscrtavanje stabla kategorija

Klik na kategoriјu prikazuje:
- sve oglase u toj kategoriji  
- sve oglase u svim podkategorijama (rekurzivno)

---

## 3. Uloge i autentifikacija
Uloge:
- **Admin**
- **Customer**

Autentifikacija i registracija su urađeni koristeći:
- Laravel Breeze  
- Email verifikaciju  
- Reset lozinke  

Pravila:
- Customer nakon logina ide na **/dashboard** (lista svojih oglasa)
- Admin nakon logina ide na **/admin/dashboard**
- Gost vidi samo frontend oglasa

Logout je podešen tako da:
- klik “Back” nakon logout-a ne vraća korisnika u app  
(implementiran middleware *PreventBackHistory*)

---

## 4. Frontend (Gost)
Gost vidi:
- početnu stranicu **/home**  
- listu oglasa  
- filtriranje  
- sortiranje  
- sidebar sa kategorijama  
- single oglas prikaz  
- login i register link u navbaru

### Filteri:
- naziv ili opis  
- lokacija  
- stanje (novo/polovno)  
- cena (min/max)  
- sortiranje (najnoviji, najstariji, najskuplji, najjeftiniji)  
- reset filter dugme  

---

# Tehnologije i biblioteke

- PHP 
- Laravel
- Laravel Breeze  
- TailwindCSS  
- Vite  
- Blade templating  
- SQLite / MySQL (mogu oba – migracije su standardne)  

---

# Instalacija i pokretanje projekta

### Kloniraj repozitorijum

git clone https://github.com/MilanStankovic1993/popart-oglasi.git
cd popart-oglasi

### Instaliraj PHP zavisnosti
composer install

### Instaliraj JS pakete
npm install

### Napravi .env fajl
cp .env.example .env

### Generiši app key
php artisan key:generate

### Migracije + seeder-i
php artisan migrate:fresh --seed

Seeder kreira:

- Admin korisnika

- test Customer korisnike

- test kategorije

- test oglase

### Linkuj storage (za slike oglasa)
php artisan storage:link

### Pokreni aplikaciju
php artisan serve

Frontend:
npm run dev

### Admin pristup
Posle seedovanja uloguj se:
Email: admin@example.com
Lozinka: password

### Struktura aplikacije

/app
  /Http
    /Controllers
      /Admin        → Admin CRUD
      /Customer     → Customer oglasi
      /Front        → Oglasi za goste
    /Middleware     → Admin + PreventBackHistory
/models
  Ad.php
  Category.php
  User.php

/resources/views
  /layouts/guest.blade.php     → navbar + frontend layout
  /layouts/app.blade.php       → admin/customer layout
  /front/...                   → home, category, show
  /admin/...                   → dashboard + CRUD
  /customer/...                → dashboard + oglasi

### Dodatni plus funkcionalnosti

sortiranje oglasa po ceni i datumu
reset filtera
reset kategorije
navigacija kroz kategoriјe u sidebaru
automatsko učitavanje oglasa podkategorija
lepa single stranica oglasa sa slikom i kontakt sekcijom
sprečen povratak na stranicu nakon logout-a (cache protection)
