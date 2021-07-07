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
 { data: 'nama_type' },
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

//GET UPDATE
$(function(){
  $('#peminjamTable').on('click','.edit_peminjam', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetPeminjam",
      data: {kode_p : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#kode_p').val(id);
        $('#no_ppku').val(data.no_ppku);
        $('#no_peminjam').val(data.no_peminjam);
        $('#kegiatan').val(data.kegiatan);
        $('#tglsp').val(data.tgl_surat_peminjaman);
        $('#hari').val(data.hari);
        $('#tglkeg').val(data.tgl_kegiatan);
        $('#idtyper').val(data.id_type_ruangan);
        $('#penanggungj').val(data.pj);
        $('#ModalEditPeminjam').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editpeminjam').on('click', function(){
    var kode_p =$('#kode_p').val();
    var no_ppku =$('#no_ppku').val();
    var no_peminjam =$('#no_peminjam').val();
    var kegiatan =$('#kegiatan').val();
    var tgl_surat_peminjaman =$('#tglsp').val();
    var hari =$('#hari').val();
    var tgl_kegiatan =$('#tglkeg').val();
    var id_type_ruangan =$('#idtyper').val();
    var pj =$('#penanggungj').val();
    // alert(tgl_surat_peminjaman);
    $.ajax({
      method: 'POST',
      url: 'editPeminjam',
      dataType: 'JSON',
      data: {kode_p:kode_p, no_ppku:no_ppku, no_peminjam:no_peminjam, kegiatan:kegiatan, tgl_surat_peminjaman:tgl_surat_peminjaman, hari:hari, tgl_kegiatan:tgl_kegiatan, id_type_ruangan:id_type_ruangan, pj:pj},
      success: function(data){
        $('#kode_p').val("");
        $('#no_ppku').val("");
        $('#no_peminjam').val("");
        $('#kegiatan').val("");
        $('#tglsp').val("");
        $('#hari').val("");
        $('#tglkeg').val("");
        $('#idtyper').val("");
        $('#penanggungj').val("");
        $('#ModalEditPeminjam').modal('hide');
      }
    });
  });
});
// end JS Master Peminjam