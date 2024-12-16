$(document).ready(function() {
      // Lorsque la case "Tout cocher" est cochée
      $('#select-all').on('change', function() {
        if ($(this).is(':checked')) {
            $('.options').prop('checked', true); // Coche toutes les cases
            $('#deselect-all').prop('checked', false); // Décoche "Tout décocher"
        }
    });

    // Lorsque la case "Tout décocher" est cochée
    $('#deselect-all').on('change', function() {
        if ($(this).is(':checked')) {
            $('.options').prop('checked', false); // Décoche toutes les cases
            $('#select-all').prop('checked', false); // Décoche "Tout cocher"
        }
    });
    
    // Si une des options individuelles est modifiée
    $('.options').on('change', function() {
        // Si toutes les cases sont cochées
        if ($('.options:checked').length === $('.options').length) {
            $('#select-all').prop('checked', true);
            $('#deselect-all').prop('checked', false);
        } else if ($('.options:checked').length === 0) {
            // Si aucune case n'est cochée
            $('#deselect-all').prop('checked', true);
            $('#select-all').prop('checked', false);
        } else {
            // Si certaines cases sont cochées, décocher les deux cases "Tout"
            $('#select-all').prop('checked', false);
            $('#deselect-all').prop('checked', false);
        }
    });



    $("#datenaissance").on("change", function() {
        const birthDate = $(this).val();
        $.ajax({
            url: "ajax/verif_age.php",
            method: "POST",
            data: { dateNaissance: birthDate },
            success: function(response) {
                if (response === "show") {
                    $("#extra-fields").fadeIn();
                } else {
                    $("#extra-fields").fadeOut();
                }
            },
            error: function() {
                alert("Désolé vous êtes trop petit");
            }
        });
    });
});