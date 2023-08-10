@extends('layouts.backend')

@section('title','Category List')

@section('content')
<div class="card">

    <div class="card-header">
        <h4>{{$page_title}}</h4>
      </div>
   <div class="card-body">
    <table class="table table-responsive table-striped">
        <thead class="thead-dark">
        <tr>
            <th >
                Sl No.
            </th>
            <th>
                Thumbnail
            </th>
            <th>
                Name
            </th>
            <th>
                Action
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item )
            <tr>
                <td>{{$loop->index+1}}</td>

                <td>
                    <img src="{{asset($item->thumbnail)}}" alt="{{$item->name}}" width="100">
                </td>

                <td>{{$item->name}}</td>

                <td>
                    <a class="btn btn-primary" href="{{route('category.edit',$item->id)}}">edit</a>
                    <button class="btn btn-danger delete" type="button"  id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal">delete</button>
                </td>
            </tr>

            @endforeach


        </tbody>
    </table>
   </div>

  </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
           <form id="deleteModal" method="POST">
            @csrf
            @method('DELETE')
            <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure delete this item?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
           </form>

    </div>
  </div>

@endsection

@section('scripts')

 <script >




    $('.delete').on('click',function(){



        const id=this.id;

        $('#deleteModal').attr('action',"{{route('category.destroy','')}}"+'/'+id);

    })

 </script>

@endsection
