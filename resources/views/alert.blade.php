<div id="exampleModalLive1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Увага!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center alert alert-danger"><strong>{{ $slot }}</strong></p>
      </div>
    </div>
  </div>
</div>

@push('footer')
    <script type="text/javascript">
    window.onload = function() {  
   $('#exampleModalLive1').modal("show");
    }; 
</script>
@endpush