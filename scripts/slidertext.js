$(document).ready(function() {
    $('#maxCost').val($('#maxCostValue').val());
    $('#maxTappe').val($('#maxTappeValue').val());
    $('#durataOre').val($('#durataOreValue').val());
    $('#durataGiorni').val($('#durataGiorniValue').val());

    $('#maxCost').on('input change',function(){
        $('#maxCostValue').val($(this).val());
    });
    $('#maxCostValue').keyup(function(){
        var val = $(this).val();
        $('#maxCost').val(val);
    });

    $('#maxTappe').on('input change',function(){
        $('#maxTappeValue').val($(this).val());
    });
    $('#maxTappeValue').keyup(function(){
        var val = $(this).val();
        $('#maxTappe').val(val);
    });

    $('#durataOre').on('input change',function(){
        $('#durataOreValue').val($(this).val());
    });
    $('#durataOreValue').keyup(function(){
        var val = $(this).val();
        $('#durataOre').val(val);
    });

    $('#durataGiorni').on('input change',function(){
        $('#durataGiorniValue').val($(this).val());
    });
    $('#durataGiorniValue').keyup(function(){
        var val = $(this).val();
        $('#durataGiorni').val(val);
    });

    $("#luogo").keyup(function () {
        $.ajax({
            url: "cerca.php?page=1",
            type: "POST",
            data: {
                luogo: $("#luogo").val(),
                ajax: 1
            },
            success(){
                //stapare le tile
                $.ajax({
                    url: "cercaAjax.php",
                    type: "POST",
                    success(data){
                        $("#searchContent").html(data);
                    },
                })
            },
        });
    })
});