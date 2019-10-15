# Projekat iz Web Programiranja - upravljanje softverskom kompanijom

Glavna ideja projekta bila je implementirati landing stranicu softverske kompanije, koja ce u pozadini sadrzati kompleksniju web aplikaciju pomocu koje bi administrator mogao da upravlja profilima radnika, zadacima i radnim mestima. 

### Baza

Implementirana je MySQL baza sa EER dijagramom kao na slici dole:

![Structure](https://raw.githubusercontent.com/kobrica/PHPCompanyManagement/master/Divine%20AI/Database/Structure.png)

Sama struktura baze je takva da su sve tabele povezane (direktno ili indirektno) sa tabelom * *radnik* * .
Omoguceno je u tabeli skladistiti osnovne podatke o radniku koje on moze direktno menjati, ali i neke fiksne podatke kojima je dozvoljen pristup jedino administratoru, ili cak ni njemu (npr. datum zaposlenja je fiksan, a platu moze menjati iskljucivo admin).
