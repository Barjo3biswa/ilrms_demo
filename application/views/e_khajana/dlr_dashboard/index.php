<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/loader1.gif" style="width: 100px;"></div> 
<style>

  .btn-circle {
    width: 300px;
    height: 300px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
  .btn-circle.btn-lg {
    width: 300px;
    height: 300px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
  }
  .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    font-size: 24px;
    line-height: 1.33;
    border-radius: 35px;
  }


  :root {
    --loader-size: 50px;
    --dot-size: 6px;
    --loader-bg: #e1e6e2;
    --dot-color: black;
  }

  .loader {
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(1, 18, 64, 0.2);
    transition: opacity 0.3s ease-out, top 0.3s step-end;
    z-index: 99;
  }

  .loader.trans {
    transition: opacity 0.5s ease-out, top 0.5s step-start;
    opacity: 1;
    top: 0;
  }

  .loader .loaderview {
    position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    width: auto;
    height: auto;
    padding: 10px 40px;
    border-radius: 5px;
    top: 0;
    left: 0;
    z-index: 100;
    flex-flow: column;
    background-color: var(--loader-bg);
  }

  h1 {
    color: var(--dot-color);
    font-size: 1.2em;
    animation: fading 1.5s ease-in-out infinite;
    font-family: "Comfortaa", cursive;
  }

  .Loader-box {
    margin: 20px;
    flex: 0 0 auto;
    height: var(--loader-size);
    width: var(--loader-size);
  }

  .box {
    position: absolute;
    height: var(--loader-size);
    width: var(--loader-size);
    animation: rotating 4s ease-in infinite;
    animation-delay: calc(var(--id) * 0.5s);
  }

  .dot {
    background-color: var(--dot-color);
    height: var(--dot-size);
    width: var(--dot-size);
    border-radius: 100%;
  }

  @keyframes rotating {
    0% {
      opacity: 0;
      transform: rotateZ(0);
    }
    25% {
      opacity: 100%;
      transform: rotateZ(160deg);
    }

    75% {
      opacity: 200%;
      opacity: 100;
    }
    80% {
      transform: rotateZ(300deg);
      opacity: 100;
    }
    100% {
      transform: rotateZ(350deg);
      opacity: 0;
    }
  }

  @keyframes fading {
    0% {
      opacity: 40%;
    }
    50% {
      opacity: 90%;
    }
    100% {
      opacity: 40%;
    }
  }
</style>

<style type="text/css">

  .card-body {
    width: 200px;
    height: 200px;
    background-color: #e4e4e4;
    border-radius: 50%;
  }

  .num-card-title {
    font-style: normal;
    font-size: 32px;
    text-align: center;
    font-weight: bold;
  }

  .card-text {
    margin-top: 2px;
    text-align: center;
    font-size: 20px;
  }

  .td-align-title {
    text-align:right;
    color: white;
    vertical-align: middle;
    text-align: center;

  }
  .td-align {
    text-align:right;
  }

  .table_div_responsive {
    overflow-x: scroll;
  }

  .input_field{
    opacity:0;
  }

  .more_details {
    color: red;
    font-size:15px; 
    margin-left: 30px;
    cursor: pointer;
  }

</style>



<div class="container">
  <h3 style="text-align:center">Total No. of E-Khajana Cases in all Districts</h3>
</div><hr>

<div class="container">
  <div class="form-group">
    <div class="row">    
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Received</h5><hr>
          <h4 class="num-card-title"><?=$all_field?></h4><hr>
          <!-- <?php if($all_field != 0) { ?>
            <a href="<?=base_url().'index.php/BasundharaApi/loadViewPage?check=received'?>" >
              <span class="more_details">More details >></span></a>
          <?php } ?> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Pending</h5><hr>
          <h4 class="num-card-title"><?= $pending_field?></h4><hr>
          <!-- <?php if($pending_field != 0) { ?>
            <a href="<?=base_url().'index.php/BasundharaApi/loadViewPage?check=pending'?>" >
              <span class="more_details">More details >></span></a>
          <?php } ?> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Delivered</h5><hr>
          <h4 class="num-card-title"><?=$delivered_field?></h4><hr>
          <!-- <?php if($delivered_field != 0) { ?>
            <a href="<?=base_url().'index.php/BasundharaApi/loadViewPage?check=delivered'?>" >
              <span class="more_details">More details >></span></a>
          <?php } ?> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 my-2">
        <div class="card-body">
          <h5 class="card-text">Rejected</h5><hr>
          <h4 class="num-card-title"><?=$rejected_field?></h4><hr>
          <!-- <?php if($rejected_field != 0) { ?>
            <a href="<?=base_url().'index.php/BasundharaApi/loadViewPage?check=rejected'?>" >
              <span class="more_details">More details >></span></a>
          <?php } ?>           -->
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="col-lg-12 bg-secondary text-center p-3">
      <a href="<?=base_url().'index.php/EkhajanaMouzadariDashboard/index'?>" class="btn btn-danger btn-sm" role="button" target="_mouza_dash">CLICK HERE TO VIEW MOUZADARI AREA'S DASHBOARD</a>      
  </div>
  <hr>
</div>

<div class="container">
  <table class="table table-hover table-bordered" style="border-color:black">
    <thead>
      <tr>
        <th scope="col">Sl.No</th>
        <th scope="col" class="text-center">Description</th>
        <th scope="col" class="text-center">Report</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <th scope="row">1</th>
        <td class="text-center">Mouza Wise Application Received(Tehsildari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaMouzaWiseDataMouzadari">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">2</th>
        <td class="text-center">Mouza Wise Application Received(Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaMouzaWiseDataTehsildari">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">3</th>
        <td class="text-center">Pending with officers District wise(Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerMouzadariDistrictWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">4</th>
        <td class="text-center">Pending with officers District wise(Tehsildari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerTehsildariDistrictWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">5</th>
        <td class="text-center">Pending with officers Circle wise(Tehsildari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerTehsildariCircleWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">6</th>
        <td class="text-center">Pending With Officer Circle wise (Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerMouzadariCircleWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">7</th>
        <td class="text-center">Pending with officers Mouza wise(Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerMouzadariMouzaWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">8</th>
        <td class="text-center">Pending With Officer Village wise(Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaPendingWithOfficerMouzadariVillageWise">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">9</th>
        <td class="text-center">Rejected cases District wise(Tehsildari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaRejectedDistrictWiseTehsildari">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      <tr>
        <th scope="row">10</th>
        <td class="text-center">Rejected cases District wise(Mouzadari-Districts)</td>
        <td class="text-center">
          <a href="https://basundhara.assam.gov.in/rtpsmb/localAPI/ekhajanaRejectedDistrictWiseMouzadari">
            <button class="btn btn-success">Generate Report</button>
          </a>
        </td>
      </tr>

      

      

    </tbody>
  </table>
</div>


<script>
//data table initialisation
  $(document).ready(function() {
    $('#datatableDist').DataTable({
      "pageLength": 10,
      "order": [0, "asc"],
      "bFilter": false,
      // "bFilter": true,
      "bInfo": false,
      "bAutoWidth": true
    });
  });
</script>
