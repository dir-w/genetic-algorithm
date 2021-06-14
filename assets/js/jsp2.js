$(document).ready(function(){

// PROSES INPUT PEMAKAIAN
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

//GET DATA HAPUS
$(function(){
  $('#inputTable').on('click','.item_hapuspemakaian', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "pemakaiangetEdit",
      data: {id_pemakaian : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#narung').val('Nama Ruangan : ' + data.nama);
        $('#ModalHapusPemakaian').modal('show');
        // console.log(data);
      }
    });
  });
});

//Hapus 
$('#btn_hapuspemakaian').on('click',function(){
  var id_pemakaian=$('#ko').val();
  $.ajax({
    type : "POST",
    url  : "pemakaiandelete",
    dataType : "JSON",
    data : {id_pemakaian: id_pemakaian},
    success: function(data){
      $('#ModalHapusPemakaian').modal('hide');
      window.location.assign('pemakaian');
    }
  });
  return false;
});

// END PROSES PEMAKAIAN

});



