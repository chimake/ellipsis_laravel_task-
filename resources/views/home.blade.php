@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Links') }} <a href="{{ route('short.create') }}" class="btn btn-success float-end">Create Short Link</a></div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                          <div class="col-12">
                            <table class="table table-bordered">
                                
                              <thead>
                                <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Original Url</th>
                                  <th scope="col">Short Url</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Expiry Date</th>
                                  <th scope="col">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach ($links as $link)
                                  <tr>
                                    <th scope="row">{{ $link->id }}</th>
                                    <td>{{ $link->original_url }}</td>
                                    <td>{{ url($link->short_url) }}</td>
                                    @if ($link->status == true)
                                    <td>Active</td>
                                    @else
                                    <td>In-active</td>
                                    @endif
                                    <td>{{ $link->expiry_date }}</td>
                                    <td>
                                      <a href="{{route('user.link.show',$link->id)}}" class="btn btn-primary">View</a>
                                      <a href="{{ route('short.update',$link->id) }}" class="btn btn-success">Edit</a>
                                      @if ($link->status == true)
                                      <a href="{{ route('user.link.disable',$link->id) }}" class="btn btn-warning" onclick="return disableUrl();">Disable</a>
                                    @else
                                     <a href="{{ route('user.link.enable',$link->id) }}" class="btn btn-warning" onclick="return enableUrl();">Enable</a>
                                    @endif
                                      <a href="{{ route('user.link.delete',$link->id) }}" class="btn btn-danger" onclick="return deleletUrl();">Delete</a>
                                    
                                    </td>
                                  </tr>
                                  @endforeach
                                
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deleletUrl(){

    var del=confirm("Are you sure you want to delete this URL?");
    if (del==true){
       alert ("URL deleted")
    }else{
        alert("URL Not Deleted")
    }
    return del;
    }

    function disableUrl(){

        var disable =confirm("Are you sure you want to disable this URL?");
        if (disable==true){
        alert ("URL disabled")
        }else{
            alert("URL Not disabled")
        }
        return disable;
    }

    function enableUrl(){
        var enable =confirm("Are you sure you want to enable this URL?");
        if (enable==true){
        alert ("URL enabled")
        }else{
            alert("URL Not enabled")
        }
        return enable;
    }
</script>
@endsection
