<div class="egesz">
    <div class ="rolunk">
        <h1>Bagaméri AutóVillamosság</h1>
        <p> Márkafüggetlen szakszervízünk több mind 30 éve foglalkozik Nyíregyházán autóvillamossági gondok elhárításával. Legyen szó bármely típusú személy- és teher gépjárművek elektromos javításáról. </p>
    </div>

    <div class="rolunk">
        <ul>
            <li>Használt, -és új akkumulátorok értékesítése, beszerelése, régi beszámítása</li>
            <li>Lámpaizzó cseréi, és rögzítés ellenőrzés</li>
            <li>Indítómotorok, generátorok ki-beszerelése, javítása, cseréje</li>
            <li>Autóriasztók, indításgátlók, titkos kapcsolók beszerelése</li>
            <li>Utólagos tolatóradarok beszerelése</li>
            <li>Ablakemelő szerkezetek ki-beszerelése, javítása, cseréje</li>
            <li>Rádió, autó hifi rendszerek beépítése, cseréje</li>
            <li>Számítógépes diagnosztika, speciális műszeres mérések, hibakód olvasás-feltárás, élő-adat mérés</li>
            <li>Központizár javítás</li>
            <li>Lámpapolírozás</li>
            <li>Általános szervíz</li>
        </ul>
    </div>

    <div class ="rolunk">
        <p>Bármilyen kérdése felmerült, nem találja a listában az Ön autójának esetleges hibáját, vagy érdeklődne, hívjon minket bátran!</p>
    </div>

    <div class="main">
        <div id="pop">
            <button id="close">X</button>
            <p>Használt akkumulátorainkra is vállalunk garanciát, keressen minket szervízünkben, vagy telefonon!</p>
            <a href="akkumulatorok.php">Megnézem</a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function(){

        function showPopup(){
            $(".main").show();
            $("html body").css("overflow", "hidden");
            setTimeout(hidePopup, 30000);
        }

        function hidePopup(){
            $(".main").hide();
            $("html body").css("overflow", "auto");
        }

        setTimeout(showPopup, 5000);

        $("#close").click(function(){
            hidePopup(); 
        })
    })
</script>