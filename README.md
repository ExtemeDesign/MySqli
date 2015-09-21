# Mysqli

Klasa za rad sa MySql bazama.

## Podesavanja
Klasu mozete pozvati sa direktno ili predhodno postavljenim parametrima:

```php
    $host       =   "localhost";
    $username   =   "username";
    $password   =   "sifra";
    $baza       =   "dbname";
```
   
## Pozivanje

```php
$db = new SQL ($host, $username, $password, $baza);
```


## Citanje iz baze
```php
$uslov=$db->uslov("id=1"); 	// postavlja uslov
$test=$db->procitaj("*","test","id"); // cita iz baze uz predhodno postavljen uslov, i na kraju ga ponistava
$drugi= $db->procitaj("*","test","id"); // cita iz baze bez uslova
```

## Dodavanje u bazu


```php
$zaDodavanje=array(
    'id' => NULL,
    'code'=>'trojka',
    'name'=>'TRECE'
);
$db->dodaj("test",$zaDodavanje);
```

## Izmena
```php
$uslov=$db->uslov("id=1"); 	// postavlja uslov
$izmena =array(
	'code'=>'izmenjenKOD'
	);

$uslov=$db->uslov("id=4"); 
$db->izmeni("test",$izmena);
```

## Brisanje
```php
$uslov=$db->uslov("id=7"); 
$db->obrisi("test");
```
* To su samo neki od primera, kombinovanjem kodova i uz malo maste moguce je postici sve vezano za komunikaciju sa MySql bazama.
