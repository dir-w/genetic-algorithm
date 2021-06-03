
$(document).ready(function(){

// jam
$('#jamTable').DataTable({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"jamList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'range_jam' },

 { data : 'Aksi'},
 ]
}); 

// get data hapus jam
$('#jamTable').on('click','.item_hapus',function(){
  var kode=$(this).attr('data');
  $('#ModalHapus').modal('show');
  $('[name="kode"]').val(kode);
});

        //Hapus jam
        $('#btn_hapus').on('click',function(){
          var kode=$('#textkode').val();
          $.ajax({
            type : "POST",
            url  : "jamdelete",
            dataType : "JSON",
            data : {kode: kode},
            success: function(data){
              $('#ModalHapus').modal('hide');
              window.location.assign('jam');
            }
          });
          return false;
        }); 

  //GET UPDATE
  $(function(){
    $('#jamTable').on('click','.tampilModaleditjam', function(){
      const id = $(this).data('id');

      $.ajax({
        url:"jamgetEdit",
        data: {kode : id},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#kode').val(id);
          $('#range_jamm').val(data.range_jam.substring(0,5));
          $('#range_jammm').val(data.range_jam.substring(6,11));
          // console.log(data.range_jam.substring(0,5));
          $('#ModalEdit').modal('show');
        }
      });
    });
  });

  // edit save
  $(function(){
    $('#btn_edit').on('click', function(){
      var kode =$('#kode').val();
      var r1 =$('#range_jamm').val();
      var r2 =$('#range_jammm').val();
      var range_jam = r1 + "-" + r2;
      $.ajax({
        method : 'POST',
        url : 'editJam',
        dataType : 'JSON',
        data : {kode:kode, range_jam:range_jam},

        success: function(data){
          // console.log(data);
          $('#koder').val("");
          $('#range_jam').val("");
          $('#range_jamm').val("");
          $('#ModalEdit').modal('hide');
          // window.location.assign('jam');
        }
      });
      // alert(kode);
      // console.log(range);
    });
  });
  

// end jam

// start hari

$('#hariTable').DataTable({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"hariList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama' },
 
 { data : 'Aksi'},
 ]
});

// get data hapus hari
$(function(){

  $('#hariTable').on('click','.item_hapus',function(){
    var kode=$(this).attr('data');
      // console.log(kode);
      $('#ModalHapusHari').modal('show');
      $('#kode').val(kode);
    });

});
//Hapus hari
$(function(){

  $('#btn_hapushari').on('click',function(){
    var kode=$('#kode').val();
    $.ajax({
      type : "POST",
      url  : "haridelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        console.log(data);
        $('#ModalHapusHari').modal('hide');
        window.location.assign('hari');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#hariTable').on('click','.edit_hari', function(){
    const id = $(this).data('id');
      // console.log(id);
      $.ajax({
        url:"harigetEdit",
        data: {kode : id},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#ekode').val(id);
          $('#nhari').val(data.nama);
          $('#id_hari').val(data.id_hari);
          $('#ModalEditHari').modal('show');
        }
      });
    });
});

  // edit save
  $(function(){
    $('#btn_edithari').on('click', function(){
      var kode =$('#ekode').val();
      var nama =$('#nhari').val();
      var id_hari =$('#id_hari').val();
      
      $.ajax({
        method : 'POST',
        url : 'editHari',
        dataType : 'JSON',
        data : {kode:kode, nama:nama},

        success: function(data){
          console.log(data);
          $('#ekode').val("");
          $('#nhari').val("");
          
          $('#id_hari').val("");
          $('#ModalEditHari').modal('hide');
          // window.location.assign('jam');
        }
      });
      
    });
  });



// end hari 


// start Tahun AJARAN

$('#taTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {
    type : "POST",
    url:"taList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'tahun' },
 { data : 'Aksi'},
 ]
});

// get data hapus TA
$(function(){
  $('#taTable').on('click','.item_hapusta',function(){
    var kode=$(this).attr('data');
    // console.log(kode);
    $('#ModalHapusTA').modal('show');
    $('#kode').val(kode);
  });
});

//Hapus TA
$(function(){
  $('#btn_hapusta').on('click',function(){
    var kode=$('#kode').val();
    $.ajax({
      type : "POST",
      url  : "tadelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusTA').modal('hide');
        window.location.assign('takademik');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#taTable').on('click','.edit_hari', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url:"tagetEdit",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#tkode').val(id);
        $('#ttta1').val(data.tahun.substring(0,4));
        $('#tttta2').val(data.tahun.substring(5,9));
        // console.log(data);
        $('#ModalEditTA').modal('show');
      }
    });
  });
});

// edit save
$(function(){
  $('#btn_editta').on('click', function(){
    var kode =$('#tkode').val();
    var ttta1 =$('#ttta1').val();
    var tttta2 =$('#tttta2').val();
    var id_hari =$('#id_hari').val();
    var tahun = ttta1 + "-" + tttta2;

    $.ajax({
      method: 'POST',
      url: 'editTA',
      dataType: 'JSON',
      data: {kode:kode, tahun:tahun},
      success: function(data){
        $('#tkode').val("");
        $('#ttta1').val("");
        $('#tttta2').val("");
        $('#ModalEditTA').modal('hide');
      }
    });
  });
});

// end tahun AJARAN


// start Dosen

$('#dosenTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"dosenList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nip' },
 { data: 'nama' },
 { data: 'alamat' },
 { data: 'telp' },
 { data: 'status_dosen' },
 { data: 'Aksi'},
 ]
});

//GET DATA HAPUS DOSEN
$(function(){
  $('#dosenTable').on('click','.item_hapusdosen', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url:"tagetDeleteDosen",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kode').val(id);
        $('#namad').val(data.nama);

        $('#ModalHapusDosen').modal('show');
      }
    });
  });
});

//Hapus Dosen
$(function(){
  $('#btn_hapusdosen').on('click',function(){
    var kode=$('#kode').val();
    $.ajax({
      type : "POST",
      url  : "dosendelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusDosen').modal('hide');
        window.location.assign('dosen');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#dosenTable').on('click','.edit_dosen', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url:"tagetDeleteDosen",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#dkode').val(id);
        $('#nipdo').val(data.nip);
        $('#namado').val(data.nama);
        $('#alamatdo').val(data.alamat);
        $('#telpdo').val(data.telp);
        $('#statusdo').val(data.status);
        $('#ModalEditDosen').modal('show');
      }
    });
  });
});

// edit save
$(function(){
  $('#btn_editdosen').on('click', function(){
    var kode =$('#dkode').val();
    var nip =$('#nipdo').val();
    var nama =$('#namado').val();
    var alamat =$('#alamatdo').val();
    var telp =$('#telpdo').val();
    var status_dosen =$('#statusdo').val();
    $.ajax({
      method: 'POST',
      url: 'editDosen',
      dataType: 'JSON',
      data: {kode:kode, nip:nip, nama:nama, alamat:alamat, telp:telp, status_dosen:status_dosen},
      success: function(data){
        $('#dkode').val("");
        $('#nipdo').val("");
        $('#namado').val("");
        $('#alamatdo').val("");
        $('#telpdo').val("");
        $('#statusdo').val("");
        $('#ModalEditDosen').modal('hide');
      }
    });
  });
});

// end Dosen


// start Master Ruangan

$('#ruangTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"ruangList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'id_ruang' },
 { data: 'nama' },
 { data: 'kapasitas' },
 { data: 'type' },
 { data: 'nama_jenis' },
 { data: 'lantai' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS Ruangan
$(function(){
  $('#ruangTable').on('click','.item_hapusruangan', function(){
    const id = $(this).data('id');
    // $('#ModalHapusRuangan').modal('show');
    $.ajax({
      url:"tagetDeleteRuangan",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kode').val(id);
        $('#namar').val(data.nama);

        $('#ModalHapusRuangan').modal('show');
      }
    });
  });
});

$(function(){
  $('#btn_hapusruangan').on('click',function(){
    var kode=$('#kode').val();
    $.ajax({
      type : "POST",
      url  : "ruangandelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusRuangan').modal('hide');
        window.location.assign('ruangan');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#ruangTable').on('click','.edit_ruangan', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetDeleteRuangan",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#rkode').val(id);
        $('#idru').val(data.id_ruang);
        $('#namaru').val(data.nama);
        $('#kapasitasru').val(data.kapasitas);
        $('#typeru').val(data.id_type);
        $('#jenis_ruanganru').val(data.id_jenis);
        $('#lantairu').val(data.lantai);
        $('#ModalEditRuangan').modal('show');
      }
    });
  });
});

// edit save
$(function(){
  $('#btn_editruangan').on('click', function(){
    var kode =$('#rkode').val();
    var id_ruang =$('#idru').val();
    var nama =$('#namaru').val();
    var kapasitas =$('#kapasitasru').val();
    var id_type =$('#typeru').val();
    var lantai =$('#lantairu').val();
    var id_jenis =$('#jenis_ruanganru').val();

    $.ajax({
      method: 'POST',
      url: 'editRuangan',
      dataType: 'JSON',
      data: {kode:kode, id_ruang:id_ruang, nama:nama, kapasitas:kapasitas, id_type:id_type, id_jenis:id_jenis, lantai:lantai},
      success: function(data){
        $('#koderu').val("");
        $('#idru').val("");
        $('#namaru').val("");
        $('#kapasitasru').val("");
        $('#typeru').val("");
        $('#jenis_ruanganru').val("");
        $('#lantairu').val("");
        $('#ModalEditRuangan').modal('hide');
      }
    });
  });
});

// end Master Ruangan

// start MASTER JENIS RUANGAN

$('#jenisruangTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"jenisruangList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_jenis' },
 { data: 'ket_jenis' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS Jenis Ruangan
$(function(){
  $('#jenisruangTable').on('click','.item_hapusjenisruangan', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetJenisRuangan",
      data: {idj : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idj').val(id);
        $('#nama_jenis').val(data.nama_jenis);
        $('#ModalHapusJenisRuangan').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapusjenisruangan').on('click',function(){
    var idj=$('#idj').val();
    $.ajax({
      type : "POST",
      url  : "jenisruangandelete",
      dataType : "JSON",
      data : {idj: idj},
      success: function(data){
        // console.log(data);
        $('#ModalHapusJenisRuangan').modal('hide');
        window.location.assign('jenisruangan');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#jenisruangTable').on('click','.edit_jenisruangan', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetJenisRuangan",
      data: {idj : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idjr').val(id);
        $('#nama_jenisr').val(data.nama_jenis);
        $('#ket_jenisr').val(data.ket_jenis);
        $('#ModalEditJenisRuangan').modal('show');
      }
    });
  });
});

// edit save
$(function(){
  $('#btn_editjenisruangan').on('click', function(){
    var idj =$('#idjr').val();
    var nama_jenis =$('#nama_jenisr').val();
    var ket_jenis =$('#ket_jenisr').val();
    
    $.ajax({
      method: 'POST',
      url: 'editjenisRuangan',
      dataType: 'JSON',
      data: {idj:idj, nama_jenis:nama_jenis, ket_jenis:ket_jenis},
      success: function(data){
        $('#idjr').val("");
        $('#nama_jenisr').val("");
        $('#ket_jenisr').val("");
        $('#ModalEditJenisRuangan').modal('hide');
      }
    });
  });
});

// end MASTER JENIS RUANGAN

// start MASTER TYPE RUANGAN
$('#typeruangTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"typeruangList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_type' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS Type Ruangan
$(function(){
  $('#typeruangTable').on('click','.item_hapustyperuangan', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetTypeRuangan",
      data: {idt : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idt').val(id);
        $('#nama_type').val(data.nama_type);
        $('#ModalHapusTypeRuangan').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapustyperuangan').on('click',function(){
    var idt=$('#idt').val();
    $.ajax({
      type : "POST",
      url  : "typeruangandelete",
      dataType : "JSON",
      data : {idt: idt},
      success: function(data){
        // console.log(data);
        $('#ModalHapusTypeRuangan').modal('hide');
        window.location.assign('typeruangan');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#typeruangTable').on('click','.edit_typeruangan', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetTypeRuangan",
      data: {idt : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idtru').val(id);
        $('#nama_typeru').val(data.nama_type);
        $('#ModalEditTypeRuangan').modal('show');
      }
    });
  });
});

$(function(){
  $('#btn_edittyperuangan').on('click', function(){
    var idt =$('#idtru').val();
    var nama_type =$('#nama_typeru').val();
    $.ajax({
      method: 'POST',
      url: 'edittypeRuangan',
      dataType: 'JSON',
      data: {idt:idt, nama_type:nama_type},
      success: function(data){
        $('#idtru').val("");
        $('#nama_typeru').val("");
        $('#ModalEditTypeRuangan').modal('hide');
      }
    });
  });
});


// end MASTER TYPE RUANGAN

$('#typeTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"typeList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'keterangan' },
 { data : 'Aksi'},
 ]
});

$('#matkulTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"matkulList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_kelompok_mk'},
 { data: 'nama_kode' },
 { data: 'nama' },

 { data: 'keterangan' },
 { data: 'jenis' },
 { data: 'semester' },
 
 { data : 'Aksi'},
 ]
});

$('#kelmatkulTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"kelmatkulList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 
 { data: 'nama_kelompok_mk' },
 { data: 'ket_kelompok' },
 
 { data : 'Aksi'},
 ]
});







});