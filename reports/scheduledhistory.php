
<?php
require_once '../scripts/connection.php';
$ii = $_POST['single'];
	 $d1=$_POST['date1'];
	 $d2=$_POST['date2'];

	 $zer = 0;





	 
foreach ($ii as $a){
$mntharray[] = $a;
}
$mntharray1 = json_encode($mntharray);
$mntharray2 =  str_replace( array('[',']') , ''  , $mntharray1 );

//echo $mntharray1;
$name = array($mntharray2);

if (in_array("all", $mntharray)){
 // echo $mntharray2;
  //console("HHHH");
   $choose = "`regularpays` WHERE DATE(TransactionDate) BETWEEN '$d1'  AND '$d2'  ORDER BY TransactionDate DESC, accountsID DESC";  
}else{
  
 $choose = "`regularpays` WHERE  `memberID` IN ({$mntharray2}) AND DATE(TransactionDate) BETWEEN '$d1'  AND '$d2'  ORDER BY TransactionDate DESC, accountsID DESC";   
}





if(count($_POST)>0){
$stmt12 = $conn->prepare("SELECT * FROM ".$choose);
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						
						  // output data of each row
						 ?>
						 
				
          
		   <?php
						while($row12 = $result12->fetch_assoc()) {

							

								

							$tyes = "";
							if ($row12['Credit'] == "1"){
								$tyes = "Cr";
							}else {
								$tyes = "Dr";
								
							}
						//	number_format($num, 2);
							
?>							
<tr>
                    <th scope="row"><?php echo $row12['MemberNo']; ?></th>
                    <th scope="row"><?php echo $row12['TransactionDate']; ?></th>
					<th scope="row"><?php echo $row12['MemberSurname']."".$row12['MemberFirstname']; ?></th>
                    <td><?php echo $row12['Details']; ?></td>
                    <td><?php echo $tyes; ?></td>
                    <td><?php echo $row12['Comments']; ?></td>
                    <td><?php echo number_format($row12['StartingBalance'], 2); ?></td>
					<td><?php echo  number_format($row12['Amount'], 2);  ?></td>
					<td><?php echo number_format($row12['NewBalance'], 2); ?></td>
					<td>
			  
					</td>
                  </tr>
				   
<?php						
						
					}

						?>
						</tbody>
						 </table>
						 </div>
						<?php

} else {
	echo "NO Members found";
 } 

?>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

<?php						
						
} else {
  header('location: ./');
}
?>


    
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script>
$(document).ready(function() {
    $('#free').DataTable( {
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        dom: 'Blfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
       
        
    } );
    
  
} );
</script>


