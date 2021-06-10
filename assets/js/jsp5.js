$(document).ready(function(){

// jam
$('#inputTable').DataTable({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"pinputList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_kode' },
 { data: 'pj' },
 { data: 'namaruang' },
 { data: 'namamp' },
 { data: 'namahari' },
 { data: 'start' },
 { data: 'end' },
 { data: 'tipe_semester' },
 { data: 'tgl_pr' },
 { data : 'Aksi'},
 ]
});

//GET DATA 
$(function(){
  $('#kodemk').on('click', function(){
    const id =$('#kodemk').val();

    // const id = $(this).data('id');
    // $('#namamk').val("<?php echo $mk['nama']; ?>");
    console.log(id);
    $.ajax({
      url : "dataMK",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#namamk').val(data.nama);
        // $('#se').val(data.gab);
        // $('#ModalHapus').modal('show');
        // console.log(data);
      }
    });
  });
}); 



});



