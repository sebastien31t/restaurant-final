<?php

    require_once 'inc/header.php';

    if(isset($_POST['valider'])){

        // Traitement des variables post
        $cat = intval($_POST['categorie']);
        $title = strip_tags($_POST['titre']);
        $content = htmlspecialchars($_POST['contenu']);
        // echo 'cat : '.$cat.'<br>';
        // echo 'titre : '.$title.'<br>';
        // echo 'Content : '.$content.'<br>'; 

        $type_photo = $_FILES['photo']['type'];
        $size_photo = $_FILES['photo']['size'];
        $tmp_photo = $_FILES['photo']['tmp_name'];
        $name_photo = $_FILES['photo']['name'];
        $new_mame = date('Y-m-d-H-i-s-').$name_photo;
        $accept_type = [
            "jpg" => "image/jpg", 
            "jpeg" => "image/jpeg", 
            "png" => "image/png",
            "webp" => "image/webp"
        ];
        echo 'Photos : '.$new_mame.'<br>';
        // var_export($_FILES);

        $ri_post = $conn->prepare('INSERT INTO `post`(
                `idx_user`,
                `idx_category`,
                `title_post`,
                `content_post`,
                `post_image`
            ) VALUES (
                :id,
                :cat,
                :title,
                :content,
                :imag
            )
            ');

        if($ri_post->execute([
            ':id' => $_SESSION['id'],
            ':cat' => $cat,
            ':title' => $title,
            ':content' => $content,
            ':imag' => $new_mame
        ])){
            if(in_array($type_photo,$accept_type)){ // On teste si le fichier image est a le bon type
                if($size_photo <= MAX_PHOTO_SIZE){
                    // on le déplace dans upload
                    move_uploaded_file($tmp_photo,'upload/'.$new_mame);
                }else{
                    echo 'Le fichier est trop volumineux';
                }
            } else{
                echo 'Pas le bon type de fichier';
            }
        }
    }
    
    // On teste si l'utilisateur est connecté et on redirige
    if(!isset($_SESSION['pseudo'])){
        header('Location:blog.php');
        exit;
    }

    require_once 'inc/header-html.php';
?>
<main>
    <section class="container margin-top">
        <form action="" method="post" class="row" enctype="multipart/form-data">
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <select name="categorie" class="form-select" required>
                        <option value=""></option>
                        <?php 
                            $rs_cat = $conn->prepare('SELECT `designation`,`id_category` FROM `category`');
                            $rs_cat->execute();
                            foreach($rs_cat as $cat): ?>
                                <option value="<?=$cat[1]?>"><?=$cat[0]?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="categorie">Catégories</label>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    class="form-control" name="titre" maxlength="75" required>
                  <label for="titre">Titre</label>
                </div>
                <div class="mb-3">
                    <label for="image">Sélectionnez une image</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <button type="submit" name="valider" class="btn btn-success btn-max">Enregistrer</button>
            </div>
            <div class="col-md-8">
                <textarea id="trumbowyg" name="contenu"></textarea>
            </div>
        </form>
    </section>
</main>
<?php
    include_once 'inc/footer.php';
?>

