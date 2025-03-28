<div class="container-fluid">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/EkhajanaDashboard/index">Home</a></li>
       <li class="breadcrumb-item"><a href="#">District-Wise-Ekhajana</a></li>

     </ol>
   </nav>



   <section class="content ms-5 me-5">
     <h4 class="text-center">District Wise E-Khajana (Arrear Updation Count)</h4>
     <?php /*
     <div class="d-flex justify-content-between align-items-center"> */ ?>
       <div class="bg-dark text-white h6 font-weight-bold text-center" style="padding:5px;margin-bottom:0px;font-size:11px;">NOTE: RANK IS GIVEN ON THE BASIS OF ARREAR UPDATED PATTA COUNT(DISTRICT-WISE). SIMILAR RANK WILL APPEAR IF ARREAR UPDATED COUNT IS SAME.</div>


       <table class="table table-bordered table-sm">

         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">District</th>
             <th scope="col">Total Patta</th>
             <th scope="col">Updated Patta</th>
             <th scope="col">Remaining Patta</th>
             <th scope="col">Rank</th>
           </tr>
         </thead>
         
         <tbody>
           <?php $i = 1;
            foreach ($dist as $d) : ?>
             <tr>

               <th scope="row"><?= $i++ ?></th>

               <td>
                 <a href="<?php echo base_url() . 'index.php/EkhajanaDlrDashboard/circleWiseArrearReport/'. $d['dist_code']?>" data-id="<?php echo $d['dist_name']; ?>" class='' title=""><?php echo $d['dist_name']; ?>
                 </a>
               </td>
               <td class="text-sm text-center">
                 <span class=""><?php echo $d['total_patta_count']; ?> </span>
               </td>

               <td class="text-sm text-center">
                 <span class=""><?php echo $d['patta_count']; ?> </span>
               </td>

                <td class="text-sm text-center">
                 <span class="text-danger"> <?php echo $d['remaining_patta_count']; ?> </span>
		</td> 

                <?php if($d['rank'] == 1) :?>
                   <td class="text-sm text-center bg-dark">
                     <span class="text-primary font-weight-bold"> <?php echo $d['rank']; ?> </span>
		   </td>
                 <?php elseif($d['rank'] == 2) :?>
                   <td class="text-sm text-center bg-dark">
                     <span class="text-info font-weight-bold"> <?php echo $d['rank']; ?> </span>
		   </td>
                 <?php elseif($d['rank'] == 3) :?>
                   <td class="text-sm text-center bg-dark">
                     <span class="text-success font-weight-bold"> <?php echo $d['rank']; ?> </span>
                   </td>

                 <?php else :?>
                   <td class="text-sm text-center bg-dark">
                     <span class="text-danger font-weight-bold"> <?php echo $d['rank']; ?> </span>
                   </td>
                 <?php endif; ?>

             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
   </section>

</div>
</div>
