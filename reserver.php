<?php
    require_once 'inc/header-html.php';
    require_once 'class/Calendar.php';
    require_once 'class/Reservation.php';

?>
<section class="container margin-top">
    <form action="" class="row" method="POST"><!-- formulaire de réservation -->
        <div class="col-md-4"></div>
        <div id="form-res" class="col-md-4 col-12">
            
        <div class="form-floating mb-3">
            <input
                type="date"
                class="form-control" id="dte" name="dte" id="Label" placeholder="" value="<?php if(isset($_POST['valider'])){echo $_POST['dte'];}else{echo date('Y-m-d');}?>">
            <label for="dte">Date de réservation</label>
        </div>
        <div class="form-floating mb-3">
            <select name="hour" id="hre" class="form-select" required>
                <option value="<?php if(isset($_POST['valider'])){ echo $_POST['hour'];}else{echo '20:00';}?>"><?php if(isset($_POST['valider'])){ echo $_POST['hour'];}else{echo '20:00';}?></option>
                <?php
                    $rs_hour = $conn->prepare('SELECT h.`id_hour` `id`, h.`des_hour` `des` FROM `hour` h');
                    $rs_hour->execute();
                    foreach($rs_hour as $hour) : 
                ?>
                    <option value="<?=$hour['des']?>"><?=$hour['des']?></option>
                <?php endforeach ?>
            </select>
            <label for="hour">heure</label>
        </div>
            <div class="form-floating mb-3">
            <select name="table" id="table" class="form-select" required>
                <option value=""></option>
                <option <?php if(isset($_POST['valider']) && $_POST['table'] == 1){ echo 'selected';}?> value="1">Table de 2</option>
                <option <?php if(isset($_POST['valider']) && $_POST['table'] == 2){ echo 'selected';}?> value="2">Table de 4</option>
                <option <?php if(isset($_POST['valider']) && $_POST['table'] == 3){ echo 'selected';}?> value="3">Table de 6</option>
                <option <?php if(isset($_POST['valider']) && $_POST['table'] == 4){ echo 'selected';}?> value="4">Table de 8</option>
            </select>
            <label for="table">Sélectionnez une table</label>
            </div>
            <button type="submit" id="valider_res" class="btn btn-success btn-max" name="valider">Valider</button>
        </div>
        
        <div class="col-md-4"></div>
    </form><!-- fin du formulaire de réservation -->
    <hr>
    <section id="reservation" class="row text-center my-5">
        <div class="col-md-3 col-12"><h3>Table de 2</h3>
        <?php
           $table2 = new Reservation;
           for($i = 0;$i <= TABLE2; $i++){
               $table2->add_table(DATE_DEFF,HEURE_DEFF,TABLE2,$i,TABLE_2_SELECT);
           }
        ?>
        </div>
        <div class="col-md-3 col-12">
            <h3>Table de 4</h3>
            <?php
                $table4 = new Reservation;
                for($i = 0;$i < TABLE4; $i++){
                    $table4->add_table(DATE_DEFF,HEURE_DEFF,TABLE4,$i,TABLE_4_SELECT);
                }
            ?>
        </div>
        <div class="col-md-3 col-12">
            <h3>Table de 6</h3>
            <?php
                $table6 = new Reservation;
                for($i = 0;$i < TABLE6; $i++){
                    $table6->add_table(DATE_DEFF,HEURE_DEFF,TABLE6,$i,TABLE_6_SELECT);
                }
            ?>
        </div>
        <div class="col-md-3 col-12">
            <h3>Table de 8</h3>
            <?php
                $table8 = new Reservation;
                for($i = 0;$i < TABLE8; $i++){
                    $table8->add_table(DATE_DEFF,HEURE_DEFF,TABLE8,$i,TABLE_8_SELECT);
                }
            ?>
        </div>
    </section>
</section>
<?php
    include_once 'inc/footer.php';
?>
