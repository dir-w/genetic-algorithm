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
 // { data: 'namahari' },
 // { data: 'start' },
 // { data: 'end' },
 // { data: 'tipe_semester' },
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

 //GET UPDATE
 $(function(){
  $('#inputTable').on('click','.edit_pemakaian', function(){
    const id = $(this).data('id');

// console.log(id);
$.ajax({
  url:"pemakaiangetEdit",
  data: {id_pemakaian : id},
  method: 'POST',
  dataType: 'JSON',
  success: function(data) {

    $('#id_pemakaian').val(id);
    $('#kode_mk').val(data.kode_mk);
    $('#p_jawab').val(data.kode_peminjam);
    $('#n_ruang').val(data.kode_ruangan);
    $('#tgl').val(data.tgl_pr);
    $('#n_d').val(data.kode_dosen);
    $('#semester').val(data.kode_semester_tipe);
    $('#hari').val(data.kode_hari);
    $('#jam').val(data.kode_jam);
    $('#kapasitas').val(data.kapasitas);
    $('#nama_mk').val(data.napel);
    $('#kegiatan').val(data.kegiatan);
    $('#tha').val(data.kode_tahun_akademik);
    $('#smstr').val(data.kode_semester);
    // console.log(data);
    $('#ModalEditPemakaian').modal('show');
  }
});
});
});

// klik kode mk edit menampilkan nama matakuliah
$(function(){
  $('#kode_mk').on('click', function(){
    const id =$('#kode_mk').val();

    // $("#ilang").show();
      // $("#ilang1").show();

      $.ajax({
        url : "dataMK",
        data: {kode : id},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#nama_mk').val(data.nama);
          $('#kapasitas').val(data.kapasitas);
        // $('#ModalHapus').modal('show');
        // console.log(data);
      }
    });
    });
});

// peminjam klik menampilkan nama kegiatan
$(function(){
  $('#p_jawab').on('click', function(){
    const id =$('#p_jawab').val();
    // $("#ilang3").show();

    $.ajax({
      url : "dataPJ",
      data: {kode_p : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kegiatan').val(data.kegiatan);

      }
    });
  });
});

// klik nama ruangan edit menampilkan data kapasitas
$(function(){
  $('#n_ruang').on('click', function(){
    const id =$('#n_ruang').val();
    // $("#ilang2").show();

    $.ajax({
      url : "dataNR",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kapasitas').val(data.kapasitas);
      }
    });
  });
});


//text input rubah menjadi text=date modal edit
$("#tglpem").hide();
$(function(){
  $('#tgl').on('click', function(){
    $("#tgl").hide();
    $("#tglpem").show();
  });
});


// edit save
$(function(){
  $('#btn_editpemakaian').on('click', function(){
    var id_pemakaian =$('#id_pemakaian').val();
    var kode_mk =$('#kode_mk').val();
    var kode_peminjam =$('#p_jawab').val();
    var kode_ruangan =$('#n_ruang').val();
    var kode_jam =$('#jam').val();
    var kode_hari =$('#hari').val();
    var kode_dosen =$('#n_d').val();
    var kode_semester_tipe =$('#semester').val();
    var tgl_pr =$('#tglpem').val();
    var kode_tahun_akademik =$('#tha').val();
    var kode_semester =$('#smstr').val();
    var update_by =$('#nama_user').val();
    // alert(tgl_pr);
    $.ajax({
      method : 'POST',
      url : 'editPR',
      dataType : 'JSON',
      data : {id_pemakaian:id_pemakaian, kode_mk:kode_mk, kode_peminjam:kode_peminjam, kode_ruangan:kode_ruangan, kode_jam:kode_jam, kode_hari:kode_hari, kode_dosen:kode_dosen, kode_semester_tipe:kode_semester_tipe, tgl_pr:tgl_pr, kode_tahun_akademik:kode_tahun_akademik, kode_semester:kode_semester, update_by:update_by},
      // data : {id_pemakaian:id_pemakaian, kode_mk:kode_mk},

      success: function(data){
        // console.log(data);
        $('#kode_mk').val("");
        $('#p_jawab').val("");
        $('#jam').val("");
        $('#hari').val("");
        $('#n_d').val("");
        $('#semester').val("");
        $('#tgl').val("");
        $('#nama_user').val("");
        $('#tha').val("");
        $('#smstr').val("");
          // $('#n_ruang').val("");
          $('#ModalEditPemakaian').modal('hide');
          // window.location.assign('jam');
        }
      });
      // alert(kode);
      // console.log(range);
    });
});

//GET DETAIL
$(function(){
  $('#inputTable').on('click','.detail_pemakaian', function(){
    const id = $(this).data('id');

    
    $.ajax({
      url:"pemakaiangetEdit",
      data: {id_pemakaian : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // $('#dkoderi').html('kkkk');
        $('#idpemakaian').val(data.kode_ruangan);
        $('#dta').html(data.tahun);
        $('#dkoder').html(data.id_ruang);
        $('#dnamapeminjam').html(data.pj);
        $('#dnamar').html(data.namar);
        $('#dkodemk').html(data.nama_kode);
        $('#dnamamk').html(data.nama);
        $('#dkegiatan').html(data.kegiatan);
        $('#dnamatypemk').html(data.keterangan_typemk);
        $('#dketeranganp').html(data.keterangan);
        $('#dsemtipe').html(data.smst);
        $('#dsem').html(data.nama_semester);
        $('#dhari').html(data.hari);
        $('#dta').html(data.tahun);
        $('#djam').html('Start : ' + data.start + '       End : ' + data.end);
        $('#dtglpr').html(data.tgl_pr);
        $('#dfakultas').html(data.nama_fakultas);
        $('#ModalDetailPemakaian').modal('show');


    // alert(kmk);
  }
});
  });
});


// END PROSES PEMAKAIAN

// PROSES ALGO
$('#algoTable').DataTable({
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
 // { data: 'namahari' },
 // { data: 'start' },
 // { data: 'end' },
 // { data: 'tipe_semester' },
 { data: 'tgl_pr' },
 { data: 'Aksi'},
 ]
});

// END PROSES ALGORITMA






});



