@extends('layouts.my_frame')
@section('title','List')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Projects List: </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-bordered" id="projects_list">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            @php($project_model = [
                                'name',
                                'slug',
                                'type',
                                'logo',
                                'thumbnail',
                                'banner',
                                'featured_image',
                                'excerpt',
                                'detail',
                                'web',
                                'platform',
                                'designed',
                                'tools',
                                'address',
                                'email',
                                'phone',
                                'mobile',
                                'work_progress',
                                'other',
                                'status',
                                'user',
                           ])
                            @foreach($project_model as $item)
                                <th>{{ucfirst($item)}}</th>
                            @endforeach
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($projects)

                            @foreach($projects as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    @foreach($project_model as $obj_attr)
                                        <td>
                                            @if($obj_attr == "logo"|$obj_attr == "thumbnail"|$obj_attr == "banner"|$obj_attr == "featured_image")
                                                <img src="{{url('project_images/'.$item->$obj_attr)}}" alt="{{$item->name}}" height="100">
                                            @elseif($obj_attr == "excerpt" | $obj_attr == "detail")
                                                {{substr(strip_tags($item->$obj_attr), 0, 50) }}
                                            @elseif($obj_attr == "user")
                                                {{($item->$obj_attr)?$item->$obj_attr->name:'None'}}
                                            @else
                                                {{$item->$obj_attr}}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td><a href="{{url('admin/projects/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form method="post" action="{{url('admin/projects/'.$item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="border-radius:50%" onclick="return confirm('Do you want to delete this?')" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#projects_list').DataTable( {
                "scrollX": true
            } );

            $(".projects").addClass('active');
            $(".projects_list").addClass('active');
        } );
    </script>
@endsection
