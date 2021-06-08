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

// end JS Master Fasilitas