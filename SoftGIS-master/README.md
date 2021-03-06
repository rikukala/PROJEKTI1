## Vaatimukset

- HTTP-palvelin
 - Apachea käytetty
 - Periaatteessa mikä vain, jossa CakePHP toimii
- Tietokantaohjelmisto
 - MySQL:n kanssa käytetty
 - Periaatteessa mikä vain CakePHP:n tukema
- PHP5
- [CakePHP:n vaatimukset](http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Requirements.html)

## Asennusohjeet

1. Asenna HTTP-palvelin, tietokantaohjelmisto ja PHP
2. [Lataa](https://github.com/cakephp/cakephp/archive/1.3.16.zip) ja asenna CakePHP 1.3.16. CakePHP:n yleiset asennusohjeet [löytyvät täältä](http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Installation.html).
3. Lataa SoftGIS paketti [uudempi](https://github.com/rikukala/PROJEKTI1) tai [aiempi versio](https://github.com/GISPROJEKTI/PROJEKTI1).
4. Pura SoftGIS paketti CakePHP:n asennuksen päälle niin että tiedosto `index.php` ja kansio `app/` korvaantuvat.
5. Asetukset
 1. Mene `app/config` kansioon
 2. Nimeä uudelleen `core.php.default` -> `core.php`
 3. Nimeä uudelleen `database.php.default` -> `database.php`
 4. Aseta tietokannan asetukset `database.php` tiedostoon
 5. Aseta oma security salt `core.php` tiedostoon
6. Tietokannan luonti CakePHP:n console työkalulla
 1. Mene `app/` kansioon
 2. Aja käsky `../cake/console/cake schema create -file app.php App`
 3. Käsky luo tietokantaan tarvittavat taulut
 4. [Ohjeita consolen käyttöön](http://book.cakephp.org/1.3/en/The-Manual/Core-Console-Applications.html)
 5. Jos et saa konsolia toimimaan voit luoda tietokannan käsin `Gis tietokannan taulujen luontikomennot.txt` tiedoston avulla.
7. Muut asetukset
 1. Aseta riittävät käyttöoikeudet väliaikaiskansioihin: `app/tmp`, `app/tmp/cache`, `app/tmp/cache/models`, `app/tmp/cache/presistent` ja `app/tmp/cache/views`.
 2. Karttakuvien vientiin tarvitaan oikeudet myös `\app\webroot\img\overlays` -kansioon
 3. Jos sivusto toimii, hyvä. Jos ei, niin voi olla että palvelimesi mod_rewrite (.htaccess) toiminto ei ole käytössä. [Lisätietoja.](http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Installation.html)
  1. Jos sinulla on ongelmia ohjelman asentamisen kanssa, jätä tämän ohjeen kohta 4. 'Pura SoftGIS paketti...' tekemättä ja tee muut kohdat. Tällöin cakePHP:n vakioetusivu opastaa myös hiukan asentamisessa.
8. Voit luoda käyttäjän järjestelmään menemällä osoitteeseen [palvelimesi gis ohjelman asennuspolku]/authors/register. Rekisteröitymiseen tarvittava 'Tunniste' löytyy ohjelman asennushakemiston tiedostosta app/controllers/authors_controller.php, riviltä 26, muuttujan $secret arvo. Tämä samainen tunniste kannattaa muuttaa joksikin muuksi, että kuka tahansa ohjelman tunteva ei voi rekisteröidä uutta käyttäjää ohjelmaasi.


## Tietoturva
- SQL injektioiden esto:
 - CakePHP:n vakoturva: http://book.cakephp.org/1.3/en/The-Manual/Common-Tasks-With-CakePHP/Data-Sanitization.html#data-sanitization


