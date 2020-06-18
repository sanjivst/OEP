@extends('layouts.my_frame')
@section('title','List')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Feedbacks List: </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-bordered" id="feedbacks_list">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            @php($feedback_model = [
                                'title',
                                'message',
                                'file',
                                'project',
                                'status',
                           ])
                            @foreach($feedback_model as $item)
                                <th>{{ucfirst($item)}}</th>
                            @endforeach
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($feedbacks)

                            @foreach($feedbacks as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    @foreach($feedback_model as $obj_attr)
                                        <td>
                                            @if($obj_attr == "file")
                                                <object src="{{url('feedback_files/'.$item->$obj_attr)}}">
                                                    <a href="{{url('feedback_files/'.$item->$obj_attr)}}">View File</a>
                                                </object>

                                            @elseif($obj_attr == "message")
                                                {{substr(strip_tags($item->$obj_attr), 0, 50) }}
                                            @elseif($obj_attr == "project")
                                                {{($item->$obj_attr)?$item->$obj_attr->name:'None'}}
                                            @elseif($obj_attr == "ststus")
                                                {{$item->$obj_attr==1?'Active':'Inactive'}}
                                            @else
                                                {{$item->$obj_attr}}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td><a href="{{url('admin/feedbacks/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form method="post" action="{{url('admin/feedbacks/'.$item->id)}}">
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
            $('#feedbacks_list').DataTable( {
                "scrollX": true
            } );

            $(".projects").addClass('active');
            $(".feedbacks_list").addClass('active');
        } );
    </script>
@endsection
