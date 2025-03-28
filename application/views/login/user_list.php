<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/block_ui.js"></script>

<div class='container' style="margin-top:10px">
  <table class='table' id='user_list' border="1" border-collapse='collapse'>
    <thead>
      <tr>
         <th>Unique User</th> 
         <th>Name</th> 
         <th>Designation</th> 
         <th>User Type</th> 
         <th>User Code</th> 
         <th>Date of Joining</th> 
         <th>Status</th> 
         <th>Mobile</th> 
         <th>email</th> 
         <th>Display Name</th> 
         <th>Districts</th> 
         <th>Ref No</th> 
         <th>Action</th> 
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $user){ ?>
         <tr>
           <td><?=$user->unique_user_id?></td>
           <td><?=$user->name ?></td>
           <td><?=$user->designation?></td>
           <td><?=$user->user_type?></td>
           <td><?=$user->user_code?></td>
           <td><?=$user->date_of_joining?></td>
           <td><?=$user->status?></td>
           <td><?=$user->mobile_no?></td>
           <td><?=$user->email?></td>
           <td><?=$user->display_name?></td>
           <td><?=$user->districts?></td>
           <td><?=$user->auth_reff?></td>
           <td><button onclick='deleteUser("<?=$user->unique_user_id?>")'> Delete</button></td>
         </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#user_list').dataTable();
   } );
   var BASE_URL='<?=base_url()?>';
   function deleteUser(user_id) {
	const userData = { user_id : user_id};
        $.blockUI({
             message: $('#displayBox'),
             css: {
                border:'none',
                backgroundColor:'transparent'
              }
        });
 	$.ajax({
 		url: BASE_URL + "DepartmentApi/deleteUser",
 		type: "post",
 		dataType: "json",
 		contentType: "application/json",
 		error: function(error) {
 			$.unblockUI();
                        alert('error');
                },
 		success: function(data) {
 			$.unblockUI();
 			if (data.responseType == 1) {
                            alert(data.error);
			} else if (data.responseType == 2) {
                            alert(data.msg);
                        } 
		},
		data: JSON.stringify(userData)
	});
   }
</script>
