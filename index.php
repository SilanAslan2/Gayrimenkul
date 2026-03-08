<?php
error_reporting(0);
ini_set('display_errors', 0);
?>

<?php
include("baglanti.php");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Silan Gayrimenkul</title>

<style>
body{
margin:0;
font-family:Arial;
background:#f2f2f2;
}

.site{
width:1000px;
margin:auto;
background:#fff;
}

.kapak img{
width:100%;
height:280px;
object-fit:cover;
}

.firma-alan{
display:flex;
align-items:center;
padding:20px;
border-bottom:2px solid #0a4da3;
}

.logo{
width:200px;
height:200px;
margin-right:20px;
}

.menu{
background:#0a4da3;
padding:15px;
text-align:center;
}

.menu a{
color:white;
margin:0 20px;
font-weight:bold;
text-decoration:none;
cursor:pointer;
}

.baslik{
text-align:center;
margin:40px 0 20px;
}
.ilan{
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 15px;
    border-bottom: 1px solid #ddd;
    box-sizing: border-box;
    width: 100%;
}

.ilan-resim{
    width: 180px;
    height: 130px;
    object-fit: cover;
    flex-shrink: 0;
    border-radius: 6px;
    cursor: pointer;
}

.ilan-yazi{
    flex: 1;
    line-height: 1.6;
}

.ilan-yazi span{
    font-weight: bold;
    color: #0a4da3;
}
.ilan-aciklama{
    margin-top: 8px;
    color: #555;
    font-size: 14px;
}
.ilan-liste{
    width: 100%;
}


.hizli-ara{
display:flex;
flex-wrap:wrap;
justify-content:center;
padding:20px;
}

.hizli-ara button{
width:200px;
margin:10px;
padding:12px;
background:#0a4da3;
color:white;
border:none;
cursor:pointer;
}

.ekip{
padding:30px;
}

.kisi{
display:flex;
align-items:center;
border:1px solid #ddd;
padding:15px;
margin-bottom:20px;
}

.kisi img{
width:100px;
height:100px;
margin-right:20px;
}

.kisi-bilgi{
background:#f7f7f7;
padding:15px;
width:100%;
}

.kisi-bilgi p{
margin:5px 0;
}


.form{
padding:30px;
}

.form input,.form textarea{
width:100%;
padding:12px;
margin-bottom:15px;
}

.form button{
padding:10px 30px;
background:#0a4da3;
color:white;
border:none;
}

.detay{
display:none;
padding:30px;
border-top:2px solid #0a4da3;
}

.detay-icerik{
display:flex;
}

.detay img{
width:400px;
margin-right:30px;
}

.detay p{
color:#0a4da3;
font-weight:bold;
margin:10px 0;
}
</style>
</head>

<body>



<div class="site">
<div class="kapak"><img src="istanbul havalimani.png"></div>
<div class="firma-alan">
<img src="silanGayrimenkul.png" class="logo">
<div>
<h1>Silan Gayrimenkul</h1>
<p>İstanbul</p>
<p>Pörtföyümüz: 100 ilan</p>
<p>Çalıştığımız Bölgeler: İstanbul - Edirne - Kırklareli</p>
</div>
</div>
<div class="menu">
<a onclick="scrollToSection('ilanlar')">Tüm İlanlarımız</a>
<a onclick="scrollToSection('onecikan')">Öne Çıkanlar</a>
<a onclick="scrollToSection('ekip')">Ekibimiz</a>
<a onclick="scrollToSection('iletisim')">Hakkımızda</a>
</div>
<h2 class="baslik" id="ilanlar">TÜM İLANLAR</h2>
<div class="ilan-liste">
<?php
$sorgu = mysqli_query($baglan,"SELECT * FROM emlak");

while($ilan = mysqli_fetch_assoc($sorgu)){
?>
    <div class="ilan">

        <img 
            src="<?php echo !empty($ilan['resim']) ? htmlspecialchars($ilan['resim']) : 'resim-yok.png'; ?>" 
            class="ilan-resim"
            onclick="detayGoster(
                '<?php echo !empty($ilan['resim']) ? $ilan['resim'] : 'resim-yok.png'; ?>',
                'İlan No: <?php echo $ilan['id']; ?>',
                '<?php echo $ilan['fiyat']; ?>',
                '<?php echo $ilan['metrekare']; ?>',
                '',
                '<?php echo addslashes($ilan['aciklama']); ?>'
            )"
        >

        <div class="ilan-yazi">
            <div><strong>İlan No:</strong> <?php echo $ilan['id']; ?></div>
            <div><strong>Fiyat:</strong> <?php echo $ilan['fiyat']; ?></div>
            <div><strong>m²:</strong> <?php echo $ilan['metrekare']; ?></div>

         
            <div class="ilan-aciklama">
                <?php echo nl2br(htmlspecialchars($ilan['aciklama'])); ?>
            </div>
        </div>

    </div>
<?php } ?>
</div>


<h2 class="baslik" id="onecikan">PÖRTFÖYDE HIZLI ARA</h2>
<div class="hizli-ara">
<button onclick="filtre('daire')">SATILIK DAİRE</button>
<button onclick="filtre('villa')">SATILIK VİLLA</button>
<button onclick="filtre('tarla')">SATILIK TARLA</button>
<button onclick="filtre('tum')">TÜMÜ</button>
</div>
<h2 class="baslik" id="ekip">EKİBİMİZ</h2>
<div class="ekip">
<div class="kisi"><img src="adam, - Kopya.avif"><p><b>OĞUR SAĞLAM</b></p><p>Ofis Sahibi</p><p>Pörtföy: 3 ilan</p></div>
<div class="kisi"><img src="adam3 - Kopya.jpeg"><p><b>UFUK ALTIN</b></p><p>Gayrimenkul Danışmanı</p><p>Pörtföy: 2 ilan</p></div>
</div>
<h2 class="baslik" id="iletisim">İLETİŞİM FORMU</h2>
<form method="post" action="iletisim.php" class="form">
<input type="text" name="ad" placeholder="Adınız" required>
<input type="text" name="soyad" placeholder="Soyadınız" required>
<input type="text" name="telefon" placeholder="Cep Telefonu" required>
<input type="email" name="email" placeholder="E-Posta" required>
<textarea name="mesaj" placeholder="Mesaj" required></textarea>
<button type="submit">Gönder</button>
</form>
<div class="detay" id="detay">
<h2 class="baslik">İLAN DETAYI</h2>
<div class="detay-icerik">
<img id="detayResim">
<div>
<p id="detayBaslik"></p>
<p id="detayFiyat"></p>
<p id="detayMetrekare"></p>
<p id="detayKonum"></p>
<p id="detayAciklama"></p>
</div>
</div>
</div>
</div>
<script>
function detayGoster(resim,baslik,fiyat,metrekare,konum,aciklama){
document.getElementById("detayResim").src=resim;
document.getElementById("detayBaslik").innerText=baslik;
document.getElementById("detayFiyat").innerText="Fiyat: "+fiyat;
document.getElementById("detayMetrekare").innerText="m²: "+metrekare;
document.getElementById("detayKonum").innerText="Konum: "+konum;
document.getElementById("detayAciklama").innerText="Açıklama: "+aciklama;
document.getElementById("detay").style.display="block";
window.scrollTo(0,document.body.scrollHeight);
}
function scrollToSection(id){document.getElementById(id).scrollIntoView({behavior:"smooth"});}
function filtre(tur){document.querySelectorAll(".ilan").forEach(i=>i.style.display="flex");}
</script>





</body>

</html>
