<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Catagory
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
        <div class="row">
     

        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                 Edit Catagory
              </div>
              <div class="card-body">
              <form action="{{ url('catagory/update'.$catagories->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Update Catagory Name</label>
                  <input type="text" name="catagory_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$catagories->catagory_name}}">
                 @error ('catagory_name')
                   <span class="text-danger">{{ $message }}</span>
                 @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Update Catagory</button>
              </form>
            </div>
            </div>
        </div>
        </div>
        </div>

        </div>
    </div>
        </div>
    </div>
</x-app-layout>
