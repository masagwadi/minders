// $(document).ready(function(){
    

// Helper

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

   function noofdays(){
    var startdatev = $('#datepicker').val();
    var enddatev = $('#datepicker2').val();

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = mm + '/' + dd + '/' + yyyy;

    if(startdatev){

        var td = moment(today, 'MM/DD/YYYY');
        var a = moment(startdatev, 'MM/DD/YYYY');

        var todayvsstart = a.diff(td, 'days');


        if(todayvsstart < 0){
            document.getElementById('startdatewar').innerHTML = "<div  class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>The date selected is in the past, please select today's date or in the future</div>";
        }else{
            document.getElementById('startdatewar').innerHTML = "";
        }

    }

    if(enddatev){

        var td = moment(today, 'MM/DD/YYYY');
        var b = moment(enddatev, 'MM/DD/YYYY');
        var days = b.diff(a, 'days');
        var todayvsend = b.diff(td, 'days');

        if(todayvsend < 0){
            document.getElementById('enddatewar').innerHTML = "<div  class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>The date selected is in the past, please select today's date or in the future</div>";
        }else{
            document.getElementById('enddatewar').innerHTML = "";
        }
    }


    if(!startdatev || !enddatev){
        return 'No date selected';
    }else{
        // alert(new Date(startdatev).getDate());    


        var a = moment(startdatev, 'MM/DD/YYYY');
        var b = moment(enddatev, 'MM/DD/YYYY');
        var days = b.diff(a, 'days');
        return days;
    }
  }

    function checkservice(){

        var thechoice = $('#services').val();
        var servicevalue = 0;
        var serviceDscr = document.getElementById('servicedescr');

        
        


        if(thechoice == 'petsitting'){
            serviceDscr.innerHTML = "Pet Sitting: The minder comes over your house and take care of the pet";
            servicevalue = 189;
        }else if(thechoice == 'petboarding'){
            serviceDscr.innerHTML = "Pet Boarding: The pet stays over at the minder's home ";
            servicevalue = 189;
        }else if(thechoice == 'dogwalking'){
            serviceDscr.innerHTML = "Pet Boarding: The minder walks the pet";
            servicevalue = 89;
        }else if(thechoice == 'dropinvisits'){
            serviceDscr.innerHTML = "Pet Boarding: The minder visits";
            servicevalue = 99;
        }

        return servicevalue;

    }

    function getnopets(){

        var nopetschoice = $('#nopets').val();
       
        return nopetschoice;
    }

    function calcTotal(){

        noofdays();
        var days =0;
        var daysinfo = "";

        

        if( noofdays() == 'No date selected' || noofdays() < 0){
            days = 1;
            daysinfo = "( "+days+" day )";
        }else{
            days =noofdays()+1;
            daysinfo = "( "+days+" days )";
        }


        if(noofdays() < 0){
            document.getElementById('enddatewar').innerHTML = "<div  class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>End date must be newer than the start date</div>";
        }

       var total = getnopets() * checkservice()*days;
        var totalBlock = document.getElementById('totalblock');

        totalBlock.innerHTML = "Total: R "+numberWithSpaces(total)+" "+daysinfo;

    }





$('.voucher-list').on('click','li .vstop',function(){

   var clickedone = $(this);
   var postData = $(this).data("vid");
   var formURL = "deactvoucher.php";


   $.ajax({
       url: formURL,
       type: "GET",
       data: {vcode: postData},
       success: function(resp, textStatus, jqXHR){

         clickedone.addClass('vstart');
         clickedone.removeClass('vstop');
         clickedone.text('Activate');

         $('[data-vidstatus="'+postData+'"]').addClass('vinactive ');
         $('[data-vidstatus="'+postData+'"]').removeClass('vactive ');



       },
       error: function(jqXHR, textStatus, errorThrown){
           $(".vcode-err").html('<pre class="warning"><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
       }

   });

});






// });
