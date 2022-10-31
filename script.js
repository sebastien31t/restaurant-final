$(()=>{
    /* ----------------------
        gestion des cookies
    -----------------------*/
    // Masquer le bandeau
    // $('#cookies').hide(0);

    // Afficher le bandeau si pas de cookies
    // setTimeout(()=>{
    //     $('#cookies').show(1000);
    // },1000);

    $('#accept').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "config/cookies.php",
            data: {'cookies':1},
            dataType: "text",
            
        }).done((r)=>{
            $('#cookies').hide(1000);
            console.info('Valeur de la variable cookie : '+r)
        }).fail((r)=>{
            console.error('Erreur sur acceptation des cookies '+ r.responseText)
        })
    });

    $('#reject').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "config/cookies.php",
            data: {'cookies':0},
            dataType: "text",
            
        }).done((r)=>{
            $('#cookies').hide(1000);
            console.info('Valeur de la variable cookie : '+r)
        }).fail((r)=>{
            console.error('Erreur sur acceptation des cookies '+ r.responseText)
        });
    });

    /*---------------------------------------
        Envoi de message depuis le footer
    ---------------------------------------*/
    $('#form-footer').click(function (e) { 
        e.preventDefault();
        let data ={
            nom: $("#nom").val(),
            objet: $("#objet").val(),
            message: $("#message").val()
        }

        $.ajax({
            type: "POST",
            url: "aj/mail-footer.php",
            data: data,
            dataType: "JSON"
        })
        .done(function(){
            // console.info('message envoyer')
            let alert = document.createElement('div');
            alert.className = 'alert alert-success';
            alert.setAttribute('role','alert');
            alert.innerHTML = 'Méssage envoyer avec succès !';
            $('#form-mail').prepend(alert)
        })
        .fail(function(resp){
            console.error(resp.responseText);
            let alert = document.createElement('div');
            alert.className = 'alert alert-danger';
            alert.setAttribute('role','alert');
            alert.innerHTML = 'Erreur lors de l\'envoi du méssage';
            $('#form-mail').prepend(alert);
        })
    });


    /*-------------------------
         Editeur de texte
    -------------------------*/
    $('#trumbowyg').trumbowyg({
        lang: 'fr',
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            ['link'],
            // ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ]
    });
    

    $('#valide').show(500);
});
