
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
 { data: 'start' },
 { data: 'end' },
 { data : 'Aksi'},
 ]
}); 

//GET DATA HAPUS JURUSAN
$(function(){
  $('#jamTable').on('click','.item_hapus', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "jamgetEdit",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#se').val(data.gab);
        $('#ModalHapus').modal('show');
        // console.log(data);
      }
    });
  });
});


        //Hapus jam
        $('#btn_hapus').on('click',function(){
          var kode=$('#ko').val();
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
// console.log(id);
$.ajax({
  url:"jamgetEdit",
  data: {kode : id},
  method: 'POST',
  dataType: 'JSON',
  success: function(data) {

    $('#kode').val(id);
    $('#range_jamm').val(data.start);
    $('#range_jammm').val(data.end);
    // console.log(data);
    $('#ModalEdit').modal('show');
  }
});
});
  });

  // edit save
  $(function(){
    $('#btn_edit').on('click', function(){
      var kode =$('#kode').val();
      var start =$('#range_jamm').val();
      var end =$('#range_jammm').val();
      var range_jam = start + "-" + end;
      $.ajax({
        method : 'POST',
        url : 'editJam',
        dataType : 'JSON',
        data : {kode:kode, start:start, end:end},

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

// start MASTER TYPE MATA KULIAH

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
 { data: 'nama_typemk' },
 { data: 'keterangan_typemk' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS Type MATAKULIAH
$(function(){
  $('#typeTable').on('click','.item_hapustypematkul', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetTypeMatKul",
      data: {idtpel : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idtpe').val(id);
        $('#namatmk').val(data.nama_typemk);
        $('#ModalHapusTypeMatKul').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapustypematkkul').on('click',function(){
    var idtpel=$('#idtpe').val();
    $.ajax({
      type : "POST",
      url  : "typematkuldelete",
      dataType : "JSON",
      data : {idtpel: idtpel},
      success: function(data){
        // console.log(data);
        $('#ModalHapusTypeMatKul').modal('hide');
        window.location.assign('typematkul');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#typeTable').on('click','.edit_typematkul', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetTypeMatKul",
      data: {idtpel : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idtpel').val(id);
        $('#namatypemk').val(data.nama_typemk);
        $('#ketmk').val(data.keterangan_typemk);
        $('#ModalEditTypeMatkul').modal('show');
      }
    });
  });
});

$(function(){
  $('#btn_edittypematkul').on('click', function(){
    var idtpel =$('#idtpel').val();
    var nama_typemk =$('#namatypemk').val();
    var keterangan_typemk =$('#ketmk').val();
    $.ajax({
      method: 'POST',
      url: 'edittypeMatKul',
      dataType: 'JSON',
      data: {idtpel:idtpel, nama_typemk:nama_typemk, keterangan_typemk:keterangan_typemk},
      success: function(data){
        $('#idtpel').val("");
        $('#namatypemk').val("");
        $('#ketmk').val("");
        $('#ModalEditTypeMatkul').modal('hide');
      }
    });
  });
});

// end MASTER TYPE MATA KULIAH

// start MASTER MATA KULIAH

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

 { data: 'nama_typemk' },
 { data: 'keterangan' },
 { data: 'semester' },
 { data: 'nama_prodi' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS MATAKULIAH
$(function(){
  $('#matkulTable').on('click','.item_hapusmatkul', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetMatKul",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#kode').val(id);
        $('#namamkk').val(data.nama);
        $('#ModalHapusMatKul').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapusmatkul').on('click',function(){
    var kode=$('#kode').val();
    $.ajax({
      type : "POST",
      url  : "matkuldelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusMatKul').modal('hide');
        window.location.assign('matkul');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#matkulTable').on('click','.edit_matkul', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetMatKul",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#kodemkkk1').val(id);
        $('#kelmkkk').val(data.id_kelompok);
        $('#kodemkkk').val(data.nama_kode);
        $('#namamkkk').val(data.nama);
        $('#typemkk').val(data.id_type);
        $('#pararelmk').val(data.id_pararel);
        $('#smkk').val(data.id_semester_tipe);
        $('#prodi').val(data.kode_prodi);
        $('#jjmkk').val(data.jumlah_jam);
        $('#ModalEditMatkul').modal('show');
      }
    });
  });
});

$(function(){
  $('#btn_editmatkul').on('click', function(){
    var kode =$('#kodemkkk1').val();
    var id_kelompok =$('#kelmkkk').val();
    var nama_kode =$ ('#kodemkkk').val();
    var nama =$ ('#namamkkk').val();
    var id_type =$ ('#typemkk').val();
    var id_pararel =$ ('#pararelmk').val();
    var id_semester_tipe =$ ('#smkk').val();
    var kode_prodi =$ ('#prodi').val();
    var jumlah_jam =$ ('#jjmkk').val();

    $.ajax({
      method: 'POST',
      url: 'editMatKul',
      dataType: 'JSON',
      data: {kode:kode, id_kelompok:id_kelompok, nama_kode:nama_kode, nama:nama, id_type:id_type, id_pararel:id_pararel, id_semester_tipe:id_semester_tipe, kode_prodi:kode_prodi, jumlah_jam:jumlah_jam},
      success: function(data){
        $('#kodemkkk1').val("");
        $('#kelmkkk').val("");
        $('#kodemkkk').val("");
        $('#namamkkk').val("");
        $('#typemkk').val("");
        $('#pararelmk').val("");
        $('#smkk').val("");
        $('#prodi').val("");
        $('#jjmkk').val("");
        $('#ModalEditMatkul').modal('hide');
      }
    });
  });
});

// end MASTER MATA KULIAH

// start MASTER KELOMPOK MATA KULIAH

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

//GET DATA HAPUS Type MATAKULIAH
$(function(){
  $('#kelmatkulTable').on('click','.item_hapuskelmatkul', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetKelMatKul",
      data: {idk : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idkel').val(id);
        $('#nama_kelo').val(data.nama_kelompok_mk);
        $('#ModalHapusKelMatKul').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapustkelmatkkul').on('click',function(){
    var idk=$('#idkel').val();
    $.ajax({
      type : "POST",
      url  : "kelmatkuldelete",
      dataType : "JSON",
      data : {idk: idk},
      success: function(data){
        // console.log(data);
        $('#ModalHapusKelMatKul').modal('hide');
        window.location.assign('kelmatkul');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#kelmatkulTable').on('click','.edit_kelmatkul', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetKelMatKul",
      data: {idk : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#idk').val(id);
        $('#nama_kelompok').val(data.nama_kelompok_mk);
        $('#ket_kelompok').val(data.ket_kelompok);
        $('#ModalEditKelMatkul').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editkelmatakuliah').on('click', function(){
    var idk =$('#idk').val();
    var nama_kelompok_mk =$('#nama_kelompok').val();
    var ket_kelompok =$('#ket_kelompok').val();
    $.ajax({
      method: 'POST',
      url: 'editkelMatKul',
      dataType: 'JSON',
      data: {idk:idk, nama_kelompok_mk:nama_kelompok_mk, ket_kelompok:ket_kelompok},
      success: function(data){
        $('#idk').val("");
        $('#nama_kelompok').val("");
        $('#ket_kelompok').val("");
        $('#ModalEditKelMatkul').modal('hide');
      }
    });
  });
});

// end MASTER MATA KULIAH

// start MASTER PARAREL MATA KULIAH
$('#pararelmatkulTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"pararelmatkulList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 
 { data: 'keterangan' }, 
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS PARAREL MATAKULIAH
$(function(){
  $('#pararelmatkulTable').on('click','.item_hapuspararelmatkul', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "targetPararelMatKul",
      data: {idjmk : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#idjm').val(id);
        $('#nama_j').val(data.keterangan);
        $('#ModalHapusPararelMatKul').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapustpararelmatkkul').on('click',function(){
    var idjmk=$('#idjm').val();
    $.ajax({
      type : "POST",
      url  : "pararelmatkuldelete",
      dataType : "JSON",
      data : {idjmk: idjmk},
      success: function(data){
        // console.log(data);
        $('#ModalHapusJenisMatKul').modal('hide');
        window.location.assign('pararelmatkul');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#pararelmatkulTable').on('click','.edit_pararelmatkul', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url:"targetPararelMatKul",
      data: {idjmk : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#idjmk').val(id);
        $('#nama_pararelmk').val(data.keterangan);
        $('#ModalEditPararelMatkul').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editpararelmatakuliah').on('click', function(){
    var idjmk =$('#idjmk').val();
    var keterangan =$('#nama_pararelmk').val();
    $.ajax({
      method: 'POST',
      url: 'editpararelMatKul',
      dataType: 'JSON',
      data: {idjmk:idjmk, keterangan:keterangan},
      success: function(data){
        $('#idjmk').val("");
        $('#nama_pararelmk').val("");
        $('#ModalEditPararelMatkul').modal('hide');
      }
    });
  });
});
// end MASTER JENIS MATA KULIAH

// start MASTER PRODI
$('#prodiTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"prodiList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'id_prodi'},
 { data: 'nama_prodi'},
 { data: 'nama_fakultas' },
 
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS PRODI
$(function(){
  $('#prodiTable').on('click','.item_hapusprodi', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "tagetProdi",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#nama_prod').val(data.nama_prodi);
        $('#ModalHapusProdi').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapusprodi').on('click',function(){
    var kode=$('#ko').val();
    $.ajax({
      type : "POST",
      url  : "prodidelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusProdi').modal('hide');
        window.location.assign('prodi');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#prodiTable').on('click','.edit_prodi', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"tagetProdi",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#kode').val(id);
        // $('#koprodi').val(id_prodi);
        $('#nama_prodi').val(data.nama_prodi);
        $('#kode_fakultas').val(data.kode_fakultas);
        $('#koprodi').val(data.id_prodi);
        $('#ModalEditProdi').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editprodi').on('click', function(){
    var kode =$('#kode').val();
    var nama_prodi =$('#nama_prodi').val();
    var kode_fakultas =$('#kode_fakultas').val();
    var id_prodi =$('#koprodi').val();
    // alert(kode_jurusan);
    $.ajax({
      method: 'POST',
      url: 'editProdi',
      dataType: 'JSON',
      data: {kode:kode, nama_prodi:nama_prodi, kode_fakultas:kode_fakultas, id_prodi:id_prodi},
      success: function(data){
        $('#kode').val("");
        $('#nama_prodi').val("");
        $('#kode_fakultas').val("");
        $('#koprodi').val("");
        $('#ModalEditProdi').modal('hide');
      }
    });
  });
});
// end MASTER PRODI

// start MASTER JURUSAN
$('#fakultasTable').DataTable ({
  'processing' : true,
  'serverSide' : true,
  'serverMethod' : 'post',
  'ajax' : {

    type : "POST",
    url:"fakultasList"

  },
  'columns' : [
  { data: null,"sortable": false, render: function (data, type, row, meta){
   return meta.row + meta.settings._iDisplayStart + 1;
 }   },
 { data: 'nama_fakultas' },
 { data : 'Aksi'},
 ]
});

//GET DATA HAPUS
$(function(){
  $('#fakultasTable').on('click','.item_hapusfakultas', function(){
    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: "targetFakultas",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        $('#ko').val(id);
        $('#nama_fak').val('Nama Fakultas : ' + data.nama_fakultas);
        $('#ModalHapusFakultas').modal('show');
        // console.log(data);
      }
    });
  });
});

$(function(){
  $('#btn_hapusfakultas').on('click',function(){
    var kode=$('#ko').val();
    $.ajax({
      type : "POST",
      url  : "fakultasdelete",
      dataType : "JSON",
      data : {kode: kode},
      success: function(data){
        // console.log(data);
        $('#ModalHapusFakultas').modal('hide');
        window.location.assign('fakultas');
      }
    });
    return false;
  }); 
});

//GET UPDATE
$(function(){
  $('#fakultasTable').on('click','.edit_fakultas', function(){
    const id = $(this).data('id');
    $.ajax({
      url:"targetFakultas",
      data: {kode : id},
      method: 'POST',
      dataType: 'JSON',
      success: function(data) {
        // console.log(data);
        $('#kode').val(id);
        $('#nama_fakultas').val(data.nama_fakultas);
        $('#ModalEditFakultas').modal('show');
        
      }
    });
  });
});

$(function(){
  $('#btn_editfakultas').on('click', function(){
    var kode =$('#kode').val();
    var nama_fakultas =$('#nama_fakultas').val();
    // alert(kode_jurusan);
    $.ajax({
      method: 'POST',
      url: 'editFakultas',
      dataType: 'JSON',
      data: {kode:kode, nama_fakultas:nama_fakultas},
      success: function(data){
        $('#kode').val("");
        $('#nama_fakultas').val("");
        $('#ModalEditFakultas').modal('hide');
      }
    });
  });
});
// end MASTER JURUSAN





});