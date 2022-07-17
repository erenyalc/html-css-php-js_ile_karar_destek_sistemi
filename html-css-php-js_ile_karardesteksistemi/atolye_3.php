<?php
include("auth_session.php");
$baglanti=mysqli_connect('localhost', 'root', '', 'kds_mvt');
mysqli_set_charset($baglanti, "utf8");
if($baglanti){
	echo 'bağlandı';
} else{
	die('bağlantı sağlanamadı');
}

$mbtablosu="SELECT SUM(maas_tablosu.maas) as maasi, maas_tablosu.maas_yili as yili
FROM maas_tablosu, calisanlar, atolyeler, bolum
WHERE maas_tablosu.calisan_id=calisanlar.calisan_id AND calisanlar.atolye_id=atolyeler.atolye_id and calisanlar.bolum_id=bolum.bolum_id AND calisanlar.atolye_id=4
GROUP BY maas_tablosu.maas_yili";
    $mbsonuc=mysqli_query($baglanti,$mbtablosu);

$stur='SELECT (sum(stoktaki_urunler.stokta_kalan_sayi)/sum(atolye_urun.uretilen_sayi))*100 as sayı, atolye_urun.yil as yil FROM atolye_urun, stoktaki_urunler, atolyeler WHERE atolyeler.atolye_id=atolye_urun.atolye_id AND atolyeler.atolye_id=3 GROUP BY atolye_urun.yil';
    $sturra= mysqli_query($baglanti,$stur);

$a1='SELECT (urun.urun_fiyati*atolye_urun.satilan_sayi) as sayi, atolye_urun.ay as ay
FROM urun, atolye_urun
WHERE atolye_urun.yil=2020 AND atolye_urun.atolye_id=3
GROUP BY atolye_urun.ay
order by ay asc';
    $a11= mysqli_query($baglanti,$a1);

$a2='SELECT (urun.urun_fiyati*atolye_urun.satilan_sayi) as sayi, atolye_urun.yil as yil
FROM urun, atolye_urun, atolyeler
WHERE atolye_urun.urun_id=urun.urun_id and atolye_urun.atolye_id=atolyeler.atolye_id and atolyeler.atolye_id= 3
GROUP BY atolye_urun.yil
order by sayi asc';
    $a22=mysqli_query($baglanti,$a2);

$topl='SELECT SUM(urun.urun_fiyati*atolye_urun.satilan_sayi) as toplama
FROM urun, atolye_urun, atolyeler
WHERE atolye_urun.urun_id=urun.urun_id AND atolye_urun.atolye_id=atolyeler.atolye_id AND atolyeler.atolye_id=3';
    $toplaml=mysqli_query($baglanti,$topl);

$car="SELECT sum((makineler.yillik_bakim_fiyati)*atolye_makine.adet) as carpim
FROM atolye_makine, makineler
WHERE atolye_makine.makine_id=makineler.makine_id AND atolye_makine.atolye_id=3";
    $carpi=mysqli_query($baglanti, $car);
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


<div class='solbar'>
    <div class='at'>
    <i class="fas fa-hotel"></i>
    <a href='atolye_genel.php'>Atölyeler</a>
    </div>
    <div class='yen'>
    <i class="fas fa-globe-europe"></i>
    <a href='yatolye_1.php'>Yeni Atölyeler</a>
    </div>
</div>
<br>
<br>
<div class='soba'>
    <div class='yazi1'>
        <a href='atolye_genel.php'>Atölyeler Genel</a>
        <br>
        <br>
        <a href='atolye_1.php'>Güven Atölye</a>
        <br>
        <br>
        <a href='atolye_2.php'>Masif Atölye</a>
        <br>
        <br>
        <a href='atolye_3.php'>Murat Atölye</a>
        <br>
        <br>
        <a href='atolye_4.php'>Elit Atölye</a>
    </div>
</div>
<div class='ustbar'>
    <i class="fas fa-couch"></i>
    <i class="fas fa-sign-out-alt"></i>
    <span class=basliik>NORMAL MOBİLYA</span>
    <br><br>
    <span class='cik'>
    <a href='logout.php'>ÇIKIŞ</a></span>
</div>
<form action='atolye_genel.php' method='POST'>
</form>

<div class='ch1'>
<div id="charti"></div>
    <script>
$(function(){
    $("#charti").dxChart({
        dataSource: dataSource2, 
        series: {
            argumentField: "yili",
            valueField: "maasi",
            name: "Yıllık Maaşlar",
            type: "bar",
            color: '#ff3131'
        }
    });
});
var dataSource2 = [
    <?php 
    while($row2 =mysqli_fetch_array($mbsonuc))
    {
        $yili = $row2["yili"];
        $maasi = $row2["maasi"];
        echo "".'{'."".'yili'."".':'."".'"'."".$yili."".'"'."".','."".'maasi'."".':'."".'"'."".$maasi."".'"'."".'},'."";
        
    }?>
];

</script></div>

<div id="pied"></div>
<script>
$(function(){
    $("#pied").dxPieChart({
        size: {
            width: 500
        },
        palette: "bright",
        dataSource: dataSource,
        series: [
            {
                argumentField: "yil",
                valueField: "sayı",
                label: {
                    visible: true,
                    connector: {
                        visible: true,
                        width: 1
                    }
                }
            }
        ],
        title: "Stok/Üretilen Ürün Miktarı",
        "export": {
            enabled: true
        },
        onPointClick: function (e) {
            var point = e.target;
    
            toggleVisibility(point);
        },
        onLegendClick: function (e) {
            var arg = e.target;
    
            toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
        }
    });
    
    function toggleVisibility(item) {
        if(item.isVisible()) {
            item.hide();
        } else { 
            item.show();
        }
    }
});
var dataSource = [
    <?php 
    while($row1 =mysqli_fetch_array($sturra))
    {
        $sayı = $row1["sayı"];
        $yil = $row1["yil"];
        echo "".'{'."".'sayı'."".':'."".'"'."".$sayı."".'"'."".','."".'yil'."".':'."".$yil."".'},'."";
        
    }?>

];
</script>

<div class='aylik'>
<canvas id="ayi"></canvas>
<script>
var ctx = document.getElementById('ayi').getContext('2d');
var ayi = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['1', '2','3','4','5','6','7','8','9','10','11','12'],
        datasets: [{
            label: '2020 yılında ürünlerden ne kadar kazanıldı',
            data: [<?php 
    while($row5 =mysqli_fetch_array($a11))
    {
        $sayi = $row5["sayi"];
        $ay = $row5["ay"];
        echo "".$sayi."".','."";
        
    }?>],
            backgroundColor: [
                'rgb(29,178,245)',
                'rgb(245,86,74)',
                'rgb(29,178,245)',
                'rgb(245,86,74)',
                'rgb(29,178,245)',
                'rgb(245,86,74)',
                'rgb(29,178,245)',
                'rgb(245,86,74)',
                'rgb(29,178,245)',
                'rgb(245,86,74)',
                'rgb(29,178,245)',
                'rgb(245,86,74)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</div>

<div class='an'>
<canvas id="myChart"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['2019', '2020'],
        datasets: [{
            label: 'Ürünlerden ne kadar kazanıldı',
            data: [<?php 
    while($row5 =mysqli_fetch_array($a22))
    {
        $sayi = $row5["sayi"];
        $yil = $row5["yil"];
        echo "".$sayi."".','."";
        
    }?>],
            backgroundColor: [
                'rgb(233,127,2)',
                'rgb(112,201,47)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

</div>
<div class='top'>
    <span class='falan'> Toplam Gelir:
    <?php 
    while($row5 =mysqli_fetch_array($toplaml))
    {
        $toplama = $row5["toplama"];
        echo $toplama;
        
    }?>
    </span>
</div>
<div class='ort'>
<span class=ortyaz>
        Yıllık Makine Bakım Fiyatı:
        <?php 
    while($row54 =mysqli_fetch_array($carpi))
    {
        $carr = $row54["carpim"];
        echo $carr;
        
    }?>
    </span>
</div>
</body>
</html>