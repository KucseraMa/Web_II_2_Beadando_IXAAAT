const szerurl = "http://localhost/Web_II_2_Beadando_IXAAAT/szereles_ajax";


function telepules(){
    setTimeout(function (){
        $.ajax({
            type: 'post',
            url: szerurl,
            keepalive: false,
            data: { 'ajax' : 'tabla' }
        }).done(function (data){
           // console.log (data);
            $('#response').html(data);

        });
        $.ajax({
            type: 'post',
            url: szerurl,
            data: {'ajax': 'varos'}
        }).done(function (data){
            $('#varos').html(data);
        });
    }, 1000);
}

function utca() {

    let varos = $("#varos").val();
    //console.log(varos);
    $('#utca').visible;
   if (varos != 0) {
       $('#utca').show();
       //console.log(varos);
       //debugger;
       $.ajax({
           type: 'post',
           url: szerurl,
           keepalive: false,
           data: {
               'ajax': 'utca',
               'varos': varos
           }
       }).done(function (data) {

           $('#utca').html(data);

       });
   }else {
       $("#utca option:selected").prop("selected", false);
       $('#submitPDF').prop('disabled',true);
       $('#utca').hide();
       $('#javdatum').hide();
   }
}
function javdatum(){
    let varos = $("#varos").val();
    let utca = $("#utca").val();
    console.log(utca);
    //debugger;
    if(varos != 0 && utca != 0) {
        $('#javdatum').show();
        $.ajax({
            type: 'post',
            url: szerurl,
            keepalive: false,
            data: {
                'ajax': 'javdatum',
                'varos': varos,
                'utca': utca
            }
        }).done(function (data) {
            // console.log (data);
            $('#javdatum').html(data);

        });
    }else{
        $("#javdatum option:selected").prop("selected", false);
        $('#javdatum').html();
        $('#submitPDF').prop('disabled',true);
        $('#javdatum').hide();
    }
}

function szurttabla(){
    let varos = $("#varos").val();
    let utca = $("#utca").val();
    let javdatum = $("#javdatum").val();
    console.log(utca);
    //debugger;
    if(varos != 0 && utca != 0 && javdatum != 0){
    $.ajax({
        type: 'post',
        url: szerurl,
        keepalive: false,
        data: { 'ajax' : 'szurt',
            'varos' : varos ,
            'utca' : utca,
            'javdatum' : javdatum}
    }).done(function (data){
       // console.log (data);
        $('#response').html(data);

    });
    }else{ telepules();}
}
function selectvaros() {
    let varos = $("#varos").val();
    let utca = $("#utca").val();
    console.log(utca);
    //debugger;
    $.ajax({
        type: 'post',
        url: szerurl,
        keepalive: false,
        data: { 'ajax' : 'selectvaros',
            'varos' : varos ,
            'utca' : utca}
    }).done(function (data){
      //  console.log (data);
        $('#response').html(data);

    });
}



$(document).ready(function () {
    $('#submitPDF').prop('disabled',true);
    telepules();
$("#varos").change(utca);
$("#utca").change(javdatum);
    $("#javdatum").change(function (){
        if($("#javdatum").val()!=0){
            $('#submitPDF').prop('disabled',false);
        }else $('#submitPDF').prop('disabled',true);
    });




$("#javdatum").change(szurttabla);


});