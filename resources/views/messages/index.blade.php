<x-app-layout>
	<div class="container-fluid h-100">
    
    @if (count($friends) !==0 )
    <div class="row justify-content-center h-100">
      <div class="col-md-4 col-xl-3  chat">
        <div class="card mb-sm-3 mb-md-0 contacts_card">
        <div class="card-header">
          <div class="input-group">
            <input type="text" placeholder="Search..." name="" class="form-control search">
            <div class="input-group-prepend">
              <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
            </div>
          </div>
        </div>

        
        @livewire('friend-list')



        <div class="card-footer"></div>
        </div></div>
     
     
      @livewire('messages')

   
   
   
    </div>
    @else
    <h1 style="text-align: center;
    font-size: xxx-large;
  }">No Friends yet</h1>
    @endif

  </div>

  <script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });
    });
</script>
</x-app-layout>