# Projekat iz Web Programiranja - upravljanje softverskom kompanijom

###Logovanje

Username/email: admin@gmail.com
Password: admin

Glavna ideja projekta bila je implementirati landing stranicu softverske kompanije, koja ce u pozadini sadrzati kompleksniju web aplikaciju pomocu koje bi administrator mogao da upravlja profilima radnika, zadacima i radnim mestima. 

### Baza

Implementirana je MySQL baza sa EER dijagramom kao na slici dole:

![Structure](https://raw.githubusercontent.com/kobrica/PHPCompanyManagement/master/Divine%20AI/Database/Structure.png)

Sama struktura baze je takva da su sve tabele povezane (direktno ili indirektno) sa tabelom RADNIK .
Omoguceno je u tabeli skladistiti osnovne podatke o radniku koje on moze direktno menjati, ali i neke fiksne podatke kojima je dozvoljen pristup jedino administratoru, ili cak ni njemu (npr. datum zaposlenja je fiksan, a platu moze menjati iskljucivo admin).

Skladisti se jos podatak o svim radnim mestima, kako bi i nad radnicima i nad radnim mestima bilo moguce implementirati CRUD operacije.

Pre pokretanja projekta, neohodno je podesiti bazu sa sledecim podacima:

$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'business';

### Struktura aplikacije

Aplikacija je radjena tako da omoguci tri nivoa pristupa, a zasebno je organizovana u foldere koji sadrze fajlove relevantne za datog korisnika:

**landing** folder - Odnosi se na pocetnu stranicu i sve stranice kojima gost moze da ima pristup (kontakt, login, zaboravljena lozinka).

**user** folder - Sve skripte kojima moze da pristupi korisnik (vidi i menja odredjena polja svog profila za koje ima permisiju, i vidi listu dostupnih taskova).

**admin** folder - Ima sve privilegije. Dodaje, uklanja i menja korisnike i radna mesta, vidi listu taskova, dashboard sa vizuelizacijama isplacenih i neisplacenih radnika i tabelu neisplacenih radnika.

### Dashboard

Implementiran pomocu Google alata za vizuelizaciju i Datatables, sadrzi opcije preuzimanja u XLS i PDF format.


