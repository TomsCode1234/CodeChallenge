$( document ).ready(function() {
    for (i = 0; i < carIdArray.length; i++){
        $('#carDropDown').append('<option value="'+carIdArray[i]+'">');
    }
    for (i = 0; i < modelIdArray.length; i++){
        $('#modelDropDown').append('<option value="'+modelIdArray[i]+'">');
    }
});

$('#carSearch').change(function (){
    $('#modelSearch').val('');
});


$('#modelSearch').change(function (){
    $('#carSearch').val('');
});

$('#carInput').submit(function(e){
    e.preventDefault();

    $("#Results").html('');
    
    $.ajax({
        type: "GET",
        url: "https://tlayzell5.000webhostapp.com/backend.php",
        data: {
            car: $('#carSearch').val(),
            model: $('#modelSearch').val(),
            action: "getData",
            dataType: "json"
            },
            success: function(data) {
                var json = JSON.parse(data); 
                globalData = data;
                console.log(data);
               if (json[0] === ""){
                    console.log("check");
                    $('#Results').append("<h4><b>No Results Found! </b></h4>");
                }else{
                    $.each(json, function(index, val){
                        console.log(val); 
                        //add listing
                        $('#Results').append('<div id="sale">'+ val.description +' <br> <b>ID: </b><i>' +val.id + '</i> <b>Model: </b><i>' +val.modelId + '</i> <b>Transmission: </b><i>' + val.transmission + '</i> <br><br> <b>Registration: </b><i>' +val.registration + '</i> <b>Mileage: </b><i>' +val.mileage + '</i> <b>Previousd Owners: </b><i>' + val.owners + '</i>  <br> <p>' +val.photos + '</p> <br> <b>Co2 Emmissions: </b><i>' +val.co2Emmissions + '</i> <b>Fuel Type: </b><i>' +val.fuelType + '</i> <b>Miles Per Gallon: </b><i>' + val.mpg + '</i> <br><br> <b>Engine Power: </b><i>' +val.enginePower + '</i> <b>Engine Size: </b><i>' +val.engineSize + '</i> <b>Price: </b><i>' + val.price + '</i>  </div>');

                    });
                }
            },
                error: function(xhr, ajaxOptions, thrownError) 
                {
                    console.log(xhr.status);
                    console.log(thrownError);
                } 
            });
});