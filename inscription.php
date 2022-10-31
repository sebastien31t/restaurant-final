<?php
    require_once 'inc/header-html.php';    
?>
<main class="mb-5">
    <section class="container margin-top">
        <form action="config/inscription.php" class="row" method="POST">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control" name="name" required maxlength="50">
                <label for="name">nom</label>
                </div>
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control" name="firstname" required maxlength="50">
                <label for="firstname">prenom</label>
                </div>
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control" name="pseudo" required>
                <label for="pseudo">pseudo</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                <input
                    type="email"
                    class="form-control" name="mail" required>
                <label for="mail">mail</label>
                </div>
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control" name="phone" required maxlength="10">
                <label for="phone">phone</label>
                </div>
                <div class="form-floating mb-3">
                <input
                    type="password"
                    class="form-control" name="password" required>
                <label for="password">password</label>
                </div>
            </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-max">Créer une inscription</button>
                </div>
        </form>
    </section>
</main>
<?php
    include_once 'inc/footer.php';
?>