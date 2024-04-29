$("#cep").mask("00000-000");

$("#cep").on("change", function () {
    if (!$('#erro-cep').hasClass('d-none')) {

        $("#erro-cep").addClass('d-none');

    }

    let cep = $(this).val();
    buscaCep(cep)
        .then(function (dados) {
            if (!dados.erro) {
                console.log(dados)
              
                $("#cidade").val(dados.localidade);
               

            } else {
                $("#div-cep").append('<span class="error-message" id="erro-cep"></span>')
                $("#erro-cep").html("Não foi possivel encontrar o CEP inserido").removeClass('d-none');

            }



        })
        .catch(function (error) {
            console.error(error);
        });
});


$("#pesquisaPrevisao").validate({
    rules: {

        cep: {
           
            minlength: 9,

        },
        cidade: {
            required: true,
            minlength: 3,

        },
     

    },
    messages: {
        cep: {
        
            minlength: "O CEP deve conter ao menos 8 caracteres."
        },
        cidade: {
            required: "Por favor, insira a cidade.",
            minlength: "A cidade deve conter ao menos 3 caracteres."
        },
       
    },
    errorElement: 'span',
    errorClass: 'error-message',
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('error-field');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('error-field');
    },
    success: function (label, element) {

        $(element).addClass('success-field');

        label.remove();
    },
    submitHandler: function (form) {
        form.submit();
    },
    submitHandler: function (form) {

        form.submit();
    }
});
