
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
      $('#ModalHapusHari').modal('show');
      $('#kode').val(kode);
  });

});
//Hapus hari
$(function(){

        $('#btn_hapus').on('click',function(){
          var kode=$('#tkode').val();
          $.ajax({
            type : "POST",
            url  : "haridelete",
            dataType : "JSON",
            data : {kode: kode},
            success: function(data){
              $('#ModalHapusHari').modal('hide');
              window.location.assign('hari');
            }
          });
          return false;
        }); 
});

//GET UPDATE
  $(function(){
    $('#hariTable').on('click','.tampilModaledithari', function(){
      const id = $(this).data('id');
      // console.log(id);

      $.ajax({
        url:"harigetEdit",
        data: {kode : id},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#kode').val(id);
          $('#nhari').val(data.nama);
          $('#id_hari').val(data.id_hari);
          
          $('#ModalEditHari').modal('show');
        }
      });
    });
  });

  // edit save
  $(function(){
    $('#btn_edit').on('click', function(){
      var kode =$('#kode').val();
      var nama =$('#nhari').val();
      var id_hari =$('#id_hari').val();
      
      $.ajax({
        method : 'POST',
        url : 'editHari',
        dataType : 'JSON',
        data : {kode:kode, nama:nama, id_hari:id_hari},

        success: function(data){
          // console.log(data);
          $('#kode').val("");
          $('#nhari').val("");
          $('#nama').val("");
          $('#id_hari').val("");
          $('#ModalEditHari').modal('hide');
          // window.location.assign('jam');
        }
      });
      // alert(kode);
      // console.log(range);
    });
  });



// end hari 

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