<?php
$this->load->helper('fungsidate'); //kita load helper yang kita buat cukup
?>
<?php
echo "<strong><center>BUKU KAS</center></strong>";
echo "<table>";
echo "<center><strong>BUKU KAS</strong></center>";
foreach($userunits as $row){
echo "<tr><td>Nama Unit</td><td>:</td><td>".$row->namaunit."</td></tr> ";
echo "<tr><td>Dari Tanggal</td><td>:</td><td>".tgl_indo($params['tanggalawal'])."</td><td>sampai</td><td>".tgl_indo($params['tanggalakhir'])."</td></tr> ";
}
foreach($jeniskas as $row){
echo "<tr><td>KAS</td><td>:</td><td>".$row->nama_jenis_kas."</td></tr> ";    
}
echo "<tr><td>Tahun Pelajaran</td><td>:</td><td>".$params['tahunpelajaran']."</td></tr> ";  
echo "</table>"
?>

<table class="table table-bordered" width="150%" id="dataTable" cellspacing="0" border=1>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nomor</th>                    
                    <th>Uraian</th>
                    <th>No. Bt.</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $i =1; if(!empty($kasnya)) {
            $this->load->helper('fungsidate'); //kita load helper yang kita buat cukup
            foreach($kasnya as $kas) : { 
            ?>
            
                  <tr>
                    <td><?php echo $i;?></td>                    
                    <td><?php echo tgl_indo($kas->tanggal); ?></td>
                    <td><?php echo $kas->nomor; ?></td>
                    <td><?php echo $kas->uraian; ?></td>
                    <td><?php echo $kas->no_bt; ?></td>
                    <td><?php echo rupiah2($kas->Debet); ?></td>
                    <td><?php echo rupiah2($kas->Kredit); ?></td>
                    <td><?php echo rupiah2($kas->Saldo); ?></td>
                  </tr>
             <?php
             $i++;
              } endforeach;}
              ?>   
                </tbody>
</table>
<?php
echo"<footer> <p><i>printed by sistem informasi keuangan ypii (sikapi @ 2017)</i></p> </footer>.";
?>