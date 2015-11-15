<div class="modal fade" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $modal_title or '' }}</h4>
      </div>
      <div class="modal-body">
        {{ $modal_content or '' }}
      </div>
      @if(isset($show_modal_footer) && $show_modal_footer )
      <div class="modal-footer">
      	@if(isset($show_modal_footer_buttons) && $show_modal_footer_buttons )
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	<button type="button" class="btn btn-primary">Save changes</button>
        @endif
        <div class='uil-ring-css hidden' style='-webkit-transform:scale(0.6)'><div></div></div>
      </div>
      @endif
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->