<section class="content-header">
  <h1>
    All 
    <small>Galleries</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-plus"></i> All </a></li>
    <li class="active">Galleries</li>
  </ol>
</section>

    <section class="content">

    @include('alerts.alerts')

    <div class="row">
        <div class="col-xs-12">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">All Image Galleries</h3>
            </div>
            <!-- /.card-header -->
            <div class="profile-table-body">
            @include('admin.gallery.ajax.galleriesAll')
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
  </section>