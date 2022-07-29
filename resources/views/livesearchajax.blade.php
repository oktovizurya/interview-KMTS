<?php
if(!empty($posts))  
{ 
    $count = 1;
    $outputhead = '';
    $outputbody = '';  
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
                    <table class="table table-bordered">
                        
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        
                        
                ';
                  
    foreach ($posts as $post)    
    {   
    $outputbody .=  ' 
                
                            <tr> 
		                        <td>'.$count++.'</td>
		                        <td>'.$post->nama_barang.'</td>
                                <td>'.$post->harga.'</td>
                            </tr> 
                    ';
                
    }  

    $outputtail .= ' 
                        
                    </table>
                </div>';
         
    echo $outputhead; 
    echo $outputbody; 
    echo $outputtail; 
 }  
 
 else  
 {  
    echo 'Data Not Found';  
 } 
 ?>  