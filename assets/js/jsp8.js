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
        // $('#se').val(data.gab);
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

// $("#ilang3").hide();  
// $(function(){
//   $('#ja').on('click', function(){
//     const id =$('#ja').val();
//     $("#ilang3").show();

//     $.ajax({
//       url : "dataJSE",
//       data: {kode : id},
//       method: 'POST',
//       dataType: 'JSON',
//       success: function(data) {
//         $('#jstart').val(data.start);
//         $('#jend').val(data.end);

//       }
//     });
//   });
// });




});



