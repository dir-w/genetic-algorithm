// Start JS master Fasilitas
$('#fasilitasTable').DataTable({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"fasilitasList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_fasilitas' },

 { data : 'Aksi'},
 ]
}); 

//GET DATA HAPUS JURUSAN
$(function(){
  $('#fasilitasTable').on('click','.item_hapusfasilitas', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetFasilitas",
      data: {kode_f : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#nama_f').val(data.nama_fasilitas);
        $('#ModalHapusFasilitas').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapusfasilitas').on('click',function(){
    var kode_f=$('#ko').val();
    $.ajax({
      type : "POST",
      url  : "fasilitasdelete",
      dataType : "JSON",
      data : {kode_f: kode_f},
      success: function(data){
        // console.log(data);
        $('#ModalHapusFasilitas').modal('hide');
        window.location.assign('fasilitas');
      }
    });
    return false;
  }); 
});

// end JS Master Fasilitas