<?php
$baglanti=mysqli_connect('localhost', 'root', '', 'kds_mvt');
mysqli_set_charset($baglanti, "utf8");
if($baglanti){
	echo 'bağlandı';
} else{
	die('bağlantı sağlanamadı');
}

$ma1 = $_POST['ma1'];
$ma2 = $_POST['ma2'];
$ma3 = $_POST['ma3'];
$ma4 = $_POST['ma4'];
$ma5 = $_POST['ma5'];

    $sqlcalisan="INSERT INTO calısan_veri_girisi(marangoz, dokumacı, montaj, cila, iskelet) 
    VALUES ('$ma1', '$ma2', '$ma3', '$ma4', '$ma5')";
    $calisa= mysqli_query($baglanti, $sqlcalisan);

$ba1 = $_POST['ba1'];
$ba2 = $_POST['ba2'];
$ba3 = $_POST['ba3'];
$ba4 = $_POST['ba4'];
$ba5 = $_POST['ba5'];
$ba6 = $_POST['ba6'];
$ba7 = $_POST['ba7'];

    $sqlmakine="INSERT INTO makine_veri_giris(CNC, Toz, Lazer, Zımpara, Kenar, Gönye, Çoklu) 
    VALUES ('$ba1', '$ba2', '$ba3', '$ba4', '$ba5', '$ba6', '$ba7')";
    $makin= mysqli_query($baglanti, $sqlmakine);

$ta1 = $_POST['ta1'];
$ta2 = $_POST['ta2'];
$ta3 = $_POST['ta3'];
$ta4 = $_POST['ta4'];
$ta5 = $_POST['ta5'];
$ta6 = $_POST['ta6'];
$ta7 = $_POST['ta7'];

    $sqlurun="INSERT INTO urun_veri_girisi(sandalye, masa, dolap, kitaplık, baza, tvu, vitrin) 
    VALUES ('$ta1', '$ta2', '$ta3', '$ta4', '$ta5', '$ta6', '$ta7')";
    $uru= mysqli_query($baglanti, $sqlurun);


$calis='SELECT calisan_veri_cikisi.marangozz+ calisan_veri_cikisi.dokumacıı+ calisan_veri_cikisi.montajj+ calisan_veri_cikisi.cilaa+ calisan_veri_cikisi.iskelett as toplamq 
FROM calisan_veri_cikisi 
WHERE calisan_veri_cikisi.id= (SELECT max(calisan_veri_cikisi.id) FROM calisan_veri_cikisi)';
    $cal= mysqli_query($baglanti,$calis);

$makinn='SELECT makine_veri_cikis.cncc+ makine_veri_cikis.tozz+ makine_veri_cikis.lazerr+ makine_veri_cikis.zımparaa+ makine_veri_cikis.kenarr+ makine_veri_cikis.gönyee+ makine_veri_cikis.çokluu as makinee 
FROM makine_veri_cikis 
WHERE makine_veri_cikis.id=(SELECT max(makine_veri_cikis.id) FROM makine_veri_cikis)';
    $makiner= mysqli_query($baglanti,$makinn);

$url="SELECT urun_veri_cikisi.sandalyee+ urun_veri_cikisi.masaa+ urun_veri_cikisi.dolapp+ urun_veri_cikisi.kitaplıkk+ urun_veri_cikisi.bazaa+ urun_veri_cikisi.tvuu+ urun_veri_cikisi.vitrinn as urtoplam 
FROM urun_veri_cikisi 
WHERE urun_veri_cikisi.id=(SELECT max(urun_veri_cikisi.id) FROM urun_veri_cikisi)";
    $urunler= mysqli_query($baglanti, $url);

$urlla="SELECT (urun_veri_cikisi.sandalyee+ urun_veri_cikisi.masaa+ urun_veri_cikisi.dolapp+ urun_veri_cikisi.kitaplıkk+ urun_veri_cikisi.bazaa+ urun_veri_cikisi.tvuu+ urun_veri_cikisi.vitrinn)*12 as urtoplamm 
FROM urun_veri_cikisi 
WHERE urun_veri_cikisi.id=(SELECT max(urun_veri_cikisi.id) FROM urun_veri_cikisi)";
    $urunlerr= mysqli_query($baglanti, $urlla);

$caliss='SELECT (calisan_veri_cikisi.marangozz+ calisan_veri_cikisi.dokumacıı+ calisan_veri_cikisi.montajj+ calisan_veri_cikisi.cilaa+ calisan_veri_cikisi.iskelett)*12 as toplamw
FROM calisan_veri_cikisi 
WHERE calisan_veri_cikisi.id= (SELECT max(calisan_veri_cikisi.id) FROM calisan_veri_cikisi)';
    $caall=mysqli_query($baglanti, $caliss);

$makinelesmek='SELECT makine_bakım_hesaplama.cnc+ makine_bakım_hesaplama.toz+ makine_bakım_hesaplama.lazer+ makine_bakım_hesaplama.zımpara+ makine_bakım_hesaplama.kenar+ makine_bakım_hesaplama.gonye+ makine_bakım_hesaplama.coklu as makinem 
FROM makine_bakım_hesaplama 
WHERE makine_bakım_hesaplama.id=(SELECT max(makine_bakım_hesaplama.id) FROM makine_bakım_hesaplama)';
    $makinem=mysqli_query($baglanti, $makinelesmek);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="KDS">
<link href="tasarim.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/20.2.4/js/dx.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>

<div class="sonuc">
<span class='fal'> Aylık Çalışan Gideri:
    <?php 
    while($row2 =mysqli_fetch_array($cal))
    {
        $toplama = $row2["toplamq"];
        echo $toplama;
        
    }?>
    </span>
</div>
<div class="sonuv">
<span class='fal'> Makine Gideri:
    <?php 
    while($row7 =mysqli_fetch_array($makiner))
    {
        $topluarama = $row7["makinee"];
        echo $topluarama;
        
    }?>
    </span>
</div>

<div class="sonub">
<span class='fal'> Aylık Kazanç (Hepsi satılırsa):
    <?php 
    while($row5 =mysqli_fetch_array($urunler))
    {
        $toparlama = $row5["urtoplam"];
        echo $toparlama;
        
    }?>
    </span>
</div>

<div class="sonux">
<span class='fal'> Yıllık Kazanç (Hepsi satılırsa):
    <?php 
    while($row12 =mysqli_fetch_array($urunlerr))
    {
        $toplasma = $row12["urtoplamm"];
        echo $toplasma;
        
    }?>
    </span>
</div>

<div class="sonuz">
<span class='fal'> Yıllık Çalışan Gideri:
    <?php 
    while($row13 =mysqli_fetch_array($caall))
    {
        $toplasma = $row13["toplamw"];
        echo $toplasma;
        
    }?>
    </span>
</div>

<div class="sonua">
<span class='fal'> Yıllık Makine Bakım Giderleri:
    <?php 
    while($row15 =mysqli_fetch_array($makinem))
    {
        $toplasma = $row15["makinem"];
        echo $toplasma;
        
    }?>
    </span>
</div>

<table class="sonlamak" border='1'>
<tr>
    <td>Vizyon Atölyesi Giderleri:</td>
    <td>48500tl</td>
</tr>
<tr>
    <td>Boşluk Atölyesi Giderleri:</td>
    <td>86600tl</td>
</tr>
<tr>
    <td>Taş Atölyesi Giderleri:</td>
    <td>185500tl</td>
</tr>
</table>
<div>
    <span class="butluk">Bütçe: 220000tl</span>
</div>


<div class="denn">
<span class="denne">
</span>
</div>
<div class='solbar'>
    <div class='at'>
    <i class="fas fa-hotel"></i>
    <a href='atolye_genel.php'>Atölyeler</a>
    </div>
    <div class='yen'>
    <i class="fas fa-globe-europe"></i>
    <a href='yatolye_1'>Yeni Atölyeler</a>
    </div>
</div>
<br>
<br>
<div class='soba'>
    <div class='yazi1'>
        <a href='atolye_genel.php'>Atölyeler Genel</a>
        <br>
        <br>
        <a href='yatolye_1.php'>Vizyon</a>
        <br>
        <br>
        <a href='yatolye_2.php'>Boşluk</a>
        <br>
        <br>
        <a href='yatolye_3.php'>Taş</a>
    </div>
</div>
<div class='ustbar'>
    <i class="fas fa-couch"></i>
    <span class=basliik>NORMAL MOBİLYA</span>
    <br><br>
    <span class='cik'>
    <i class="fas fa-sign-out-alt"></i>
    <a href='logout.php'>ÇIKIŞ</a></span>
</div>

</body>
</html>