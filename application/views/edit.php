<?php   
        foreach ($data->result() as $v) {
                $idd         = $v->id_request;
                $unit       = $v->unit_permintaan;
                $dokumen    = $v->nomor_dokumen_pendukung;
                $tanggal    = $v->tanggal;
                $status    = $v->status;
                $file = $v->file_dokumen;
            } 
?>

<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Usulan Permintaan</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

    <script src="<?php echo base_url()?>assets/assets/site.js"></script>
    <script src="<?php echo base_url()?>assets/assets/ajaxfileupload.js"></script>
<!-- ####################################### ADMIN LTE CSS!-->
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/plugins/ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/dist/css/skins/_all-skins.min.css">
<!-- ####################################### ADMIN LTE CSS!-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head> 
<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>SM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SUP</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!--<div class="navbar-custom-menu">
            <ul class="nav navbar-nav">             
              <!-- User Account: style can be found in dropdown.less -->
              <!--<li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Selamat Datang, User <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Logout</a></li>
                      </ul>
                  </li>              
            </ul>
          </div>!-->
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
              <a href="<?php echo site_url('')?>">
                <i class="fa fa-envelope"></i> <span>Permintaan Barang</span> 
              </a>
            </li>            
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        

        <!-- Main content -->
        <section class="content">
        
        <fieldset disabled>
        <div class="form-group col-md-12">
            <label>No Request</label>
            <input class="form-control" name="id_request" value="<?php echo $idd; ?>" type="text">
        </div>
        <div class="form-group col-md-12">
            <label>Unit Permintaan</label>
            <input class="form-control" name="unit_permintaan" value="<?php echo $unit; ?>" type="text">
        </div>

        <div class="form-group col-md-12">
            <label>Dokumen Pendukung</label>
            <input class="form-control" name="dokumen_pendukung" value="<?php echo $dokumen; ?>" type="text">
        </div>
        <div class="form-group col-md-12">
          <label>Tanggal Permintaan</label>
            <input class="form-control" name="tanggal" value="<?php echo $tanggal; ?>" type="text">
      </div>
     <div class="form-group col-md-12">
          <label class="control-label">Status</label>
            <input class="form-control" name="status" value="<?php echo $status; ?>" type="text">       
      </div>  

      </fieldset>
      <!-- UPLOAD KETIKA SUDAH ADA FILE DALAM DATABASE !-->
        <?php if($file!= null) : ?>    
           <?php echo form_open_multipart('person/upload/'.$idd.'/'.$file);?>

        <fieldset>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label for="filename" class="control-label">Unggah Surat</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <!--<input type="file" name="filename" size="20" />!-->
                        <div style="position:relative;">
                                <a class='btn btn-default btn-file' href='javascript:;'>
                                    Choose File...
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="filename" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                                </a>
                                &nbsp;
                                <span class='label label-default' id="upload-file-info"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Unggah Berkas" class="btn btn-primary"/>
                        <span class="label label-danger"><?php if (isset($error)) { echo $error; } ?></span>
                    </div>
                    <div class="col-md-3">
                        <i><p>Ukuran File Maksimum 5 MB</p>
                        <p>Format File: pdf / doc / docx / xls / xlsx </p></i>
                    </div>
                </div>
            </div>

            

            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-12">
                    <?php 
                    if($file == NULL)
                    {
                        ?>
                        <h3><span class="label label-default" style="display: block;"><i class="glyphicon glyphicon-remove"></i>  Tidak ada Berkas</span></h3>
                        <?php
                    }
                    else
                    {
                        ?>
                        <h4><a class="btn btn-success btn-block" href="<?php echo site_url('person/download/'.$file.'/')?>"><i class="glyphicon glyphicon-download"></i><strong> Unduh Berkas <br> <i><?php echo $file?></i></strong></a></h4>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>

            
        </fieldset>
        
        <?php echo form_close(); ?>
        <?php if (isset($success_msg)) { echo $success_msg; } ?>

    <!-- UPLOAD KETIKA TIDAK ADA FILE DALAM DATABASE !-->
     <?php else : ?>

        <?php echo form_open_multipart('person/upload0/'.$idd.'/');?>

        <fieldset>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label for="filename" class="control-label">Unggah Surat</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <!--<input type="file" name="filename" size="20" />!-->
                        <div style="position:relative;">
                                <a class='btn btn-default btn-file' href='javascript:;'>
                                    Choose File...
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="filename" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                                </a>
                                &nbsp;
                                <span class='label label-default' id="upload-file-info"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Unggah Berkas" class="btn btn-primary"/>
                        <span class="label label-danger"><?php if (isset($error)) { echo $error; } ?></span>
                    </div>
                    <div class="col-md-3">
                        <i><p>Ukuran File Maksimum 5 MB</p>
                        <p>Format File: pdf / doc / docx / xls / xlsx </p></i>
                    </div>
                </div>
            </div>

            

            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-12">
                    
                        <h3><span class="label label-default" style="display: block;"><i class="glyphicon glyphicon-remove"></i>  Tidak ada Berkas</span></h3>
                        
                    
                    </div>
                </div>
            </div>

            
        </fieldset>
        
        <?php echo form_close(); ?>
        <?php if (isset($success_msg)) { echo $success_msg; } ?>

     <?php endif;?>

        <h3>Data Barang</h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Barang</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang Tabel</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width:170px;">Nama Barang</th>
                    <th style="width:75px;">Jumlah</th>
                    <th style="width:75px;">Satuan</th>
                    <th style="width:265px;">Keterangan</th>
                    <!--<th>Date of Birth</th>!-->
                    <th style="width:125px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                 <th style="width:170px;">Nama Barang</th>
                    <th style="width:75px;">Jumlah</th>
                    <th style="width:75px;">Satuan</th>
                    <th style="width:265px;">Keterangan</th>
                    <!--<th>Date of Birth</th>!-->
                    <th style="width:125px;">Aksi</th>
            </tr>
            </tfoot>
        </table>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('barang/ajax_list/'.$idd.'/')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});

function edit_data()
{
    "<?php echo site_url('barang/edit_data'); ?>";
}

function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Barang'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('barang/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_barang"]').val(data.id_barang);
            $('[name="id_request"]').val(data.id_request);
            $('[name="nama_barang"]').val(data.nama_barang);
            $('[name="jumlah_barang"]').val(data.jumlah_barang);
            //$('[name="tanggal"]').val(data.tanggal);
            $('[name="satuan_barang"]').val(data.satuan_barang);
            $('[name="keterangan_barang"]').val(data.keterangan_barang);            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('barang/ajax_add_barang')?>";
    } else {
        url = "<?php echo site_url('barang/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('barang/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_barang"/> <!-- HIDDEN ID BARANG !-->
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">ID Request</label>
                            <div class="col-md-9">
                                <input name="id_request" placeholder="ID Request" class="form-control" type="text" value="<?php echo $idd; ?>" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Barang</label>
                            <div class="col-md-9">
                                <input name="nama_barang" placeholder="Nama Barang" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah Barang</label>
                            <div class="col-md-9">
                                <input name="jumlah_barang" placeholder="Jumlah Barang" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Satuan Barang</label>
                            <div class="col-md-9">
                                <input name="satuan_barang" placeholder="Jumlah Barang" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan Barang</label>
                            <div class="col-md-9">
                                <textarea name="keterangan_barang" placeholder="Keterangan Barang" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>


            </div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
            
            <!--  Page content -->
          </div>
        </div>
    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

</body>
</html>