# MySqli
Mysql(i) class

Klasa za rad sa MySql bazama.
Citanje iz baze

$db = new SQL ($host, $username, $password, $baza); // poziva klasu
$uslov=$db->uslov("id=1"); 	// postavlja uslov
$test=$db->procitaj("*","test","id"); // cita iz baze uz predhodno postavljen uslov, i na kraju ga ponistava
$drugi= $db->procitaj("*","test","id"); // cita iz baze bez uslova


DODAVANJE U BAZU

$zaDodavanje=array(
    'id' => NULL,
    'code'=>'trojka',
    'name'=>'TRECE'
);
$db->dodaj("test",$zaDodavanje);



IZMENE
$uslov=$db->uslov("id=1"); 	// postavlja usl
$izmena =array(
	'code'=>'izmenjenKOD'
	);

$uslov=$db->uslov("id=4"); 
$db->izmeni("test",$izmena);


BRISANJE

$uslov=$db->uslov("id=7"); 
$db->obrisi("test");
