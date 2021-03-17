$(document).ready(function(){

$("#signUp").on('click', function(){
	$("#container").addClass('right-panel-active');
});

$("#signIn").on('click', function(){
	$("#container").removeClass('right-panel-active');
})

});

var backBtn = function(){
    $('#map').addClass('d-none');
    $('.sub-category').removeClass('d-none');
    $('.back-btn').addClass('d-none');

}

$tknVl = $('input[name=_token]').val(), $DtTbl = $('.e-br'), $TblCnt = $('#table-row-cnt');

var BaseURL  = 'http://localhost/Tranxit/';

var AddUser = function(){

	$Err = 0, $name = $('#name'), $email = $('#email'), $password = $('#password');

    if ($name.val() == '' || $email.val() == '' || $password.val() == '') {

        $Err = 1;
        $('.signIn-err').removeClass('d-none');
        return false;
    }

    if (!$Err == 1) {

    	$data={
            'name' : $name.val(),
            'email' : $email.val(),
            'password' : $password.val(),
            '_token' : $tknVl
        };

        $.ajax({
            url: BaseURL + 'create-user',
            type: 'POST',
            dataType: 'json',
            data: $data
        }).done(function (t) {

        	if (t.Success) {
        		$("#addUserForm")[0].reset();
        		$('.succ-msg').removeClass('d-none')
        		setTimeout(function(){ $('.succ-msg').addClass('d-none'); }, 3000);

        	} else{

                $('.signIn-err').removeClass('d-none');
                $('.signIn-err').html(t.Error);
                setTimeout(function(){ $('.signIn-err').addClass('d-none'); }, 3000);

            }
        })

    }

    return false;
};

var userLogin = function () {

    var Err = 0, usrNm = $('#lgnemail'), pwd = $('#lgnpassword');

    if (usrNm.val() == '' || pwd.val() == '') {
        
        Err = 1;
        $('.frm-err').removeClass('d-none');
        return false;
    }

    if (Err == 1) {
        return false;
    }
};

var AddAddress = function(){

	$Err = 0, $name = $('#inputLocation'), $address = $('#inputAddress'), $lat = $('#inputLat'), $long = $('#inputLon');

	$EBrIn = $('#e-br-in');

	if ($EBrIn.val() != '') {

        UpdateAddress($EBrIn.val());
        return false;
    }

    if ($name.val() == '' || $address.val() == '' || $lat.val() == '' || $long.val() == '') {

        $Err = 1;
        $('.frm-err').removeClass('d-none');
        return false;
    }

    if (!$Err == 1) {

    	$data={
            locationName : $name.val(),
            address : $address.val(),
            latitude : $lat.val(),
            longitude : $long.val(),
            _token : $tknVl
        };

        $.ajax({
            url: BaseURL + 'add-address',
            type: 'POST',
            dataType: 'json',
            data: $data
        }).done(function (t) {

        	if (t.Success) {
        		$AddrDt     = t.AddressInfo;

                $("#bodyData").html('');
                        
                $.each($AddrDt, function(key, value){

                    $status = (value['status'] == '1' ? 'Active' : 'In-active');

                    $("#bodyData").append("<tr id='"+value['id']+"'><td>"+value['id']+"</td><td>"+value['name']+"</td><td>"+value['address']+"</td><td>"+value['latitude']+"</td><td>"+value['longitude']+"</td><td>"+$status+"</td><td><i class='fa fa-edit cursor-pointer' aria-hidden='true' data-row="+ value['id'] + " id='e-br-in-" + value['id'] +"' data-value=\'" + JSON.stringify(value) + "\' onclick='EditAddress(this)'</i></td><td><i class='fa fa-power-off chng-sts cursor-pointer'  data-row='"+  value['id'] + "' data='"+  value['id'] +"' data-td-act='5' onclick='StatusAddress(this)'></i></td></tr>");

                });

                $('.success').removeClass('d-none');
                $('.success').html(t.Msg);
                setTimeout(function() { $('.success').addClass('d-none'); }, 3000);
                $("#AddressForm")[0].reset();
                $('.frm-err').addClass('d-none');

        	}
        });

    }

    return false;
};

var EditAddress = function (t) {

    $ErbId = $('#e-br-in'), $name = $('#inputLocation'), $address = $('#inputAddress'), $lat = $('#inputLat'), $long = $('#inputLon');

    $dataRow     = $(t).attr('data-row');
    $AddressD        = JSON.parse($(t).attr('data-value'));

    $('#dataRow').val($dataRow);
    $ErbId.val($AddressD.id);
    $name.val($AddressD.name);
    $address.val($AddressD.address);
    $lat.val($AddressD.latitude);
    $long.val($AddressD.longitude);
    $('.StrBtn').html('Update');
    $(window).scrollTop(0);
};

var UpdateAddress = function (t) {

    $Err = 0, $DataRow = $('#dataRow'), $name = $('#inputLocation'), $address = $('#inputAddress'), $lat = $('#inputLat'), $long = $('#inputLon');
    
    if ($name.val() == '' || $address.val() == '' || $lat.val() == '' || $long.val() == '') {

        $Err = 1;
        $('.frm-err').removeClass('d-none');
        return false;
    }


    if (!$Err == 1) {

    	
        $Address = {

            id: t,
            locationName : $name.val(),
            address : $address.val(),
            latitude : $lat.val(),
            longitude : $long.val(),
            _token : $tknVl
        };


        $.ajax({
            url: BaseURL + 'update-address',
            type: 'POST',
            dataType: 'json',
            data: $Address
        }).done(function (t) {
            if (t.Success) {
                
                $AddressInfo = t.AddressInfo;

                $("#bodyData").html('');
                        
                $.each($AddressInfo, function(key, value){

                    $status = (value['status'] == '1' ? 'Active' : 'In-active');

                    $("#bodyData").append("<tr id='"+value['id']+"'><td>"+value['id']+"</td><td>"+value['name']+"</td><td>"+value['address']+"</td><td>"+value['latitude']+"</td><td>"+value['longitude']+"</td><td>"+$status+"</td><td><i class='fa fa-edit cursor-pointer' aria-hidden='true' data-row="+ value['id'] + " id='e-br-in-" + value['id'] +"' data-value=\'" + JSON.stringify(value) + "\' onclick='EditAddress(this)'</i></td><td><i class='fa fa-power-off chng-sts cursor-pointer'  data-row='"+  value['id'] + "' data='"+  value['id'] +"' data-td-act='5' onclick='StatusAddress(this)'></i></td></tr>");

                });
                $("#AddressForm")[0].reset();
                $('.success').removeClass('d-none');
                $('.success').html(t.Msg);
                setTimeout(function() { $('.success').addClass('d-none'); }, 3000);
                $('.frm-err').addClass('d-none');
                $('.StrBtn').html('Add');
            } 

        })
    }
    return false;
};

var StatusAddress = function (t) {


        $TdAct = $(t).attr('data-td-act');

        $DtRw = $(t).attr('data');
        $DtRwNm = $(t).attr('data-row');

        $ActVal = {
            ActId: $DtRw,
            _token: $tknVl
        };

            $.ajax({
            url: BaseURL + 'address-status',
            type: 'POST',
            dataType: 'json',
            data: $ActVal
            }).done(function (t) {

            if (t.Success) {
                $Status = 'In-active';
                if (t.Status == 1) {
                    $Status = 'Active';
                }
               $('.tableData').find('tr#' + parseInt($DtRwNm)).find('td:eq(' + $TdAct + ')').html($Status);

            } 
            
            
        }).fail(function (t) {});

        return false;

};

var ViewMap = function (t) {

        $('#map').removeClass('d-none');
        $('.sub-category').addClass('d-none');
        $('.back-btn').removeClass('d-none');
        
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(20.5937, 78.9629),
          zoom: 12
        });
        
        var infoWindow = new google.maps.InfoWindow;

        $ActVal = {
            _token: $tknVl
        };

            $.ajax({
            url: BaseURL + 'view-map',
            type: 'POST',
            dataType: 'json',
            data: $ActVal
            }).done(function (t) {

            if (t.AddressInfo) {

                $AddressDt = t.AddressInfo;

                $.each($AddressDt, function(key,value){

                    var id = value['id'];
                    var name = value['name'];
                    var address = value['address'];
                    var point = new google.maps.LatLng(
                      parseFloat(value['latitude']),
                      parseFloat(value['longitude']));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                        strong.textContent = name
                        infowincontent.appendChild(strong);
                        infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                        text.textContent = address
                        infowincontent.appendChild(text);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: point
                          });
                        console.log(marker);
                        marker.addListener('click', function() {
                            infoWindow.setContent(infowincontent);
                            infoWindow.open(map, marker);
                        });

                });

            }  
            
            
        }).fail(function (t) {});

        return false;

};
