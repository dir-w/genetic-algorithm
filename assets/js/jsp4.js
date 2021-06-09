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

});

