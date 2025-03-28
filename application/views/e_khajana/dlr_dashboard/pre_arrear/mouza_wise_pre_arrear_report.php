<div class="container-fluid">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/EkhajanaDashboard/index">Home</a></li>
       <li class="breadcrumb-item"><a href="#">Circle-Wise-Ekhajana</a></li>

     </ol>
   </nav>



   <section class="content ms-5 me-5">
     <h4 class="text-center">Mouza Wise E-Khajana (Arrear Updation Count)</h4>

     <div class="d-flex justify-content-between align-items-center">

       <table class="table table-bordered table-sm">

         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">Mouza</th>
             <th scope="col">Total Patta</th>
             <th scope="col">Updated Patta</th>
             <th scope="col">Remaining Patta</th>
           </tr>
         </thead>
         
         <tbody>
           <?php $i = 1;
            foreach ($mouza as $d) : ?>
             <tr>

               <th scope="row"><?= $i++ ?></th>

               <td>
                 <a href="#" class='' title=""><?php echo $d['mouza_name']; ?>
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
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
   </section>

</div>
</div>
