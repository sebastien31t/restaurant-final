$(()=>{
    /*----------------------------------
       Ajax consultation et réservation
    -----------------------------------*/

    // Constante pour lee nombre maximun de table.
    const t2max = 6;
    const t4max = 5;
    const t6max = 5;
    const t8max = 2;

    /*
    *   Fonction qui generent sur changement de date ou d'heure les objets réservés ou disponibles
    */
    $("#dte").change(function (e) { 
        e.preventDefault();
        res();
    });
    
    $("#hre").change(function (e) { 
        e.preventDefault();
        res();
    });

    /*
    *   Requete pour enregistrer une réservation
    */
    $('#valider_res').click(function (e) { 
        e.preventDefault();
        // Requête Ajax pour enregistrement de la réservation
        var dte = $("#dte").val();
        var hre = $("#hre").val();
        var table = $("#table").val();
        let data = {
            dte: dte,
            hre: hre,
            table: table
        };
        if(dte != null || hre != null || table != null){ // on verifie qu'il n'y ait pas de données nules
            $.ajax({
                type: "POST",
                url: "aj/a_add_res.php",
                data: data,
                dataType: "JSON",
            })
            .done(function(ret){

                // Création alert si enregistrement ok
                $("#m_alert").remove();
                var m_alert;
                var message;

                if(ret == true){
                    m_alert = 'success';
                    message = 'Enregistrepment réalisé avec succès!';
                }else{
                    m_alert = 'danger';
                    message = 'Impossible de réserver, merci de choisir d\'autres auptions';
                };

                //Création de l'alert de notification
                const notif_alert = document.createElement('div');
                notif_alert.className = ` mt-3 alert alert-${m_alert}`;
                notif_alert.innerHTML = `${message}`;
                notif_alert.setAttribute('role','alert')
                notif_alert.setAttribute('id','m_alert')
                $("#form-res").append(notif_alert);

                res()
            })
            .fail(function(resp){
                console.log(resp.responseText)
            })
        }
    });

    function res(){

        var rdte = $('#dte').val();
        var rdteFr = new Date(rdte).toLocaleDateString('fr')
        var rhre = $('#hre').val();

        let data = {
            dte: rdte,
            hre: rhre
        }
        if(rhre !== null && rdte !== null){
            
            const root = $("#reservation");
            root.children().remove();
            
            
            const t2 = document.createElement('div');
            t2.className = 'col-12 col-md-3';
            t2.setAttribute('id','t2')
            $("#reservation").append(t2)
            const titreT2 = document.createElement('H3')
            titreT2.innerHTML ='Table de 2';
            $("#t2").append(titreT2)

            const t4 = document.createElement('div');
            t4.className = 'col-12 col-md-3';
            t4.setAttribute('id','t4')
            $("#reservation").append(t4)
            const titreT4 = document.createElement('H3')
            titreT4.innerHTML ='Table de 4';
            $("#t4").append(titreT4)
            
            const t6 = document.createElement('div');
            t6.className = 'col-12 col-md-3';
            t6.setAttribute('id','t6')
            $("#reservation").append(t6)
            const titreT6 = document.createElement('H3')
            titreT6.innerHTML ='Table de 6';
            $("#t6").append(titreT6)
            
            const t8 = document.createElement('div');
            t8.className = 'col-12 col-md-3';
            t8.setAttribute('id','t8')
            $("#reservation").append(t8);
            const titreT8 = document.createElement('H3')
            titreT8.innerHTML ='Table de 8';
            $("#t8").append(titreT8)

            $.ajax({
                type: "POST",
                url: "aj/a_reservation.php",
                data: data,
                dataType: "JSON"
            })
            .done(function(resp){
                var existTable1 = false;
                var existTable2 = false;
                var existTable3 = false;
                var existTable4 = false;
                
                resp.forEach((ret)=>{
                    if(ret.table == 1){
                        existTable1 = true;
                        for(let i = 1; i  <= t2max ; i++){ 
                            if (i <= ret.count){
                                const table2Content = document.createElement('div')
                                table2Content.className = "alert alert-dark";
                                table2Content.setAttribute('role','alert');
                                table2Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Non disponible</p>
                                `
                                t2.append(table2Content)
                            } else {
                                const table2Content = document.createElement('div')
                                table2Content.className = "alert alert-success";
                                table2Content.setAttribute('role','alert');
                                table2Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Disponible</p>
                                `
                                t2.append(table2Content)
                            }
                        }
                    } 
                    if(ret.table == 2){
                        existTable2 = true;
                        for(let i = 1; i  <= t4max ; i++){ 
                            if (i <= ret.count){
                                const table4Content = document.createElement('div')
                                table4Content.className = "alert alert-dark";
                                table4Content.setAttribute('role','alert');
                                table4Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Non disponible</p>
                                `
                                t4.append(table4Content)
                            } else {
                                const table4Content = document.createElement('div')
                                table4Content.className = "alert alert-success";
                                table4Content.setAttribute('role','alert');
                                table4Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Disponible</p>
                                `
                                t4.append(table4Content)
                            }
                        }
                    }
                    if(ret.table == 3){
                        existTable3 = true;
                        for(let i = 1; i  <= t6max ; i++){ 
                            if (i <= ret.count){
                                const table6Content = document.createElement('div')
                                table6Content.className = "alert alert-dark";
                                table6Content.setAttribute('role','alert');
                                table6Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Disponible</p>
                                `
                                t6.append(table6Content)
                            } else {
                                const table6Content = document.createElement('div')
                                table6Content.className = "alert alert-success";
                                table6Content.setAttribute('role','alert');
                                table6Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Non disponible</p>
                                `
                                t6.append(table6Content)
                            }
                        }
                    }
                    if(ret.table == 4){
                        existTable4 = true;
                        for(let i = 1; i  <= t8max ; i++){ 
                            if (i <= ret.count){
                                const table8Content = document.createElement('div')
                                table8Content.className = "alert alert-dark";
                                table8Content.setAttribute('role','alert');
                                table8Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Non disponible</p>
                                `
                                t8.append(table8Content)
                            } else {
                                const table8Content = document.createElement('div')
                                table8Content.className = "alert alert-success";
                                table8Content.setAttribute('role','alert');
                                table8Content.innerHTML = `
                                    <strong>Enregistrement</strong>
                                    <hr>
                                    <p><strong>${rdteFr+' '+rhre}</strong></p>
                                    <p>Disponible</p>
                                    
                                `
                                t8.append(table8Content)
                            }
                        }
                    }
                })
                if(existTable1 == false){
                    for(let i = 1; i  <= t2max ; i++){ 
                        const table2Content = document.createElement('div')
                        table2Content.className = "alert alert-success";
                        table2Content.setAttribute('role','alert');
                        table2Content.innerHTML = `
                            <strong>Enregistrement</strong>
                            <hr>
                            <p><strong>${rdteFr+' '+rhre}</strong></p>
                            <p>Disponible</p>
                        `
                        t2.append(table2Content);
                    }
                }
                if(existTable2 == false){
                    for(let i = 1; i  <= t4max ; i++){ 
                        const table4Content = document.createElement('div')
                        table4Content.className = "alert alert-success";
                        table4Content.setAttribute('role','alert');
                        table4Content.innerHTML = `
                            <strong>Enregistrement</strong>
                            <hr>
                            <p><strong>${rdteFr+' '+rhre}</strong></p>
                            <p>Disponible</p>
                        `
                        t4.append(table4Content)
                    }
                }
                if(existTable3 == false){
                    for(let i = 1; i  <= t6max ; i++){ 
                        const table6Content = document.createElement('div')
                        table6Content.className = "alert alert-success";
                        table6Content.setAttribute('role','alert');
                        table6Content.innerHTML = `
                            <strong>Enregistrement</strong>
                            <hr>
                            <p><strong>${rdteFr+' '+rhre}</strong></p>
                            <p>Disponible</p>
                        `
                        t6.append(table6Content)
                    }
                }
                if(existTable4 == false){
                    for(let i = 1; i  <= t8max ; i++){ 
                        const table8Content = document.createElement('div')
                        table8Content.className = "alert alert-success";
                        table8Content.setAttribute('role','alert');
                        table8Content.innerHTML = `
                            <strong>Enregistrement</strong>
                            <hr>
                            <p><strong>${rdteFr+' '+rhre}</strong></p>
                            <p>Disponible</p>
                        `
                        t8.append(table8Content)
                    }
                }
                
            })
            .fail(function(e){
                console.error(e.responseText);
            });

            
        };
    }

})