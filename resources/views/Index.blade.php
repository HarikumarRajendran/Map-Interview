<!DOCTYPE html>

<html lang='en'>

   <head>

      <meta charset='UTF-8'>

      <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>

      <title>Index</title>

      <meta name='theme-color' content='#0c0a0a' />

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>

      <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet'>
      <style type="text/css">
         .frm-err{
            color: red;
            font-weight: bold;
         }
         .success{
            color: green;
            font-weight: bold;
         }
         .cursor-pointer{
            cursor: pointer;
         }
      </style>
   </head>

   <body>
      <nav class="navbar navbar-light bg-light justify-content-between">
          <a class="navbar-brand">Index</a>
          <form class="form-inline">
            <button class="btn btn-outline-success mr-3 my-2 my-sm-0" onclick='return ViewMap();'>View Map</button>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a href='<?= route('user-logout') ?>'>Logout</a></button>
          </form>
        </nav>

       <div class='sub-category bg-white'>
         <div class='body-top'>
            <div class='col-md-12 col-sm-12 zeropadding'>
               <div class='body-body-top-2 col-md-12 col-sm-12'>
                  <span class='frm-err d-none'>Please fill the details</span>
                  <span class='success d-none'></span>
                  <form method='post' id='AddressForm' onsubmit='return AddAddress();'>
                     <input type='hidden' name='_token' id='csrf-token' value='<?= csrf_token() ?>' />
                     <input type='hidden' id='e-br-in' class='input-class' value=''>
                     <input type='hidden' id='dataRow' class='dataRow' value=''>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputLocation">Location Name</label>
                           <input type="text" class="form-control" name="locationName" id="inputLocation" placeholder="Location Name">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputAddress">Address</label>
                           <input type="text" class="form-control" name="address" id="inputAddress" placeholder="Address">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputLat">Latitude</label>
                           <input type="text" class="form-control" name="latitude" id="inputLat" placeholder="Latitude">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputLon">Longitude</label>
                           <input type="text" class="form-control" name="longitude" id="inputLon" placeholder="Longitude">
                        </div>
                        <button class='btn btn-primary StrBtn' type='submit'>Add</button>
                  </form>
                  </div>
               </div>
               <div class='body-body-top-3 col-sm-12 col-md-12 zeropadding'>
                  <div class="row tableData mt-3 hide">
                      <table class="table table-bordered">
                         <thead class="text-center">
                           <tr>
                             <th>S.No</th>
                             <th>Location Name</th>
                             <th>Address</th>
                             <th>Latitude</th>
                             <th>Longitude</th>
                             <th>Status</th>
                             <th>Edit</th>
                             <th>Change Status</th>
                           </tr>
                         </thead>
                         <tbody class="text-center" id="bodyData">

                           <?php
                              $i = 1;
                              
                              if ($AddressInfo) {
                              
                                      foreach ($AddressInfo as $SepAddressDt) {
                                      ?>
                                      <tr id='<?= $i ?>'>
                              <td><?= $i ?></td>
                              <td><?= trim($SepAddressDt->name) ?></td>
                              <td><?= trim($SepAddressDt->address) ?></td>
                              <td><?= trim($SepAddressDt->latitude) ?></td>
                              <td><?= trim($SepAddressDt->longitude) ?></td>
                              <td><?= $SepAddressDt->status == 1 ? 'Active' : 'In-active' ?></td>
                              <td><i class='fa fa-edit cursor-pointer' id='e-br-in-<?= $SepAddressDt->id ?>' data-row='<?= $i ?>'  data-id='<?= $SepAddressDt->id ?>' data-value='<?= json_encode($SepAddressDt) ?>' onclick='EditAddress(this)'></i></td>
                              <td><i class="fa fa-power-off chng-sts cursor-pointer" data-row='<?= $i ?>' data='<?= $SepAddressDt->id ?>' data-td-act='5' onclick='StatusAddress(this)'></i></td>
                           </tr>
                           <?php
                              $i++;
                              }
                              }
                              ?>
                          
                         </tbody>
                       </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="d-none" id="map" style="width:100%;height:400px;"></div>
      <button class="btn btn-primary back-btn d-none mt-3 ml-5" onclick="backBtn();">Back</button>

   </body>
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src='<?= asset('js/app.js') ?>'></script>
   <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWF5TLbdQeLMFkRHA8nsDyfw2BtIE75_A">
    </script>



</html>
