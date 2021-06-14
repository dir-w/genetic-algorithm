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
 { data: 'kapasitas' },
 { data: 'namahari' },
 { data: 'start' },
 { data: 'end' },
 { data: 'tipe_semester' },
 { data: 'tgl_pr' },
 { data: 'Aksi'},
 ]
});


$("#ilang").hide();

$(function(){
  $('#kodemk').on('click', function(){
    const id =$('#kodemk').val();
    $("#ilang").show();
      // $("#ilang1").show();

      $.ajax({
        url : "dataMK",
        data: {kode : id},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#namamk').val(data.nama);
          $('#kapas').val(data.kapasitas);
        // $('#ModalHapus').modal('show');
        // console.log(data);
      }
    });
    });
}); 

$("#ilang3").hide();
$(function(){
  $('#pjawab').on('click', function(){
    const id =$('#pjawab').val();
    $("#ilang3").show();

    $.ajax({
      url : "dataPJ",
      data: {kode_p : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#keg').val(data.kegiatan);

      }
    });
  });
});

$("#ilang2").hide();  
$(function(){
  $('#nruang').on('click', function(){
    const id =$('#nruang').val();
    $("#ilang2").show();

    $.ajax({
      url : "dataNR",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kapas').val(data.kapasitas);
      }
    });
  });
});




});



