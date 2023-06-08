$(document).ready(function() {
    carregarReagentes();

    // Limpar formulário ao abrir o modal de adicionar reagente
    $("#modalAdicionarReagente").on("show.bs.modal", function() {
        limparFormulario();
    });

    // Enviar o formulário ao clicar no botão "Salvar"
    $("#reagenteForm").submit(function(e) {
        e.preventDefault();
        criarReagente();
    });

    // Carregar lista de reagentes
    function carregarReagentes() {
        $.ajax({
            url: "reagentes.php",
            type: "GET",
            success: function(data) {
                $("#reagentesList").html(data);
                $(".edit-btn").click(function() {
                    var reagenteId = $(this).data("reagente-id");
                    carregarReagente(reagenteId);
                });
                $(".delete-btn").click(function() {
                    var reagenteId = $(this).data("reagente-id");
                    deletarReagente(reagenteId);
                });
            }
        });
    }

    // Carregar dados de um reagente pelo ID
    function carregarReagente(reagenteId) {
        $.ajax({
            url: "reagente.php",
            type: "GET",
            data: { id: reagenteId },
            success: function(data) {
                var reagente = JSON.parse(data);
                $("#nome").val(reagente.nome);
                $("#composicao").val(reagente.composicao);
                $("#quantidade_g").val(reagente.quantidade_g);
                $("#quantidade_mg").val(reagente.quantidade_mg);
                $("#localizacao").val(reagente.localizacao);
                $("#modalAdicionarReagente").modal("show");
            }
        });
    }

    // Criar um novo reagente
    function criarReagente() {
        $.ajax({
            url: "reagente.php",
            type: "POST",
            data: $("#reagenteForm").serialize(),
            success: function() {
                $("#modalAdicionarReagente").modal("hide");
                carregarReagentes();
            }
        });
    }

    // Deletar um reagente pelo ID
    function deletarReagente(reagenteId) {
        $.ajax({
            url: "reagente.php",
            type: "DELETE",
            data: { id: reagenteId },
            success: function() {
                carregarReagentes();
            }
        });
    }

    // Limpar o formulário
    function limparFormulario() {
        $("#reagenteForm")[0].reset();
    }
});