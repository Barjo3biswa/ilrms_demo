<style>
    .casedisplay_new {
        min-height: 395px !important;
        background-color:rgb(171, 171, 171);
    }
    .thead_color{
        background-color:#292409!important;
        color:white!important;
    }

</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Updated CFR Pages Details</li>
  </ol>
</nav>
<center>
<div class="row" style='margin-top:20px;'>				
    <div class="col-lg-10 offset-1">
        <div class="panel casedisplay_new shadow-lg p-3 mb-3">                        
            <div class="panel-body">
                <div class="bg-success">
                    <div class="text-center text-white p-3 font-weight-bold">
                        <h5><i class="fa fa-money" aria-hidden="true"></i>
                            CFR PAGE DETAILS (BOOK-NO: <?=$viewData[0]->cfr_book_no?>, PAGE-NO: <?=$viewData[0]->cfr_page_no?>)
                        </h5>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" >
                <tr>
                    <td>District</td>
                    <td><?=$this->utilclass->getDistrictName($dist_code)?></td>
                    <td>Subdivison:</td>
                    <td><?=$this->utilclass->getSubDivName($dist_code, $subdiv_code)?></td>
                </tr>
               
                <tr>
                    <td>Circle:</td>
                    <td><?=$this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code)?></td>
                    <td>Mouza:</td>
                    <td><?=$this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code)?></td>
                </tr>
            </table>

            <!-- Button to view the document -->
            <div class="row mt-3 mb-3">
                <div class="col-lg-12 text-center">  
                    <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/viewDocument/' . $viewData[0]->id ?>"
                        class="btn btn-primary btn-sm text-white" role="button" target="_cfr_carbon_copy">
                        <i class="fa fa-eye" aria-hidden="true"></i> VIEW UPLOADED CARBON COPY
                    </a>
                </div>
            </div>



            <table class="table table-striped table-hover" >           
                <thead class="thead-dark">                            
                    <tr style="background-color: black; color: #fff;">
                        <td>LOT</td>
                        <td>VILLAGE</td>
                        <td>PATTA-TYPE</td>
                        <td>PATTA-NO</td>
                        <td>কাৰ পৰা পোৱা হল</td>
                        <td>কাৰ বাবে পোৱা হল</td>
                    </tr>                                                        
                </thead>
                <tbody>
                    <?php foreach ($viewData as $row):?> 
                        <tr>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$this->utilclass->getLotName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no)?>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code)?>
                                <span>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">                                    
                                    <?=$this->utilclass->getPattaType($row->patta_type_code)?>
                                <span>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$row->patta_no?>
                                <span>
                            </td>         
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$row->pdar_id_kpph_name?>
                                <span>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$row->pdar_id_kbph_name?>
                                <span>
                            </td>                       
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-12 mt-3 text-center">                        
                    <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>"
                        class="btn btn-danger btn-sm text-white" role="button" 
                        style="padding: 7px !important;font-size: 14px;font-weight: bold;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            CLOSE
                    </a>                       
                </div>                
            </div>
        </div>
    </div>               
</div>

