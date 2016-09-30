Web trgovina u php-u
===================


Koncept izrade funkcionalnog web-shopa od nule
----------

Aplikacija sadrzi:

**za sve**

 - dvije klase korisnika (kupac i administrator trgovine)
 - sistem prijave/odjave/registracije
 - lijevi vertikalni izbornik (kategorije proizvoda i newsletter)
 - gornji horizontalni izbornik (navigacija aplikacijom, trazilica, novosti)
 - sistem paginacije

![naslovnica](/tut/1.PNG)

**za kupca**

 - kosarica u verikalnom izborniku
 - mogucnost narudzbi
 - mogucnost pregleda i izmjene vlastitih informacija

![user](/tut/check.PNG)

**za admina**

 - postavljanje informacija o trgovini
 - crud za proizvode i clanke
 - postavljanje akcija
 - pregled narudzbi

![admin](/tut/crud.PNG)

>Aplikacija ne sadrzi:
>
 - payment sistem (kupovina nakon checkouta se odvija putem emaila)
 - nista iznad najosnovnije razine sigurnosti


#### <i class="icon-file"></i> Kupovina

Kupac ima mogucnost filtrirati proizvode putem odabirom kategorije ili pretrazivanjem kroz trazilicu. Trazilica, sama, zahtjeva minimalno tri znaka kako bi mogla uspjesno izlistati proizvode.
Klikom na proizvod, kupac je preusmjeren na stranicu sa detaljima tog artikla (naziv, kategorija, opis, slika, cijena/akcijska cijena, te broj dostupnih komada).
Ukoliko korisnik ne zeli poslovati u kunama moze odabrati jos dvije valute (USD, EUR) kojima se tecaj, preko ajaxa, povlaci s Europske Sredisnje Banke.
Nakon sto je korisnik odabrao artikle koje zeli u kosarici, te definirao zeljenu kolicinu, nastavlja s procesom kupnje tako sto unosi adresu za dostavu te poruku s posebnim zahtjevima (ako ih ima).
Po zavrsetku kupnje, kupcu, na email stize racun u pdf formatu.
> Za generiranje racuna koristi se biblioteka fpdf

![racun](/tut/racun.PNG)

#### <i class="icon-file"></i> Novosti

Aplikacija sadrzi sistem clanaka kojih kupci mogu pregledavati, ali njihovo stvaranje je povlastica administratora. Sistem automatski prepoznaje ako se u clanu nalazi web adresa (regex) te ju automatski pretvara u hiperlink.  

![clanci](/tut/novosti.PNG)


