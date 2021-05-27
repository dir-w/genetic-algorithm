
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

// get data hapus TA
// $(function(){
//   $('#dosenTable').on('click','.item_hapusdosen',function(){
//     var kode=$(this).attr('data');
//     // var name=$(this).attr('data-nam');
//     // console.log(kode);
//     $('#ModalHapusDosen').modal('show');
//     $('#kode').val(kode);
//     // $('#namad').val(name);

//   });
// });

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



// end Dosen

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
 { data: 'id_jenis' },
 { data : 'Aksi'},
 ]
});

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