<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Catagory
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
        <div class="row">
            <div class="col-md-8">
            <div class="card">
                   @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                  @endif
              <div class="card-header">
                 All Catagory
              </div>
           
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">SL Number</th>
                    <th scope="col">CatagoryName</th>
                    <th scope="col">User</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>

                <tbody>
                    <!-- @php($i=1) -->
                   @foreach ($catagories as $catagory)
                  <tr>
                    <th scope="row">{{$catagories->firstItem()+$loop->index}}</th>
                    <td>{{ $catagory->catagory_name }}</td>
                    <td>{{ $catagory->user->name  }}</td>
                    <td>{{ $catagory->created_at->diffForHumans()  }}</td>
                    <td >
                      <a href="{{ url('catagory/edit/'.$catagory->id) }}" class="btn btn-info">Edit</a>
                      <a href="{{ url('softdelete/catagory/'.$catagory->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
               
              </table>
              {{$catagories->links()}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                 Add Catagory
              </div>
              <div class="card-body">
              <form action="{{ route('store.catagory') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Catagory Name</label>
                  <input type="text" name="catagory_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                 @error ('catagory_name')
                   <span class="text-danger">{{ $message }}</span>
                 @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Add Catagory</button>
              </form>
            </div>
            </div>
        </div>
        </div>
        </div>
{{-- Trash Part --}}
        <div class="container">
          <div class="row">
              <div class="col-md-8">
              <div class="card">
                    
                
                  
                <div class="card-header">
                  Trash List
                </div>
             
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">SL Number</th>
                      <th scope="col">CatagoryName</th>
                      <th scope="col">User</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
  
                  <tbody>
                      <!-- @php($i=1) -->
                     @foreach ($trashCat  as $catagory)
                    <tr>
                      <th scope="row">{{$catagories->firstItem()+$loop->index}}</th>
                      <td>{{ $catagory->catagory_name }}</td>
                      <td>{{ $catagory->user->name  }}</td>
                      <td>{{ $catagory->created_at->diffForHumans()  }}</td>
                      <td >
                        <a href="{{ url('catagory/restore/'.$catagory->id) }}" class="btn btn-info">Restore</a>
                        <a href="{{ url('pdelete/catagory/'.$catagory->id) }}" class="btn btn-danger">P Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                 
                </table>
                {{$trashCat->links()}}
              </div>
          </div>
  
        
          </div>
          </div>

        </div>
    
</x-app-layout>
