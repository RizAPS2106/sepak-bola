$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});

// insert klub data
$(".btn-submit").click(function(e){
    e.preventDefault();

    var nama = $("#klubName").val();
    var kota = $("#klubPlace").val();

    $.ajax({
        type:'POST',
        url:"klub/store",
        data:{nama:nama, kota:kota},
        success:function(data){
            alert(data.success);
        },
        error: function (request, error) {
            console.log(arguments);
            alert("" + error);
        },
    });
});