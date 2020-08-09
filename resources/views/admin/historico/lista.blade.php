<section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">


 @foreach ($historicos as $historico)
     

              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">{{$historico->OcorrenciaData}}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="{{$historico->icon}}"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{$historico->OcorrenciaHora}}</span>
                  <h3 class="timeline-header"><a href="#">{{$historico->responsavel->ShortName}}</a> responsável </h3>

                  <div class="timeline-body">
                   {{$historico->mensagem}}
                  </div>
                 </div>
              </div>
              <!-- END timeline item -->
 @endforeach          

            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>