        <footer>
            <section class=" bg-copy text-center"><!-- copytight -->
                <p>outlet &copy; Tous droits réservés</p> 
            </section><!-- fin copytight -->
            <div class="container bg-footer">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <address>
                            <h1>Outlet</h1>
                            <hr>
                            <p>
                                962 route de Cornebarrieu <br>
                                31840 Aussonne
                            </p>
                            <p><small>mail - </small><a href="mailto:obierti.sebastien@gmail.com">mon-adresse-mail@mail.com</a></p>
                            <p><small>phone - </small>06 45 27 20 97</p>
                        </address>
                    </div>
                    <div class="col-12 col-md-6 px-3 py-3" id="form-mail">
                        <form class="mb-3">
                            <div class="form-floating mb-3">
                              <input
                                type="text"
                                class="form-control" name="nom" id="nom" required>
                              <label for="nom">nom</label>
                            </div>
                            <div class="form-floating mb-3">
                              <input
                                type="text"
                                class="form-control" name="objet" id="objet" required>
                              <label for="objet">Objet</label>
                            </div>
                            <div class="form-floating mb-3">
                              <textarea class="form-control" id="message" required></textarea>
                              <label for="contenu">Message</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-max mb-3" id="form-footer" name="envoyer-mail">Envoyer un message</button>
                        </form>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>