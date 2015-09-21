# MySqli
Mysql(i) class

<b>Klasa za rad sa MySql bazama.</b><br/>
Citanje iz baze<br/><br/>
<code>
$db = new SQL ($host, $username, $password, $baza); // poziva klasu<br/>

$uslov=$db->uslov("id=1"); 	// postavlja uslov<br/>

$test=$db->procitaj("*","test","id"); // cita iz baze uz predhodno postavljen uslov, i na kraju ga ponistava<br/>

$drugi= $db->procitaj("*","test","id"); // cita iz baze bez uslova<br/><br/>
</code>


DODAVANJE U BAZU<br/>
<code>

$zaDodavanje=array(
    'id' => NULL,
    'code'=>'trojka',
    'name'=>'TRECE'
);
$db->dodaj("test",$zaDodavanje);

</code>


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
