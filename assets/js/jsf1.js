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

//GET DATA HAPUS FASILITAS
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

//GET UPDATE
$(function(){
  $('#fasilitasTable').on('click','.edit_fasilitas', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetFasilitas",
      data: {kode_f : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#kode').val(id);
        $('#nama_fasilitas').val(data.nama_fasilitas);
        $('#ModalEditFasilitas').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editfasilitas').on('click', function(){
    var kode_f =$('#kode').val();
    var nama_fasilitas =$('#nama_fasilitas').val();
    // alert(kode_jurusan);
    $.ajax({
      method: 'POST',
      url: 'editFasilitas',
      dataType: 'JSON',
      data: {kode_f:kode_f, nama_fasilitas:nama_fasilitas},
      success: function(data){
        $('#kode').val("");
        $('#nama_fasilitas').val("");
        $('#ModalEditFasilitas').modal('hide');
      }
    });
  });
});
// end JS Master Fasilitas

// start JS Master Peminjam
$('#peminjamTable').DataTable({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"peminjamList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'no_ppku' },
 { data: 'no_peminjam' },
 { data: 'kegiatan' },
 { data: 'tgl_surat_peminjaman' },
 { data: 'hari' },
 { data: 'tgl_kegiatan' },
 { data: 'nama_fasilitas' },
 { data: 'pj' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS PEMINJAM
$(function(){
  $('#peminjamTable').on('click','.item_hapuspeminjam', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetPeminjam",
      data: {kode_p : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#nopk').val(data.no_ppku);
        $('#ModalHapusPeminjam').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapuspeminjam').on('click',function(){
    var kode_p=$('#ko').val();
    $.ajax({
      type : "POST",
      url  : "peminjamdelete",
      dataType : "JSON",
      data : {kode_p: kode_p},
      success: function(data){
        // console.log(data);
        $('#ModalHapusPeminjam').modal('hide');
        window.location.assign('peminjaman');
      }
    });
    return false;
  }); 
});
// end JS Master Peminjam